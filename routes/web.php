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

Route::get('/users', 'UsersController@index');
Route::get('/user-list', 'UsersController@userList');

Route::get('/tasks', 'TasksController@index');
Route::get('/task/create', 'TasksController@create');
Route::get('/task/{id}/edit', 'TasksController@edit');
Route::put('/task/{id}', 'TasksController@update');