<?php

namespace App\Listeners\User;

use App\Events\UserCreated;
use App\Models\Level;

class SetDefaultLevel
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

        //Set user experience 0 for first time
        $artifacts = Level::where('artifact_status', 0)->pluck('artifact', 'id');
        foreach ($artifacts as $key => $value) {
            $user->levels()->attach($key, ['artifact_name' => $value, 'current_xp' => 0]);
        }
    }
}
