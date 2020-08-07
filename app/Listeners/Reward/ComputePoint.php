<?php

namespace App\Listeners\Reward;

use App\Events\ArtifactIsCompleted;
use App\Events\ActivitySaved;
use App\Models\Level;
use App\Models\Point;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class ComputePoint implements ShouldQueue
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
        $artifact_name = strtolower(class_basename($model));
        //Convert all point to general if is not question-answer
        //$artifact_name = $artifact_name==Setting::ARTIFACT_QUESTION_ANSWER ?Setting::ARTIFACT_QUESTION_ANSWER:Setting::ARTIFACT_GENERAL;
        $artifact_name = $artifact_name==Setting::ARTIFACT_QUESTION ?Setting::ARTIFACT_QUESTION_ANSWER:Setting::ARTIFACT_GENERAL;

        foreach ($users as $key=>$value) {
            $user=User::findOrFail($value);
            //Add user point to user_point
            if (!is_null($model->point)) {
                Point::create([
                    'user_id' => $user->id,
                    'point' => $model->point,
                    'artifact_name' => $artifact_name,
                ]);
            }
            //Log::info('user: ' . $user->name . ' model_point:' . $model->point);
        }
    }
}
