<?php

use Illuminate\Support\Facades\Route;

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */

Route::middleware('guest')->namespace('Web')->group(function () {
    Route::get('/', 'MainController@index')->name('main');
});

Route::prefix('admintl')->middleware('admin')->namespace('Admin')->group(function () {
    Route::get('/', 'MainController@index')->name('dashboard');
    Route::get('/food', 'MainController@food')->name('get.food');

    Route::get('/menu', 'MainController@menu')->name('get.menu');
    Route::get('/menu/{id}', 'MainController@menuDetail')->name('detail.menu');

    Route::get('/location', 'MainController@location')->name('get.location');
});

Route::middleware('guest')->namespace('Auth')->group(function () {
    // Authorization
    Route::get('login', 'SessionController@getLogin')->name('auth.login.form');
    Route::post('login', 'SessionController@postLogin')->name('auth.login.attempt');
    Route::any('logout', 'SessionController@getLogout')->name('auth.logout');
});
