<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Services\Dashboard\DashboardService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('dashboard.index', compact('user'));
    }

    public function updateProfile(UpdateProfileRequest $request, DashboardService $dashboardService)
    {
        $validData = [
            'name' => $request->name,
        ];

        if ($request->avatar) {
            $image = $request->file('avatar');
            $avatarName = $dashboardService->saveAvatar($image);
            $validData['avatar'] = $avatarName;
        }

        $status = $dashboardService->updateProfile($validData, Auth::user());

        if ($status)
            return redirect()->back()->with('success', 'Updated successfully.');
        else
            return redirect()->back()->withErrors('Unable to update profile...!');
    }
}
