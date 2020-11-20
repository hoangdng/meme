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

//Routes for logged in users
Route::group(['middleware' => ['api', 'jwt.verify']], function () {
    Route::get('users/{id}', 'UserController@show');

    //Routes for admin
    Route::group(['middleware' => ['admin']], function () {
        Route::get('users', 'UserController@index');
        Route::patch('users/{id}', 'UserController@update');
        Route::delete('users/{id}', 'UserController@delete');
    });
});

Route::get('posts', 'PostController@index');
Route::post('posts', 'PostController@store');
Route::patch('posts/{id}', 'PostController@update');
Route::delete('posts/{id}', 'PostController@delete');
