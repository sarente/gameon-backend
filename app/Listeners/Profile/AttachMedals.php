<?php

namespace App\Listeners\User\Profile;

use App\Events\LevelUp;
use App\Events\ActivitySaved;
use App\Models\Pane;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class AttachMedals implements ShouldQueue
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
     * @param ActivitySaved $event
     * @return void
     */
    public function handle(LevelUp $event)
    {
        $user = $event->user;
        //Get Medals
        if ($event->medal_id) {
            $user->profile->medals()->sync($event->medal_id, false);
        }

    }
}
