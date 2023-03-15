<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Exam\ExamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Question\QuestionController;
use App\Http\Controllers\Response\ResponsesController;
use App\Http\Controllers\Result\ResultController;
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

Route::middleware('auth')->prefix('profile')->controller(DashboardController::class)->group(function () {
    Route::get('/', 'index')->name('profile');
    Route::get('/setting', 'setting')->name('setting');
    Route::post('/', 'updateProfile')->name('profile.update');
    Route::post('/p', 'updatePassword')->name('profile.update.password');
});

Route::resource('exams', ExamController::class)->except(['index', 'show', 'destroy']);

Route::resource('questions', QuestionController::class)->except(['index', 'show']);

Route::resource('results', ResultController::class)->only(['index','show']);


Route::controller(ExamController::class)->group(function () {
    Route::get('exam/{link}', 'exam')->middleware(['auth', 'prevent.direct.access'])->name('exam');
    Route::get('participating/{link}', 'participating')->middleware(['auth'])->name('participating');
});
Route::post('exam/{link}', [ResponsesController::class, 'examCheck'])->middleware(['auth'])->name('exam.check');

