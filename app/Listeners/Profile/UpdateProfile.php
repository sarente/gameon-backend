<?php

namespace App\Listeners\User\Profile;

use App\Events\ProfileUpdate;
use App\Models\Tag;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Validation\ValidationException;

class UpdateProfile implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     * @param ProfileUpdate $event
     * @return void
     */
    public function handle(ProfileUpdate $event)
    {
        $description = $event->description;
        $user = $event->user;
        $profile = $event->profile;
        $profile->user()->associate($user);
        $profile->update([
            'description' => $description
        ]);
    }
}
