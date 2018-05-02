<?php

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

Route::get('/', 'PageController@index')->name('home');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');


Route::group(['middleware' => ['permission:see admins']], function () {
    Route::get('/admins', 'DashboardController@showAdmins')->name('admins');
});

Route::group(['middleware' => ['permission:see editors']], function () {
    Route::get('/editors', 'DashboardController@showEditors')->name('editors');
});

Route::group(['middleware' => ['permission:see users']], function () {
    Route::get('/users', 'DashboardController@showUsers')->name('users');
});

