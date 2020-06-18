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

Route::get('/', 'RouterDetailsController@index');

Route::post('/', 'RouterDetailsController@create');
Route::get('/edit-details/{id}' , 'RouterDetailsController@editView');
Route::post('/editSubmit', 'RouterDetailsController@update');
Route::get('/delete-details/{id}' , 'RouterDetailsController@deleteDetails');



// Draw Shapes
Route::get('/draw-shapes' , 'ShapeController@draw');

Route::get('/sql-view' , 'RouterDetailsController@generateView');


Route::view('/api-showcase', 'apiview.index');
