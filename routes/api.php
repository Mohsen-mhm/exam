<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\DashboardController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('v1')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('login/{user}/two-factor', 'authenticateTwoFactor')->name('api.authenticate.two.factor');

        Route::post('register', 'register');
        Route::get('user', 'getUser')->middleware('auth:sanctum');
    });
    Route::middleware('auth:sanctum')->group(function () {
        Route::controller(DashboardController::class)->group(function () {
            Route::post('update-profile', 'updateProfile');
        });
    });
});
