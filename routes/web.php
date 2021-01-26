<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'user'], function () {
        Route::group(['as' => 'user'], function () {
            Route::get('/find', 'User\UserController@find')->name('.find');
//            Route::get('', 'User\UserController@index')->name('.index');
//            Route::get('create','User\UserController@create')->name('.create');
//            Route::post('insert', 'User\UserController@insert')->name('.insert');
//            Route::get('{id}', 'User\UserController@findById')->name('.find');
            Route::put('', 'User\UserController@update')->name('.update');
        });
    });


    Route::group(['prefix' => 'products'], function () {
        Route::group(['as' => 'products'], function () {
//            Route::get('', 'Products\ProductsController@index')->name('.index');
            Route::get('list', 'Products\ProductsController@show')->name('.show');
//            Route::post('insert', 'Products\ProductsController@insert')->name('.insert');
        });
    });


//    Route::group(['prefix' => 'typeProduct'], function () {
//        Route::group(['as' => 'typeProduct'], function () {
//            Route::get('', 'TypeProduct\TypeProductController@index')->name('.index');
//            Route::post('insert', 'TypeProduct\TypeProductController@insert')->name('.insert');
//        });
//    });

    Route::group(['prefix' => 'sales'], function () {
        Route::group(['as' => 'sales'], function () {
//            Route::get('', 'Sales\SalesController@index')->name('.index');
        });
    });

    Route::group(['prefix' => 'blog'], function () {
        Route::group(['as' => 'blog'], function () {
            Route::get('', 'Blog\BlogController@list')->name('.index');
        });
    });

    Route::group(['prefix' => 'us'], function () {
        Route::group(['as' => 'us'], function () {
            Route::get('', 'Us\UsController@index')->name('.index');
        });
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::group(['as' => 'settings'], function () {
            Route::get('sales', 'Settings\SettingsController@talkWithSales')->name('.talkWithSales');
            Route::get('sac', 'Settings\SettingsController@sac')->name('.sac');
            Route::get('social', 'Settings\SettingsController@social')->name('.social');
        });
    });





});

