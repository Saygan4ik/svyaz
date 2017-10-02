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

Route::resource('user', 'UserController', ['except' => 'index']);
Route::get('user/{id}/comments', 'UserController@getUserComments');
Route::get('user_{role?}', 'UserController@index');
Route::post('user/ajaxChangeSeen', 'UserController@changeSeen');
Route::post('user/ajaxChangeAdmin', 'UserController@changeAdmin');

Route::resource('product', 'ProductController', ['except' => 'index']);
Route::get('product_{group?}', 'ProductController@index');

Route::resource('comment', 'CommentController', ['except' => 'index']);
Route::get('comment_{new?}', 'CommentController@index');
Route::post('comment/ajaxChangeSeen', 'CommentController@changeSeen');

Route::get('admin', 'AdminController@index');