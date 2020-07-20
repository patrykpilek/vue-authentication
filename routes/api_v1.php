<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('signin', 'API\v1\Auth\SignInController@signIn');
    Route::post('signup', 'API\v1\Auth\SignUpController@signUp');
    Route::get('email/verify/{token}', 'API\v1\Auth\VerifyEmailController@verifyEmail');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('signout', 'API\v1\Auth\SignOutController@signOut');
        Route::get('user', 'API\v1\Auth\UserController@user');
    });
});
