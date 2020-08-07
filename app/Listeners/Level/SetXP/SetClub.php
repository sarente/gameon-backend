<?php

namespace App\Listeners\Level\SetXP;

use App\Events\LevelConfigured;
use App\Models\Level;
use App\Models\Setting;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SetClub implements ShouldQueue
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
        $per_month =  $event->club_monthly?? Setting::getByKey(Setting::ARTIFACT_CLUB_MONTHLY) ?? 5;
        $percent = $event->club_xp ?? Setting::getByKey(Setting::ARTIFACT_CLUB_XP);
        Level::configXP($event->level_count, $event->education_term, $event->total_xp, Setting::ARTIFACT_CLUB, $per_month, $percent, null);
        //
        Setting::setByKey(Setting::CLUB_PER_MONTH, $per_month);
        Setting::setByKey(Setting::CLUB_PERCENT, $percent);

    }
}
