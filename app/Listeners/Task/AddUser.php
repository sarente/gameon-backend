<?php

namespace App\Listeners\Task;

use App\Events\TaskSaved;
use App\Models\Classroom;
use App\Models\Pane;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Validation\ValidationException;

class AddUser implements ShouldQueue
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
        $task = $event->task;
        if($event->assigned_user){
            $assigned_user = User::findOrFail($event->assigned_user);
            $status =$event->status ?? 0;

            if (!$assigned_user) {
                throw new ValidationException($event->assigned_user, trans('errors.user.not-found'));
            }
            $task->assigned_user()->detach($assigned_user);
            $task->assigned_user()->attach($assigned_user, ['status' => $status]);
        }
    }
}
