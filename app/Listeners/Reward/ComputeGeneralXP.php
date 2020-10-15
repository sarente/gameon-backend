<?php

namespace App\Listeners\Reward;

use App\Events\ActivitySaved;
use App\Events\ArtifactIsCompleted;
use App\Models\Pane;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Queue\InteractsWithQueue;

class ComputeGeneralXP implements ShouldQueue
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
        $artifact_name = Setting::ARTIFACT_GENERAL;

        foreach ($users as $key => $value) {
            $user_level_id = collect(Pane::getUserLevels($value))->where('artifact_name', $artifact_name)->first()['level_id'];
            if ($user_level_id) {
                $user = User::findOrFail($value);
                //Calculate Xp of model
                $current_xp = $user->getCurrentXp($user_level_id);
                $has_got_xp = $current_xp + $model->experience;
                $max_xp_level = Pane::findOrFail($user_level_id)->max_xp;

                if ($has_got_xp >= $max_xp_level) {
                    $user->levels()->updateExistingPivot($user_level_id, ['current_xp' => $has_got_xp]);

                    $new_level_id = $user_level_id + 1; //Check the user level is valid
                    if (in_array($new_level_id, Pane::where('artifact', $artifact_name)->pluck('id')->toArray())) {
                        $user->levels()->attach($new_level_id, ['current_xp' => 0, 'artifact_name' => $artifact_name]);
                    } else {
                        $user->levels()->updateExistingPivot($user_level_id, ['current_xp' => $current_xp]);
                        throw new HttpResponseException(response()->error('level.notfound', ['artifact_name' => $artifact_name]));
                    }
                    //TODO: level up events is happen and run the level up broadcast and set the user general level
                    broadcast(new \App\Events\LevelUp($user,$new_level_id,$has_got_xp));
                } else {
                    $user->levels()->updateExistingPivot($user_level_id, ['current_xp' => $has_got_xp]);
                }
                //Log::info('--user:' . $user->name . '--old_xp:' . $current_xp . '--' . $artifact_name . '_model_xp:' . $model->experience . '--has_got_xp:' . $has_got_xp . ' max_xp_level:' . $max_xp_level);
            }
        }
    }
}
