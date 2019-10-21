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

Route::post('/register', 'API\AuthController@register');
Route::post('/login', 'API\AuthController@login');
Route::get('/get-email', 'API\AuthController@getEmail');
Route::put('/confirm-email', 'API\AuthController@confirmEmail');
Route::post('reset-password', 'API\ResetPasswordController@sendPasswordResetLink');
Route::post('reset/password', 'API\ResetPasswordController@callResetPassword');
Route::post('reset/check-code-password', 'API\ResetPasswordController@checkCodeResetPassword');
//Route::get('/get-company', 'API\CompanyController@show');

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', 'API\AuthController@logout');
    Route::get('/get-user', 'API\AuthController@getUser');
    Route::get('/get-companies', 'API\CompanyController@show');
    Route::get('/get-company/{id}', 'API\CompanyController@getCompany');
    
    Route::post('/add-company', 'API\CompanyController@store');
});
