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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');



Route::get('categories', 'CategoriesController@index');
Route::get('user/{user_id}/categories', 'CategoriesController@myCategories');
Route::post('user/{user_id}/categories', 'CategoriesController@store');
Route::put('user/{user_id}/categories/{id}', 'CategoriesController@update');
Route::delete('user/{user_id}/categories/{id}', 'CategoriesController@destroy');
Route::get('categories/{id}/posts', 'CategoriesController@show');

Route::get('user/{user_id}/posts', 'PostsController@index');
Route::post('user/{user_id}/posts', 'PostsController@store');
Route::get('user/{user_id}/posts/{id}', 'PostsController@show');
Route::put('user/{user_id}/posts/{id}', 'PostsController@update');
Route::delete('user/{user_id}/posts/{id}', 'PostsController@destroy');




Route::get('/home', 'HomeController@index');