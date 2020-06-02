<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth','middleware'=>'jwt'], function () {


    Route::post('logout', 'api\AuthController@logout');
    Route::post('refresh', 'api\AuthController@refresh');
    Route::post('me', 'api\AuthController@me');

});
Route::post('auth/login', 'api\AuthController@login');