<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

//Broadcast::channel('user.{id}', \App\Broadcasting\LevelUpChannel::class);
Broadcast::channel('user.{id}', function ($user, $id) {
    return $user->id === (int) $id;
});

Broadcast::channel('notification', \App\Broadcasting\NotificationChannel::class);
Broadcast::channel('survey.{survey_id}', function ($user, $survey_id) {return ['id' => $user->id,'image' => $user->image(),'full_name' => $user->full_name];});

