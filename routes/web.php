<?php

use App\Http\Controllers\AccessRequestController;
use App\Http\Controllers\AttemptController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminCourseController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseUserController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['prefix' => 'admin', 'middleware' => 'type:admin'], function () {
    Route::resource('users', UserController::class)->except(['show']);
    Route::delete('registrations', [RegistrationController::class, 'destroyAll'])->name('registrations.destroyAll');
    Route::resource('registrations', RegistrationController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('course', AdminCourseController::class)->only(['create', 'store',]);
    Route::resource('course_user', CourseUserController::class)->only(['index', 'update', 'destroy'])->parameters(
        ['course_user' => 'user_id']
    );
});

Route::get('/policy', function () {
    return view('basic.policy');
})->name('policy');

Route::group(['middleware' => 'type:guest,admin'], function () {
    Route::post('registration', [UserController::class, 'store'])->name('registration.store');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('registration', [RegistrationController::class, 'create'])->name('registration');
    Route::get('', [AuthController::class, 'loginForm'])->name('login');
    Route::post('', [AuthController::class, 'login'])->name('login.store');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'type:student'], function () {
    Route::post('attempt', [AttemptController::class, 'store'])->name('attempt.store');
});

Route::group(['middleware' => 'type:teacher'], function () {
    Route::put('course/{id}', [CourseController::class, 'update'])->name('course.update');
    Route::get('attempt', [AttemptController::class, 'index'])->name('attempt.index');
    Route::resource('task', TaskController::class)->only(['store', 'update', 'destroy']);
    Route::post('homework', [HomeworkController::class, 'store'])->name('homework.store');
    Route::put('homework', [HomeworkController::class, 'update'])->name('homework.update');
    Route::delete('homework', [HomeworkController::class, 'destroy'])->name('homework.destroy');
});

Route::group(['middleware' => 'type:student,teacher'], function () {
    Route::resource('attempt', AttemptController::class)->only(['show']);
    Route::resource('access_request', AccessRequestController::class)->only(['index', 'update']);
    Route::resource('homework', HomeworkController::class)->only('index');
    Route::resource('course', CourseController::class)->only(['index', 'show']);
});
