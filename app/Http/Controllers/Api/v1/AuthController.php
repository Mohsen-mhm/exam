<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\LoginRequest;
use App\Http\Requests\Api\v1\RegisterRequest;
use App\Models\User;
use App\Services\ActiveCode\ActiveCodeService;
use App\Services\SMS\SMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(LoginRequest $request): Response
    {
        try {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();

                if ($user->two_fa) {
                    $phone = "+" . $user->country_code . $user->phone;
                    SMS::sendPattern($phone);
                    Auth::logout();
                    return $this->response(true, 'Need two-factor authentication, SMS send successfully', [
                        'user' => $user,
                        'url' => url(route('api.authenticate.two.factor', $user->id))
                    ], Response::HTTP_OK);
                }

                $token = $user->createToken('authToken')->accessToken;

                return $this->response(true, 'Login successfully', [
                    'user' => $user,
                    'token' => $token
                ], Response::HTTP_OK);
            }
            return $this->response(false, 'Invalid credentials', [], Response::HTTP_UNAUTHORIZED);

        } catch (\Exception $exception) {
            return $this->response(false, $exception->getMessage(), [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function authenticateTwoFactor(Request $request, ActiveCodeService $activeCodeService, $userId): Response
    {
        $user = User::getUser($userId);
        try {

            if (!$activeCodeService->checkExpirationIsValid($user)) {
                return $this->response(false, 'Code you entered is expired, login again to send new code...!', [], Response::HTTP_REQUEST_TIMEOUT);
            } elseif (!$activeCodeService->checkCodeIsTrue($request->input('code'), $user)) {
                return $this->response(false, 'Code you entered is incorrect...!', [], Response::HTTP_NOT_FOUND);
            } else {
                $activeCodeService->deleteCode($user);
                Auth::login($user);

                $token = $user->createToken('authToken')->accessToken;

                return $this->response(true, 'Login successfully', [
                    'user' => $user,
                    'token' => $token
                ], Response::HTTP_OK);
            }
        } catch (\Exception $exception) {
            return $this->response(false, $exception->getMessage(), [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function register(RegisterRequest $request): Response
    {
        try {
            $user = User::storeUser([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $token = $user->createToken('authToken')->accessToken;
            return $this->response(true, 'Register successfully', [
                'user' => $user,
                'token' => $token
            ], Response::HTTP_OK);

        } catch (\Exception $exception) {
            return $this->response(false, $exception->getMessage(), [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
