<?php

namespace App\Listeners\OnBoarding;

use App\Events\OnBoardingLevelUp;
use App\Events\ProfileUpdate;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
    public function handle(OnBoardingLevelUp $event)
    {
        $rosettes = $event->rosettes;
        $profile = $event->user->profile;
        //Attach rosettes to profile
        if(!is_null($rosettes) && !empty($rosettes)) {
            $profile->rosettes()->sync($rosettes, false);
        }
        unset($event->rosettes);
    }
}
