<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\TwoFactorRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Exam;
use App\Services\Dashboard\DashboardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function setting()
    {
        $user = Auth::user();

        return view('dashboard.setting', compact('user'));
    }

    public function exams(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');

        $userExams = Exam::where('user_id', $user->id)->when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('description', 'LIKE', '%' . $search . '%')
                ->orWhere('id', 'LIKE', '%' . $search . '%');
        })
            ->orderBy('name')
            ->paginate(10);

        return view('dashboard.exams', compact('userExams'));
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

    public function twoFactorAuth(TwoFactorRequest $request)
    {
        foreach ($request->all() as $item => $value)
            if ($item !== '_token')
                $validData[$item] = $value;

        dd($validData);
    }
}
