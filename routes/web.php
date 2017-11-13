
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


Route::get('/register/verify', 'Auth\RegisterController@verify');
Route::get('/register/verify/{token}', 'Auth\RegisterController@confirm');
Route::get('/home', 'HomeController@index')->name('home');


Route::resource('categories', 'CategoriesController', ['except' => ['create', 'edit']]);
Route::resource('posts', 'PostsController', ['except' => ['create', 'edit']]);

// Route::get('auth/facebook', 'Auth\RegisterController@redirectToProvider');
// Route::get('auth/facebook/callback', 'Auth\RegisterController@handleProviderCallback');

Route::get('auth/facebook', 'Auth\LoginController@redirectToFacebookProvider');
Route::get('auth/facebook/callback', 'Auth\LoginController@handleFacebookProviderCallback');