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

Route::get('/', 'FileController@showFile');

Route::get('/show/{type?}', 'FileController@showFile');

Route::post('/upload', 'FileController@uploadFile');

Route::get('/delete/{fileName}', 'FileController@deleteFile');

Route::get('/download/{fileName}', 'FileController@downloadFile');
