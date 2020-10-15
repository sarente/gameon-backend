<?php

namespace App\Listeners\User\Profile;

use App\Events\UserCreated;
use App\Models\Pane;
use App\Models\Profile;

class CreateProfile
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $user = $event->user;

        $profile = new Profile();
        $profile->user()->associate($user);
        $profile->save();
    }
}
