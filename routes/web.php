<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->prefix('profile')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('profile');
    Route::post('/', [DashboardController::class, 'updateProfile'])->name('profile.update');
    Route::post('/p', [DashboardController::class, 'updatePassword'])->name('profile.update.password');
});
