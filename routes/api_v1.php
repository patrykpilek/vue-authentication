<?php

use Illuminate\Support\Facades\Route;

Route::get('user/{id}', 'API\v1\UserController@user');
Route::get('users', 'API\v1\UserController@users');

Route::group(['prefix' => 'auth'], function () {
    Route::post('signin', 'API\v1\Auth\SignInController@signIn');
    Route::post('signup', 'API\v1\Auth\SignUpController@signUp');
    Route::get('email/verify/{token}', 'API\v1\Auth\VerifyEmailController@verifyEmail');

    Route::group(['middleware' => 'api', 'prefix' => 'password'], function () {
        Route::post('create', 'API\v1\Auth\PasswordResetController@create');
        Route::get('find/{token}', 'API\v1\Auth\PasswordResetController@find');
        Route::post('reset', 'API\v1\Auth\PasswordResetController@reset');
    });

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('signout', 'API\v1\Auth\SignOutController@signOut');
        Route::get('user', 'API\v1\Auth\UserController@user');
    });
});
