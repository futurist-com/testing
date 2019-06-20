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
//@todo dell
//Route::get('login', 'PassportController@login');
//Route::post('register', 'PassportController@register');
/* 
Route::middleware('auth:api')->group(function () {
    Route::get('user', 'PassportController@details');
 
Route::resource('products', 'ProductController');
});
*/
Route::post('/register', 'API\AuthController@register');
Route::post('/login', 'API\AuthController@login');
Route::get('/get-email', 'API\AuthController@getEmail');

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', 'API\AuthController@logout');
    Route::get('/get-user', 'API\AuthController@getUser');
});