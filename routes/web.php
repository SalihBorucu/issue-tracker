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

Route::get('/', 'AppController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/ajax')->group(function () {
    // BOARD
    Route::post('/board', 'Ajax\BoardController@store');
    Route::patch('/board/{boardId}', 'Ajax\BoardController@update');
    Route::delete('/board/{boardId}', 'Ajax\BoardController@destroy');

    // TASK
    Route::post('/task', 'Ajax\TaskController@store');
    Route::patch('/task/{taskId}', 'Ajax\TaskController@update');

});
