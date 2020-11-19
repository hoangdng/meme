<?php

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

//Routes for admin
Route::group(['middleware' => ['api', 'jwt.verify']], function () {
    Route::get('users/{id}', 'UserController@show');
    Route::group(['middleware' => ['admin']], function () {
        Route::get('users', 'UserController@index');
        Route::patch('users/{id}', 'UserController@update');
        Route::delete('users/{id}', 'UserController@delete');
    });
});
