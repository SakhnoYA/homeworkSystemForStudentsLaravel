<?php

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
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin.index');
    Route::get('/registrations', function () {
        return view('admin.registrations');
    })->name('admin.registrations');
    Route::get('/create_course', function () {
        return view('admin.create_course');
    })->name('admin.create_course');
    Route::get('/access_requests', function () {
        return view('admin.access_requests');
    })->name('admin.access_requests');
    Route::get('/create_user', function () {
        return view('admin.create_user');
    })->name('admin.create_user');
    Route::get('/edit_user', function () {
        return view('admin.edit_user');
    })->name('admin.edit_user');
//    Route::get('/', 'MainController@index')->name('admin.index');
//    Route::resource('/categories', 'CategoryController');
//    Route::resource('/tags', 'TagController');
//    Route::resource('/posts', 'PostController');
});

Route::get('/', function () {
    return view('basic.login');
})->name('home');

Route::get('/registration', function () {
    return view('basic.registration');
})->name('registration');

Route::get('/policy', function () {
    return view('basic.policy');
})->name('policy');

