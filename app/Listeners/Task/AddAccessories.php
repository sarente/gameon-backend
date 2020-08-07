<?php

namespace App\Listeners\Task;

use App\Events\TaskSaved;
use App\Models\Accessory;
use App\Models\Setting;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddAccessories implements ShouldQueue
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
        $model = $event->task;
        if($event->accessories){
            $accessories = Accessory::findOrFail($event->accessories);
            if($accessories){
                $model->accessories()->sync($accessories);
            }
        }
    }
}
