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
Route::get('me/categories', 'CategoriesController@myCategories');
Route::post('me/categories', 'CategoriesController@store');
Route::put('me/categories/{id}', 'CategoriesController@update');
Route::delete('me/categories/{id}', 'CategoriesController@destroy');
Route::get('categories/{id}/posts', 'CategoriesController@show');

Route::get('me/posts', 'PostsController@index');
Route::post('me/posts', 'PostsController@store');
Route::get('me/posts/{id}', 'PostsController@show');
Route::put('me/posts/{id}', 'PostsController@update');
Route::delete('me/posts/{id}', 'PostsController@destroy');




Route::get('/home', 'HomeController@index');