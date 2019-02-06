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

    Route::get('/menu', 'MainController@menu')->name('get.menu');
    Route::get('/menu/{id}', 'MainController@menuDetail')->name('detail.menu');
    Route::post('/menu/create', 'MainController@menuCreate')->name('create.menu');
    Route::post('/menu/update/{id}', 'MainController@menuUpdate')->name('update.menu');
    Route::post('/menu/delete/{id}', 'MainController@menuDelete')->name('delete.menu');

    Route::get('/food', 'MainController@food')->name('get.food');
    Route::get('/food/{id}', 'MainController@foodDetail')->name('detail.food');
    Route::post('/food/create', 'MainController@foodCreate')->name('create.food');
    Route::post('/food/update/{id}', 'MainController@foodUpdate')->name('update.food');
    Route::post('/food/delete/{id}', 'MainController@foodDelete')->name('delete.food');

});

Route::middleware('guest')->namespace('Auth')->group(function () {
    // Authorization
    Route::get('login', 'SessionController@getLogin')->name('auth.login.form');
    Route::post('login', 'SessionController@postLogin')->name('auth.login.attempt');
    Route::any('logout', 'SessionController@getLogout')->name('auth.logout');
});
