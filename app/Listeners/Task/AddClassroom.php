<?php

namespace App\Listeners\Task;

use App\Events\TaskSaved;
use App\Models\Classroom;
use App\Models\Pane;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddClassroom implements ShouldQueue
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
        if($event->assigned_classroom){
            $classroom = Classroom::findOrFail($event->assigned_classroom);

            if($classroom){
                $task->assigned_classroom()->sync($classroom);
            }
        }
    }
}
