<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\RegistrationController;
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

//Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
//Route::group(['prefix' => 'admin'], function () {
////    Route::get('/', function () {
////        return view('admin.index');
////    })->name('admin.index');
//Route::get('/registrations', function () {
//    return view('admin.registrations');
//})->name('admin.registrations');
//Route::get('/create_course', function () {
//    return view('admin.create_course');
//})->name('admin.create_course');
Route::get('/access_requests', function () {
    return view('admin.access_requests');
})->name('admin.access_requests');
//Route::get('/create_user', function () {
//    return view('admin.create_user');
//})->name('admin.create_user');
Route::get('/edit_user', function () {
    return view('admin.edit_user');
})->name('admin.edit_user');
////    Route::get('/', 'MainController@index')->name('admin.index');
////    Route::resource('/categories', 'CategoryController');
////    Route::resource('/tags', 'TagController');
////    Route::resource('/posts', 'PostController');
//});

Route::group(['prefix' => 'admin', 'middleware' => 'type:admin'], function () {
//    Route::resource('/categories', 'CategoryController');
//    Route::get('users/create_user', [UserController::class, 'create'])->name('users.create');
//    Route::get('users/{type}', [UserController::class, 'index'])->name('admin.index');
    Route::resource('users', UserController::class)->names([
        'index' => 'admin.index'
    ]);
    //переделать в ресурс?
    Route::get('registrations', [RegistrationController::class, 'index'])->name('registrations.index');
    Route::delete('registrations/{id}', [RegistrationController::class, 'destroy'])->name('registrations.destroy');
    Route::delete('registrations', [RegistrationController::class, 'destroyAll'])->name('registrations.destroyAll');
    Route::put('registrations/{id}', [RegistrationController::class, 'update'])->name('registrations.update');

    Route::resource('course', CourseController::class)->only([
        'create', 'store'
    ]);
//    Route::resource('/users', UserController::class);
//    Route::resource('/tags', 'TagController');
//    Route::resource('/posts', 'PostController');
});


Route::get('/policy', function () {
    return view('basic.policy');
})->name('policy');

Route::post('registration', [UserController::class, 'store'])->middleware('type:guest,admin')->name(
    'registration.store'
);

Route::group(['middleware' => 'guest'], function () {
    Route::get('registration', [UserController::class, 'register'])->name('registration');
    Route::get('', [AuthController::class, 'loginForm'])->name('login');
    Route::post('', [AuthController::class, 'login'])->name('login.store');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
