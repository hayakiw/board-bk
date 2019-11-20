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

    Route::resource('workspaces.groups', 'GroupController')->except([
        'index',
    ]);

    Route::resource('workspaces.groups.boards', 'BoardController');

    // コメント
    Route::post('workspaces/{workspace}/groups/{group}/{type}/{id}/comments', [
        'as' => 'workspaces.groups.comments.store',
        'uses' => 'CommentController@store',
    ])->where('type', '(board|event)');

    Route::get('workspaces/{workspace}/groups/{group}/{type}/{id}/comments/{comment}/edit', [
        'as' => 'workspaces.groups.comments.edit',
        'uses' => 'CommentController@edit',
    ])->where('type', '(board|event)');

    Route::put('workspaces/{workspace}/groups/{group}/{type}/{id}/comments/{comment}', [
        'as' => 'workspaces.groups.comments.update',
        'uses' => 'CommentController@update',
    ])->where('type', '(board|event)');

    Route::delete('workspaces/{workspace}/groups/{group}/{type}/{id}/comments/{comment}', [
        'as' => 'workspaces.groups.comments.destroy',
        'uses' => 'CommentController@destroy',
    ])->where('type', '(board|event)');

    //アカウント管理
    Route::get('workspaces/{workspace}/members', [
        'as' => 'workspace.members',
        'uses' => 'WorkspaceController@members',
    ]);

    Route::get('workspaces/{workspace}/member/invite', [
        'as' => 'workspace.member.invite_form',
        'uses' => 'WorkspaceController@inviteForm',
    ]);

    Route::post('workspaces/{workspace}/member/invite', [
        'as' => 'workspace.member.invite',
        'uses' => 'WorkspaceController@invite',
    ]);

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
