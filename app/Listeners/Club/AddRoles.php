<?php

namespace App\Listeners\Club;

use App\Events\ClubSaved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class AddRoles implements ShouldQueue
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
        // get club
        $model = $event->club;
        Log::info('Log from event listener '.$model->id);
    }
}
