<?php

namespace App\Listeners\Task;

use App\Events\TaskSaved;
use App\Models\Accessory;
use App\Models\Precondition;
use App\Models\Setting;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddPrecondition implements ShouldQueue
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
     * @param TaskSaved $event
     * @return void
     */
    public function handle(TaskSaved $event)
    {
        //Check for task id to update old one
        $model = $event->task;

        $task = $event->pre_task;
        $rosettes = $event->pre_rosettes;
        $level = $event->pre_level;

        if ($task && $rosettes && $level) {

            $Precondition = new Precondition();
            $Precondition->fill([
                'task' => json_encode(array($task)),
                'rosettes' => json_encode($rosettes),
                'level' => json_encode(array($level)),
            ]);
            $Precondition->save();
            $model->precondition()->associate($Precondition);
            $model->save();
        }
    }
}
