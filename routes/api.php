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
    Route::resource('category', 'Api\Admin\CategoryController');
});

//Other users
Route::group(['middleware' => 'auth.jwt'], function ($router) {

    //User Management
    Route::get('me', 'Api\AuthController@me');
    Route::get('refresh', 'Api\AuthController@refresh');
    Route::get('logout', 'Api\AuthController@logout');

    //Avatar
    Route::get('user/avatar', 'Api\UserController@getAvatar');
    Route::post('user/avatar', 'Api\UserController@saveAvatarConfiguration');

    Route::resource('user', 'Api\UserController');

    //Categories
    Route::resource('category', 'Api\CategoryController');

    //WorkFlow
    Route::resource('workflow', 'Api\WorkflowController');

    //Activity Result
    Route::post('workflow/{workflow}/activity-result/{activity_result}', 'Api\ActivityResultController@checkValidity');
});


Route::get('get-workflow', 'Api\Admin\TestController@getWorkflow');
Route::post('wf-return-value', 'Api\Admin\TestController@test1');




