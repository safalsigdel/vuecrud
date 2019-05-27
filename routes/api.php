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

Route::middleware('auth:api')->group(function () {

    Route::post('update-post', 'PostController@updatePost');
    Route::resource('posts', 'PostController');
    Route::get('/profile', 'api\UserController@getProfile');
    Route::post('update-profile', 'api\UserController@updateProfile');
    Route::get('/users', 'api\UserController@index');
    Route::get('/search/{name}', 'api\SearchController@index');


});
Route::post('login', 'api\UserController@login');
Route::post('register', 'api\UserController@register');
