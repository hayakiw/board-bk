<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/



Route::group(['middleware' => ['guest:web']], function () {
    Route::get('signup', [
        'as' => 'account.create',
        'uses' => 'AccountController@create',
    ]);

    Route::post('signup', [
        'as' => 'account.store',
        'uses' => 'AccountController@store',
    ]);

    Route::get('activate/{token}/{wsid?}', [
        'as' => 'account.confirm',
        'uses' => 'AccountController@confirm',
    ])->where([
        'token' => '[a-z0-9]+', 'wsid' => '[0-9]*',
    ]);

    Route::post('activate', [
        'as' => 'account.activate',
        'uses' => 'AccountController@activate',
    ]);

    Route::get('signin', [
        'as' => 'auth.signin_form',
        'uses' => 'AuthController@signinForm',
    ]);

    Route::post('signin', [
        'as' => 'auth.signin',
        'uses' => 'AuthController@signin',
    ]);

});

Route::group(['middleware' => ['auth:web']], function () {
    Route::get('signout', [
        'as' => 'auth.signout',
        'uses' => 'AuthController@signout',
    ]);

    Route::get('/', [
        'as' => 'root.index',
        'uses' => 'RootController@index',
    ]);

    Route::resource('workspaces', 'WorkspaceController');

    //アカウント管理
    Route::group(['middleware' => ['auth:web', 'can:account']], function () {
        Route::resource('accounts', 'AccountController');
    });

});

Route::group(['namespace' => 'Admin', 'prefix' => '_admin'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('signin', [
            'as' => 'admin.auth.signin_form',
            'uses' => 'AuthController@signinForm',
        ]);
        Route::post('signin', [
            'as' => 'admin.auth.signin',
            'uses' => 'AuthController@signin',
        ]);
    });

    Route::group(['middleware' => 'auth:admin', 'as' => 'admin.'], function () {
        Route::get('signout', [
            'as' => 'auth.signout',
            'uses' => 'AuthController@signout',
        ]);

        Route::get('/', [
            'as' => 'root.index',
            'uses' => 'RootController@index',
        ]);
    });
});
