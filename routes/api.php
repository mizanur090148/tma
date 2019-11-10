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


Route::get('/task', 'v1\TaskController@all');
Route::post('/task', 'v1\TaskController@store');
Route::post('/task', 'v1\TaskController@store');
Route::put('/task/{id}', 'v1\TaskController@update');
Route::get('/task/users-with-tasks', 'v1\TaskController@usersWithTasks');

Route::get('/task/{id}', 'v1\TaskController@destroy');

