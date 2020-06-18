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


Route::post('/login', 'AuthController@login');

Route::middleware('auth:api')->post('/create-records', 'RouterDetailsController@apiCreate');

Route::middleware('auth:api')->post('/update-records', 'RouterDetailsController@apiUpdate');

Route::middleware('auth:api')->post('/list-records', 'RouterDetailsController@apiList');

Route::middleware('auth:api')->post('/delete-records', 'RouterDetailsController@apiDelete');