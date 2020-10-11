<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');
Route::post('forget', 'Api\AuthController@forgot');
//Route::post('social/{provider}', 'Api\AuthController@social');
Route::resource('version', 'VersionController', ['only' => ['index']]);

//Admin
Route::group(['prefix'=> 'admin','middleware' => ['auth.jwt','role:admin']],function ($router) {

    //Categories
    Route::resource('category', 'Api\Admin\CategoryController');

    //WorkFlow
    Route::resource('workflow', 'Api\Admin\WorkflowController');

    //Activity
    Route::get('activity-kinds', 'Api\Admin\ActivityController@getActivityKinds');
    Route::resource('activity', 'Api\Admin\ActivityController');

	//Reward
    Route::resource('reward', 'Api\Admin\RewardController');
});

//Other users
Route::group(['middleware' => 'auth.jwt'], function ($router) {

    //User Management
    Route::get('me', 'Api\AuthController@me');
    Route::get('refresh', 'Api\AuthController@refresh');
    Route::get('logout', 'Api\AuthController@logout');

    //User Info
    Route::get('user/result', 'Api\UserController@result');
    Route::resource('user', 'Api\UserController');

    //Avatar
    Route::get('user/avatar', 'Api\UserController@getAvatar');
    Route::post('user/avatar', 'Api\UserController@saveAvatarConfiguration');

    //Categories
    Route::resource('category', 'Api\CategoryController');

    //WorkFlow
    Route::resource('workflow', 'Api\WorkflowController');
    Route::post('workflow/{workflow}/preceed', 'Api\WorkflowController@proceed');

    //Activity
    Route::resource('activity', 'Api\ActivityController');

    //Result
    Route::resource('result', 'Api\ResultController');

});


Route::get('do-action', 'Api\Admin\TestController@doAction');
Route::post('return-value', 'Api\Admin\TestController@returnValue');
