<?php

namespace App\Listeners\User\Profile;

use App\Events\ProfileUpdate;
use App\Models\Rosette;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AttachRosettes implements ShouldQueue
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
     * @param  ProfileUpdate  $event
     * @return void
     */
    public function handle(ProfileUpdate $event)
    {
        //model is Profile
        $model = $event->profile;
        if ($event->rosettes) {
            $rosettes = Rosette::find($event->rosettes);
            $model->rosettes()->sync($rosettes,false);
        }
    }
}
