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
Route::get('get-user/{user_id}', 'AuthController@get_user');
Route::get('logout', 'AuthController@logout');



Route::get('categories', 'CategoriesController@index');
Route::get('myCategories/{user_id}', 'CategoriesController@myCategories');
Route::post('addCategory/{user_id}', 'CategoriesController@store');
Route::put('editCategory/{id}', 'CategoriesController@update');
Route::delete('deleteCategory/{id}', 'CategoriesController@destroy');
Route::get('categoryPosts/{id}', 'CategoriesController@show');

Route::get('myPosts/{user_id}', 'PostsController@index');
Route::post('addPost/{user_id}', 'PostsController@store');
Route::get('/posts/{id}', 'PostsController@show');
Route::put('editPost/{id}', 'PostsController@update');
Route::delete('deletePost/{id}', 'PostsController@destroy');


Route::get('/test', function(){
	return response()->json(['ajabsandal' => 'barev'], 200);
});

Route::get('/home', 'HomeController@index');