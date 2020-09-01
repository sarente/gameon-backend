<?php

namespace App\Listeners\Level\SetXP;

use App\Events\LevelConfigured;
use App\Models\Pane;
use App\Models\Setting;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SetGeneral implements ShouldQueue
{
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
     * @param LevelConfigured $event
     * @return void
     */
    public function handle(LevelConfigured $event)
    {
        $general_max_xp = Pane::whereIn('artifact', [
            Setting::ARTIFACT_PROJECT,
            Setting::ARTIFACT_CLUB,
            Setting::ARTIFACT_TASK,
            //Setting::ARTIFACT_SQUARE,
            Setting::ARTIFACT_QUESTION_ANSWER
        ])
            ->where('artifact_status', 0)
            ->pluck('max_xp')->sum();
        //FIXME: sum of default value in array
        if (is_null($general_max_xp)) {
            $general_max_xp=1050;
        }
        Pane::configXP($event->level_count, null, null, Setting::ARTIFACT_GENERAL, null, null, $general_max_xp);

    }
}
