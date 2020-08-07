<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();


Route::middleware('auth:web')->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('admin', 'Admin\AdminController@index');
    Route::resource('admin/roles', 'Admin\RolesController');
    Route::resource('admin/permissions', 'Admin\PermissionsController');
    Route::resource('admin/users', 'Admin\UsersController');
    Route::resource('admin/profiles', 'Admin\ProfileController');


    Route::resource('admin/projects', 'Admin\ProjectController');
    Route::resource('admin/projects/{project}/step', 'Admin\StepController');
    Route::post('admin/projects/{project}/claim', 'Admin\ProjectUserController@makeClaim');
    Route::post('admin/projects/{project}/user/{user}/accept', 'Admin\ProjectUserController@acceptClaim');
    Route::post('admin/projects/{project}/user/{user}/reject', 'Admin\ProjectUserController@rejectClaim');
    Route::post('admin/projects/{project}/user', 'Admin\ProjectUserController@addMember');
    Route::post('admin/projects/{project}/user/delete', 'Admin\ProjectUserController@deleteMember');
    Route::get('admin/projects/{project}/user/{role}', 'Admin\ProjectUserController@create');
    Route::get('admin/projects/{project}/user/delete', 'Admin\ProjectUserController@delete');

    Route::resource('admin/levels', 'Admin\LevelController');

    Route::resource('admin/message', 'Admin\MessageController');

    Route::resource('admin/projects/{project}/post', 'Admin\ProjectPostController');
    Route::delete('project/{project}/post/{post}', 'Admin\ProjectPostController@deletePost');

    Route::post('admin/question/{question}', 'Admin\QuestionController@update');
    Route::resource('admin/question', 'Admin\QuestionController');

    Route::resource('admin/clubs', 'Admin\ClubController');
    Route::resource('admin/rosettes', 'Admin\RosetteController');
    Route::resource('admin/pages', 'Admin\PagesController');
    Route::resource('admin/activitylogs', 'Admin\ActivityLogsController')->only([
        'index', 'show', 'destroy'
    ]);
    Route::resource('admin/settings', 'Admin\SettingsController');

    Route::resource('admin/task', 'Admin\TaskController');

    Route::get('admin/open-level-up', function () {
        //broadcast(new \App\Events\LevelUp(\App\Models\User::find(1), \App\Models\User::find(1)));
        broadcast(new \App\Events\Notification(\App\Models\User::find(1)));
        //broadcast(new \App\Events\Notification);
    });
});

Route::resource('socket', 'Admin\SocketController');

Route::get('/pub', function () {
    \Illuminate\Support\Facades\Redis::Publish('notification', json_encode(['foo' => 'bar']));
});

Route::get('/sub', function () {
    \Illuminate\Support\Facades\Redis::subscribe(['notification'], function ($message) {
        var_dump($message);
    });
});

Route::middleware('auth:api')->post('broadcasting/auth', 'Broadcast\AuthController@login');
