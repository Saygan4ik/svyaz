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

Auth::routes();

Route::get('/', 'HomeController@index');

Route::resource('group', 'GroupController');
Route::get('group/{id}/orderBy{column?}_{direction?}', 'GroupController@orderBy');

Route::resource('user', 'UserController');

Route::resource('product', 'ProductController');

Route::resource('comment', 'CommentController');