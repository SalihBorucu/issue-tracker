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

Route::get('/', 'AppController@index')->middleware('auth');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/ajax')->middleware('auth')->group(function () {
    // BOARD
    Route::post('/board', 'Ajax\BoardController@store');
    Route::patch('/board/{boardId}', 'Ajax\BoardController@update');
    Route::delete('/board/{boardId}', 'Ajax\BoardController@destroy');

    // TASK
    Route::post('/task', 'Ajax\TaskController@store');
    Route::patch('/task/{taskId}', 'Ajax\TaskController@update');
    Route::patch('/task/{taskId}/update-board', 'Ajax\TaskController@updateBoard');
    Route::delete('/task/{task}', 'Ajax\TaskController@destroy');

    // COMMENT
    Route::post('/comment', 'Ajax\CommentController@store');

});
