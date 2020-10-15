<?php

namespace App\Listeners\Level\SetXP;

use App\Events\LevelConfigured;
use App\Models\Pane;
use App\Models\Setting;
use Illuminate\Contracts\Queue\ShouldQueue;

class SetQA implements ShouldQueue
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
        $per_month = $event->qa_monthly ?? Setting::getByKey(Setting::ARTIFACT_QA_MONTHLY) ?? 5;
        $percent = $event->qa_xp ?? Setting::getByKey(Setting::ARTIFACT_QA_XP);
        Pane::configXP($event->level_count, $event->education_term, $event->total_xp, Setting::ARTIFACT_QUESTION_ANSWER, $per_month, $percent, null);
        //
        Setting::setByKey(Setting::QA_PER_MONTH, $per_month);
        Setting::setByKey(Setting::QA_PERCENT, $percent);

    }
}
