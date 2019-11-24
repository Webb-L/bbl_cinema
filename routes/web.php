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

Route::get('/', 'IndexController@index')->name('index');
Route::get('/login', 'UserAuthController@login')->name('login');
Route::post('/logis', 'UserAuthController@store')->name('logis');
Route::get('/register', 'UserAuthController@register')->name('register');
Route::get('/success/{id}', 'SuccessController@show')->name('success');

Route::resource('print', 'PrintController');
Route::resource('user', 'UserController')->middleware('auth:user');
Route::get('print/{id}/p', 'PrintController@print')->name('print')->middleware('auth:user');
Route::get('print/{id}/cancel', 'PrintController@cancel')->name('cancel')->middleware('auth:user');
Route::resource('vote', 'VoteController')->middleware('auth:user');
