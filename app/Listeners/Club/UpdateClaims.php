<?php

namespace App\Listeners\Club;

use App\Events\ClubSaved;
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
     * @param  ClubSaved  $event
     * @return void
     */
    public function handle(ClubSaved $event)
    {
        $club = $event->club;
        $claims = User::find($event->claims);

        if($claims) {
            $club->claims()->detach();
            $club->claims()->attach($claims, ['is_member' => false]);// Claim user
        }
    }
}
