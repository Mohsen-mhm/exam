<?php

use App\Http\Controllers\Admin\Exam\ExamController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Question\QuestionController;
use App\Http\Controllers\Admin\Result\ResultController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Visitor\VisitorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('users', UserController::class)->except(['show']);

Route::resource('exams', ExamController::class)->except(['show','destroy']);

Route::resource('questions', QuestionController::class)->except(['index', 'show']);

Route::resource('results', ResultController::class)->only(['index','show']);

Route::get('visitors',[VisitorController::class, 'index'])->name('visitors.index');
