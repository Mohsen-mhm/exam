<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Dashboard\TwoFactorRequest;
use App\Http\Requests\Api\v1\Dashboard\UpdatePasswordRequest;
use App\Http\Requests\Api\v1\Dashboard\UpdateProfileRequest;
use App\Services\ActiveCode\ActiveCodeService;
use App\Services\Admin\UserService;
use App\Services\Dashboard\DashboardService;
use App\Services\SMS\SMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    public function updateProfile(UpdateProfileRequest $request, DashboardService $dashboardService)
    {
        try {

            $validData = [
                'name' => $request->input('name'),
            ];

            $avatarName = null;

            if ($request->avatar) {
                $image = $request->file('avatar');
                $avatarName = $dashboardService->saveAvatar($image);
                $validData['avatar'] = $avatarName;
            }

            $status = $dashboardService->updateProfile($validData, Auth::user());

            if ($status) {
                return $this->response(true, 'Updated successfully.',
                    $avatarName ? ['avatar-url' => url('/storage/images/' . $avatarName),] : [],
                    Response::HTTP_OK);
            } else {
                return $this->response(false, 'Unable to update profile...!', [], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (\Exception $exception) {
            return $this->response(false, $exception->getMessage(), [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        try {

            $user = Auth::user();

            $currentPassword = $request->input('current_password');
            $newPassword = $request->input('password');

            if (Hash::check($currentPassword, $user->password)) {
                $user->password = Hash::make($newPassword);
                $user->save();

                return $this->response(true, 'Password updated successfully.', [
                    'user' => $user,
                ], Response::HTTP_OK);
            } else {
                return $this->response(false, 'The provided password does not match your current password.', [], Response::HTTP_NOT_ACCEPTABLE);
            }
        } catch (\Exception $exception) {
            return $this->response(false, $exception->getMessage(), [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function twoFactorAuth(TwoFactorRequest $request, ActiveCodeService $activeCodeService, UserService $userService)
    {
        try {
            $code = $request->input('code');
            $user = $request->user();

            foreach ($request->all() as $item => $value) {
                if ($item !== 'code')
                    $validData[$item] = $value;
                if ($item === 'phone')
                    $validData[$item] = preg_replace('/\s+/', '', $value);
            }
            if (!$request->input('two_fa'))
                $validData['two_fa'] = 0;

            if (!$activeCodeService->checkCodeIsTrue($code, $user)) {
                return $this->response(false, 'Code you entered is incorrect...!', [], Response::HTTP_NOT_FOUND);
            } elseif (!$activeCodeService->checkExpirationIsValid($user)) {
                return $this->response(false, 'Code you entered is expired...!', [], Response::HTTP_REQUEST_TIMEOUT);
            } else {
                $activeCodeService->deleteCode($user);
                $status = $userService->updateUser($validData, $user);

                if ($status) {
                    return $this->response(true, 'Updated successfully.', [
                        'user' => $user,
                    ], Response::HTTP_OK);
                } else {
                    return $this->response(false, 'Unable to update profile...!', [], Response::HTTP_INTERNAL_SERVER_ERROR);
                }
            }

        } catch (\Exception $exception) {
            return $this->response(false, $exception->getMessage(), [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
