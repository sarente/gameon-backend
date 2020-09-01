<?php

namespace App\Listeners\Level\SetXP;

use App\Events\LevelConfigured;
use App\Models\Pane;
use App\Models\Setting;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SetTask implements ShouldQueue
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
        // Set default per month if null
        $per_month = $event->task_monthly ?? Setting::getByKey(Setting::ARTIFACT_TASK_MONTHLY) ?? 5;
        $percent = $event->task_xp ?? Setting::getByKey(Setting::ARTIFACT_TASK_XP);
        Pane::configXP($event->level_count, $event->education_term, $event->total_xp, Setting::ARTIFACT_TASK, $per_month, $percent, null);
        //
        Setting::setByKey(Setting::TASK_PER_MONTH, $per_month);
        Setting::setByKey(Setting::TASK_PERCENT, $percent);

    }
}
