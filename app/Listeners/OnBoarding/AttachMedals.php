<?php

namespace App\Listeners\OnBoarding;

use App\Events\ActivitySaved;
use App\Events\OnBoardingLevelUp;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
    public function handle(OnBoardingLevelUp $event)
    {
        $medals = $event->medals;
        $profile = $event->user->profile;
        //Attach medals to profile
        if(!is_null($medals) && !empty($medals)) {
            $profile->medals()->sync($medals, false);
        }
        unset($event->medals);
    }
}
