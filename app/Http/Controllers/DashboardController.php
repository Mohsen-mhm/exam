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

        $data = $dashboardService->updateProfile($validData, Auth::user());

        if ($data)
            return redirect()->back()->with('success', 'updated successfully.');
        else
            return redirect()->back()->withErrors('unable to update profile...!');
    }
}
