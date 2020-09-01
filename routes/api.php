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
//Auth::routes();

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


Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('register', ['as' => 'auth.register', 'uses' => 'Api\AuthController@register']);
    Route::post('login', ['as' => 'auth.login', 'uses' => 'Api\AuthController@login']);
    Route::post('forget', ['as' => 'auth.forgot', 'uses' => 'Api\AuthController@forgot']);
    Route::post('social/{provider}', ['as' => 'auth.social', 'uses' => 'Api\AuthController@social']);
    Route::middleware('auth:api')->get('logout', ['as' => 'auth.logout', 'uses' => 'Api\AuthController@logout']);

});

//Test for Orhun Gorkem
Route::resource('tag-test', 'Api\TagController');
Route::get('setting1', 'Api\TestController@getSetting');
Route::get('user-names', 'Api\TestController@getUsersNames');
Route::get('send-mail', 'Api\TestController@sendTestEmail');


