<?php

namespace App\Listeners\Workflow;

use App\Events\WorkflowDone;
use App\Models\UserWorkflow;
use Illuminate\Support\Facades\Log;

class NextCategoryEnabled
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
     * @param ModelCreated $event
     * @return void
     */
    public function handle(WorkflowDone $event)
    {
        $model = $event->customWorkflow;
        $user = $event->user;
        Log::info($user->id);
        //Enable next category
        $condition = UserWorkflow::where('user_id', $user->id)->where('marking', '!=', '"done"')->exists();
        Log::info($condition);
        
        if (!$condition) {
            Log::info('true----------------------------------' . $user->id);
            $nextcatid = (int)$model->category->id + 1;
            $user->categories()->syncWithoutDetaching([$nextcatid => ['enable' => 1]]);
        }
    }
}
