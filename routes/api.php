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

//Test routes
Route::post('accounts', 'AccountController@store');

//Public routes
Route::post('login', 'AuthController@authenticate');
Route::post('logout', 'AuthController@logout');

Route::get('posts', 'PostController@index');
Route::get('posts/{id}', 'PostController@show');

Route::get('categories', 'CategoryController@index');
Route::get('categories/{id}', 'CategoryController@show');

//Routes for logged in users
Route::group(['middleware' => ['api', 'jwt.verify']], function () {
    Route::get('users', 'UserController@index');
    Route::get('users/{id}', 'UserController@show');
    Route::post('users/avatar', 'UserController@uploadAvatar');

    Route::post('comments', 'CommentController@store');
    Route::patch('comments/{id}', 'CommentController@update');
    Route::delete('comments/{id}', 'CommentController@delete');

    Route::post('posts', 'PostController@store');
    Route::patch('posts/{id}', 'PostController@update');
    Route::delete('posts/{id}', 'PostController@delete');

    Route::post('reports', 'ReportController@store');

    Route::post('votes', 'VoteController@store');
    Route::patch('votes/{id}', 'VoteController@update');
    Route::delete('votes/{id}', 'VoteController@delete');
    
    //Routes for admin
    Route::group(['middleware' => ['admin']], function () {
        Route::patch('users/{id}', 'UserController@update');
        Route::delete('users/{id}', 'UserController@delete');

        Route::get('reports', 'ReportController@index');
        Route::get('reports/{id}', 'ReportController@show');
        Route::patch('reports/{id}', 'ReportController@update');
        Route::delete('reports/{id}', 'ReportController@delete');
    });
});
