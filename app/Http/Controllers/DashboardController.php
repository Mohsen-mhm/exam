<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\Dashboard\DashboardService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
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
            'name' => $request->input('name'),
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

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = Auth::user();

        $currentPassword = $request->input('current_password');
        $newPassword = $request->input('password');

        if (Hash::check($currentPassword, $user->password)) {
            $user->password = Hash::make($newPassword);
            $user->save();

            return redirect()->back()->with('success', 'Password updated successfully.');
        } else {
            return redirect()->back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
        }
    }
}
