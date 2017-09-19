
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

Route::get('/home', 'CategoryController@index')->name('home');
//Route::post('/categories/edit', 'CategoryController@edit');
Route::post('/categories/store', 'CategoryController@store');
Route::get('/categories/{id}', 'CategoryController@show');
Route::put('/categories/{id}', 'CategoryController@update');
Route::delete('/categories/{id}', 'CategoryController@destroy');
Route::get('/categories', 'CategoryController@allCategories');
Route::post('/posts/my-posts', 'PostController@create');
Route::get('/posts/my-posts', 'PostController@store');
Route::get('/posts/{id}', 'PostController@show');
Route::put('/posts/{id}', 'PostController@update');
Route::delete('/posts/{id}', 'PostController@destroy');
