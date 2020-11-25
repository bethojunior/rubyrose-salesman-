<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user'], function () {
    Route::group(['as' => 'user.'], function () {
        Route::put('insert','User\UserController@insert')->name('insert');
    });
});
