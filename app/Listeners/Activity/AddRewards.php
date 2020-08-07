<?php

namespace App\Listeners\Activity;

use App\Events\ActivitySaved;
use App\Models\Reward;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddRewards implements ShouldQueue
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
        $model = $event->activity;
        if ($event->rosettes) {
            $rosettes = Reward::find($event->rosettes);
            $model->rewards()->sync($rosettes,false);
        }
    }
}
