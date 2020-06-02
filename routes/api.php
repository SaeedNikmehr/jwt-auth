<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'jwt'], function () {

    Route::post('auth/logout', 'api\AuthController@logout');
    Route::post('auth/refresh', 'api\AuthController@refresh');

    Route::get('users', 'api\UserController@users');
    Route::post('users/register', 'api\UserController@register');
    Route::put('users/{id}', 'api\UserController@update');
    Route::delete('users/{id}', 'api\UserController@delete');


});

Route::post('auth/login', 'api\AuthController@login');
Route::post('auth/register', 'api\AuthController@register');
Route::post('auth/send-reset-password-email', 'api\ResetPasswordController@sendEmail');
Route::post('auth/reset-password', 'api\ChangePasswordController@process');