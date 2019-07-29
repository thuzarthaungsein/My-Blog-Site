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

//Posts
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/posts', 'PostController@index')->name('post');

Route::get('/posts/edit/{id}', 'PostController@edit');
Route::post('/posts/edit/{id}', 'PostController@update');

Route::get('/posts/view/{id}', 'PostController@show');

Route::get('/posts/delete/{id}', 'PostController@destroy');

//Comments
Route::post('/posts/view/{id}', 'CommentController@store');
Route::get('/comments/delete/{id}', 'CommentController@destroy');

Route::resource('posts', 'PostController');
