<?php

namespace App\Listeners\Level\SetXP;

use App\Events\LevelConfigured;
use App\Models\Pane;
use App\Models\Setting;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SetProject implements ShouldQueue
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
        $per_month = $event->project_monthly ?? Setting::getByKey(Setting::ARTIFACT_PROJECT_MONTHLY) ?? 5;
        $percent = $event->project_xp ?? Setting::getByKey(Setting::ARTIFACT_PROJECT_XP);
        Pane::configXP($event->level_count, $event->education_term, $event->total_xp, Setting::ARTIFACT_PROJECT, $per_month, $percent, null);
        //
        Setting::setByKey(Setting::PROJECT_PER_MONTH, $per_month);
        Setting::setByKey(Setting::PROJECT_PERCENT, $percent);
    }
}
