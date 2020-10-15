<?php

namespace App\Listeners\Reward;

use App\Events\ActivitySaved;
use App\Events\ArtifactIsCompleted;
use App\Models\Pane;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AttachRosette implements ShouldQueue
{
    use InteractsWithQueue;

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
     * @param ActivitySaved $event
     * @return void
     */
    public function handle(ArtifactIsCompleted $event)
    {
        $model = $event->model;
        $users = $event->users;
        //Check the reward of artifact
        //Get the level ID user in each artifact
        //$artifact_name = strtolower(class_basename($model));

        foreach ($users as  $key=>$value) {
            $user=User::findOrFail($value);
            //Get rosette
            if (!is_null($model->rosettes)) {
                $user->profile->rosettes()->sync($model->rosettes,false);
            }
        }
    }
}
