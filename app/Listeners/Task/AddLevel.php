<?php

namespace App\Listeners\Task;

use App\Events\TaskSaved;
use App\Models\Level;
use App\Models\Rosette;
use App\Models\Setting;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddLevel implements ShouldQueue
{
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
     * @param  TaskSaved  $event
     * @return void
     */
    public function handle(TaskSaved $event)
    {
        $task=$event->task;
        $level = Level::findOrFail($event->level);
        if(!$level){
            // -1 : These tasks are independent of levels
            $level=new Level([
                'max_xp' => 0,
                'is_active' => 0,
                'artifact' => trans(Setting::NO_ARTIFACT)
            ]);
            $level->save();
        }
        $task->level()->associate($level);
    }
}
