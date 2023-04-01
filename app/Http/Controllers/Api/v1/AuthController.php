<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\LoginRequest;
use App\Http\Requests\Api\v1\RegisterRequest;
use App\Models\User;
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
                $token = $user->createToken('authToken')->accessToken;

                return response([
                    'message' => 'Login successfully',
                    'data' => [
                        'user' => $user,
                        'token' => $token
                    ]
                ], Response::HTTP_OK);
            }

            return response([
                'message' => 'Invalid credentials',
                'data' => []
            ], Response::HTTP_UNAUTHORIZED);

        } catch (\Exception $exception) {
            return response([
                'message' => $exception->getMessage(),
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
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

            return response([
                'message' => 'Register successfully',
                'data' => [
                    'user' => $user,
                    'token' => $token
                ]
            ], Response::HTTP_OK);

        } catch (\Exception $exception) {
            return response([
                'message' => $exception->getMessage(),
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
