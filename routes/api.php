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

Route::get('categories', 'CategoryController@index');


Route::get('posts/{id}/categories', 'PostCategoryController@showCategories');
Route::get('categories/{id}/posts', 'PostCategoryController@showPosts');

Route::get('comments/{id}', 'CommentController@show');
Route::post('comments', 'CommentController@store');
Route::patch('comments/{id}', 'CommentController@update');
Route::delete('comments/{id}', 'CommentController@delete');

Route::get('reports', 'ReportController@index');
Route::get('reports/{id}', 'ReportController@show');
Route::post('reports', 'ReportController@store');
Route::patch('reports/{id}', 'ReportController@update');
Route::delete('reports/{id}', 'ReportController@delete');

Route::get('votes/{id}', 'VoteController@show');
Route::post('votes', 'VoteController@store');
Route::patch('votes/{id}', 'VoteController@update');
Route::delete('votes/{id}', 'VoteController@delete');