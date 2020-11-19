<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('accounts/post', 'AccountController@store');

Route::post('login', 'AuthController@authenticate');

Route::get('users', 'UserController@index');
Route::get('users/{id}', 'UserController@show');
Route::patch('users/{id}', 'UserController@update');
Route::delete('users/{id}', 'UserController@delete');