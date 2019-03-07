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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/auth/login/{provider?}', 'User\UsersController@socialLogin');

Route::get('/auth/callback/{provider?}', 'User\UsersController@socialCallback');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/curl/constellations', 'Curl\CurlController@getConstellationsData');
