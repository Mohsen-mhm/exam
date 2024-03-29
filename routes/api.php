<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\DashboardController;
use App\Http\Controllers\Api\v1\ExamController;
use App\Http\Controllers\Api\v1\QuestionController;
use App\Http\Controllers\Api\v1\SmsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('login/{user}/two-factor', 'authenticateTwoFactor')->name('api.login.authenticate.two.factor');

        Route::post('register', 'register');

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('logout', 'logout');

            Route::get('user', 'getUser');
            Route::get('users', 'getUsers');
        });
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('send-sms', [SmsController::class, 'sendSMS']);

        Route::controller(DashboardController::class)->prefix('profile')->group(function () {
            Route::post('update-profile', 'updateProfile');
            Route::post('update-password', 'updatePassword');
            Route::post('enable-two-factor', 'twoFactorAuth');
        });

        Route::controller(ExamController::class)->group(function () {
            Route::get('get-exam/{exam}', 'getExam');
            Route::get('get-exams', 'getExams');

            Route::prefix('exam')->group(function () {
                Route::post('create', 'store');
                Route::post('edit/{exam}', 'update');
            });
        });

        Route::controller(QuestionController::class)->group(function () {
            Route::get('get-question/{question}', 'getQuestion');
            Route::get('get-questions', 'getQuestions');

            Route::prefix('question')->group(function () {
                Route::post('create', 'store');
                Route::post('edit/{question}', 'update');
            });
        });
    });
});
