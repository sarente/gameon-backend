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

Route::resource('workflow', 'Api\WorkflowController');
Route::post('workflow/{workflow}/add-state', 'Api\WorkflowController@addState');

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('register', ['as' => 'auth.register', 'uses' => 'Api\AuthController@register']);
    Route::post('login', ['as' => 'auth.login', 'uses' => 'Api\AuthController@login']);
    Route::post('forget', ['as' => 'auth.forgot', 'uses' => 'Api\AuthController@forgot']);
    Route::post('social/{provider}', ['as' => 'auth.social', 'uses' => 'Api\AuthController@social']);
    Route::middleware('auth:api')->get('logout', ['as' => 'auth.logout', 'uses' => 'Api\AuthController@logout']);

});

Route::group(['middleware' => 'auth:api'], function ($router) {

    /*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
    Route::get('user/run-demo-data', 'Api\UserController@runDemoData');
    Route::post('user/import', 'Api\UserController@import');
    Route::get('user/export', 'Api\UserController@export');
    Route::get('user/get-me', 'Api\UserController@getMe');
    Route::get('user/get-all-users', 'Api\UserController@getAllUsers');
    Route::post('user/{user}', 'Api\UserController@update');
    Route::get('user/surveys', 'Api\UserController@getUserSurvey');
    Route::get('user/{user}/asked-questions', 'Api\UserController@getAskedQuestion');
    Route::resource('user', 'Api\UserController');
    Route::get('user/{user}/project', 'Api\UserController@getProjects');
    Route::get('user/{user}/club', 'Api\UserController@getClubs');
    Route::get('user/{user}/task', 'Api\UserController@getTasks');
    Route::get('user/{user}/classroom', 'Api\UserController@getClassrooms');



    /*
    |--------------------------------------------------------------------------
    | Dashoard Routes
    |--------------------------------------------------------------------------
    */
    Route::get('dashboard/summary', 'Api\DashboardController@getSummary');
    Route::get('dashboard/summary/{user}', 'Api\DashboardController@getUserSummary');

    /*
    |--------------------------------------------------------------------------
    | Profile Routes
    |--------------------------------------------------------------------------
    */
    Route::any('user/{user}/classmate', 'Api\UserController@classmate');
    Route::post('user/{user}/profile', 'Api\ProfileController@update');
    Route::get('user/{user}/profile', 'Api\ProfileController@show');
    Route::resource('user/{user}/claim', 'Api\ClaimController'); //make
    Route::resource('profile/{profile}/claim', 'Api\ClaimController'); //Accept and reject
    Route::delete('profile/{profile}/friend/{friend}', 'Api\ProfileController@deleteFriend');
    Route::get('profile/{profile}/medals', 'Api\ProfileController@getMedals');

    //user profile posts
    Route::post('profile/{profile}/post', 'Api\PostController@store');
    /*
      |--------------------------------------------------------------------------
      | User Awards Routes
      |--------------------------------------------------------------------------
      */
    Route::get('user/{user}/rosette', 'Api\UserController@getRosettes');
    Route::get('user/{user}/medal', 'Api\UserController@getMedals');
    Route::get('user/{user}/badge', 'Api\UserController@getBadges');
    /*
   |--------------------------------------------------------------------------
   | Introduction Routes
   |--------------------------------------------------------------------------
   */
    Route::get('introduction/completed', 'Api\IntroductionController@completed');
    Route::get('introduction/get-by-order', 'Api\IntroductionController@getByOrder');
    Route::post('introduction/done-event', 'Api\IntroductionController@doneEvent');
    Route::resource('introduction', 'Api\IntroductionController');
    /*
    |--------------------------------------------------------------------------
    | Avatar Routes
    |--------------------------------------------------------------------------
    */
    Route::get('item/{type}', 'Api\AvatarItemController@index');
    Route::get('item/{type}/gender/{gender}', 'Api\AvatarItemController@getByGender');
    Route::get('item/{type}/{item}', 'Api\AvatarItemController@show');
    Route::post('item/{type}', 'Api\AvatarItemController@store');
    Route::post('item/{type}/{item}', 'Api\AvatarItemController@update');
    Route::delete('item/{type}/{item}', 'Api\AvatarItemController@destroy');
    Route::post('test', 'Api\AvatarController@test');
    //Route::get('postures', 'Api\AvatarController@getPosetures');

    Route::post('user/{user}/avatar', 'Api\AvatarController@store');
    Route::post('user/{user}/avatar/equip', 'Api\AvatarController@wear');
    Route::post('user/{user}/avatar/{type}/{id}', 'Api\AvatarController@buy');
    Route::post('user/{user}/avatar/posture', 'Api\AvatarController@changePose');
    Route::get('user/{user}/avatar', 'Api\AvatarController@show');
    /*
   |--------------------------------------------------------------------------
   | Activity
   |--------------------------------------------------------------------------
   */
    Route::resource('status', 'Api\StatusController');

    Route::resource('activity', 'Api\ActivityController');
    Route::post('activity/{activity}/update-user-status', 'Api\ActivityController@updateStatus');
    Route::post('activity/{activity}/update-my-status', 'Api\UserController@updateActivityStatus');

    Route::post('activity/{activity}/post-add', 'Api\PostController@store');
    Route::resource('post', 'Api\PostController');

    /*|--------------------------------------------------------------------------
  |Activity Log
  |--------------------------------------------------------------------------
*/
    Route::get('activity-log/user-tracking', 'Api\ActivityLogController@getUserTracking');

});
//Test for Orhun Gorkem
Route::resource('tag-test', 'Api\TagController');
Route::get('setting1', 'Api\TestController@getSetting');
Route::get('user-names', 'Api\TestController@getUsersNames');
Route::get('send-mail', 'Api\TestController@sendTestEmail');


