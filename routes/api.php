<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth','middleware'=>'jwt'], function () {


    Route::post('logout', 'api\AuthController@logout');
    Route::post('refresh', 'api\AuthController@refresh');


});

Route::post('auth/login', 'api\AuthController@login');
Route::post('auth/register', 'api\AuthController@register');
Route::post('auth/send-reset-password-email', 'api\ResetPasswordController@sendEmail');
Route::post('auth/reset-password', 'api\ChangePasswordController@process');