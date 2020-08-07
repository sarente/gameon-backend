<?php

namespace App\Listeners\Task;

use App\Events\TaskSaved;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddEndorser implements ShouldQueue
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
        $user = $event->user;
        $model = $event->task;
        $endorser=User::find($event->endorser) ?? $user;
        $model->endorser()->associate($endorser);
    }
}
