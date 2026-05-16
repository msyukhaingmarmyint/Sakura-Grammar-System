<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware(['role:user'])->group(function () {
        Route::get('/user', function () {
            return view('user.dashboard');
        })->name('user');
    });

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', function () {
            return view('admin.dashboard');
        })->name('admin');
    });
});

Route::post('/logout', [LogoutController::class, 'store'])->middleware('auth')->name('logout');

//For Levels
Route::resource('levels', LevelController::class);
Route::post('/level/status/{id}', [LevelController::class, 'changeStatus'])->name('level.status');
Route::get('/level/inactive', [LevelController::class, 'inactive'])->name('level.inactive');


// For Lessons
Route::resource('/lessons', LessonController::class);
Route::post('/lesson/status/{id}', [LessonController::class, 'changeStatus'])->name('lesson.status');
Route::get('/lesson/inactive', [LessonController::class, 'inactive'])->name('lesson.inactive');
Route::get('/lesson/level/{name}', [LessonController::class, 'showByLevel'])->name('lesson.byLevel');

// For Users
Route::get('/users', [UserController::class, 'index'])->name('users.index');

// For Exams
Route::resource('/exams', ExamController::class);
Route::get('/exam', [ExamController::class, 'showExam'])->name('showExam');
Route::post('/exam/status/{id}', [ExamController::class, 'changeStatus'])->name('exam.status');
Route::get('/exam/inactive', [ExamController::class, 'inactive'])->name('exam.inactive');

// For Questions
Route::resource('/questions', QuestionController::class);
Route::post('/question/status/{id}', [QuestionController::class, 'changeStatus'])->name('question.status');
Route::get('/question/inactive', [QuestionController::class, 'inactive'])->name('question.inactive');


Route::get('/question/exam/{id}', [QuestionController::class, 'showByExam'])->name('question.showByExam');
Route::post('/exam/{exam}/result', [ExamController::class, 'storeResult'])->name('question.storeResult');
Route::get('/exam/{id}/result', [ExamController::class, 'showResult'])->name('exam.showResult');


Route::get('/profile/{id}', [UserController::class, 'showProfile'])->name('user.profile');
Route::get('/profile/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/profile/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::get('/change-password', [UserController::class, 'showChangePassword'])->name('password.form');
Route::post('/change-password', [UserController::class, 'changePassword'])->name('user.password.update');
Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
Route::post('/profile/status/{id}', [UserController::class, 'userStatus'])->name('user.status');
Route::post('/user/status/{id}', [UserController::class, 'changeStatus'])->name('users.status');
Route::get('/taken/exams/{id}', [UserController::class, 'showTakenExams'])->name('user.takenExams');
Route::get('/get/certificates/{id}', [UserController::class, 'getCertificate'])->name('user.getCertificate');
Route::get('/taken/certificates/{id}', [UserController::class, 'showTakenCertificates'])->name('user.takenCertificates');



Route::get('/scores', [UserController::class, 'showScore'])->name('scores.index');
Route::get('/top/passers', [UserController::class, 'showTopPassers'])->name('showTopPassers');

Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::post('/bookmark/toggle/{lesson_id}', [BookmarkController::class, 'toggle'])->name('bookmark.toggle')->middleware('auth');
Route::get('/bookmarks/{user_id}', [BookmarkController::class, 'showBookmarks'])->name('user.bookmarks')->middleware('auth');
Route::delete('/bookmark/{id}', [BookmarkController::class, 'destroy'])->name('bookmark.destroy')->middleware('auth');