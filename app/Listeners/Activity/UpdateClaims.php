<?php

namespace App\Listeners\Activity;

use App\Events\ActivitySaved;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateClaims implements ShouldQueue
{
    use InteractsWithQueue;
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
     * @param  ActivitySaved  $event
     * @return void
     */
    public function handle(ActivitySaved $event)
    {
        $project = $event->project;
        $claims = User::find($event->claims);

        if($claims) {
            $project->claims()->detach();
            $project->claims()->attach($claims, ['is_member' => false]);// Claim user
        }
    }
}
