<?php

use Illuminate\Http\Request;

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
Route::post('login', 'Api\AuthController@login')->name('login');
Route::post('forget', 'Api\AuthController@forgot');
//Route::post('social/{provider}', 'Api\AuthController@social');

Route::group(['prefix' => 'auth.jwt'], function ($router) {
    Route::get('me', 'Api\AuthController@me');
    Route::get('refresh', 'Api\AuthController@refresh');
    Route::get('logout', 'Api\AuthController@logout');

    Route::resource('version', 'VersionController', ['only' => ['index']]);

    Route::get('user/avatar', 'Api\UserController@getAvatar');
    Route::post('user/avatar', 'Api\UserController@saveAvatarConfiguration');
    Route::get('user/get-my-categories', 'Api\UserController@getMyCategories');
    Route::resource('user', 'Api\UserController');

    Route::get('get-my-categories', 'Api\CategoryController@getMyCategories');
    Route::resource('category', 'Api\CategoryController');
    Route::post('category/{category}/sync-users', 'Api\CategoryController@syncUsers');

    Route::post('workflow/{workflow}/add-activity', 'Api\WorkflowController@addActivity');
    Route::resource('workflow', 'Api\WorkflowController');
});




