<?php

namespace App\Listeners\Activity;

use App\Events\ActivitySaved;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Permission;

class AddMembers implements ShouldQueue
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
     * Control claims or members request
     * @param ActivitySaved $event
     * @return void
     */
    public function handle(ActivitySaved $event)
    {
        $model = $event->project;
        if ($event->members) {
            $members = User::find($event->members);
            if ($members) {
                $model->members()->detach();
                $model->members()->attach($members, ['is_member' => true]);

                foreach ($members as $member) {
                    if ($member->hasRole(Setting::ROLE_STUDENT)) {

                        foreach ($model->steps as $step) {
                            $step->users()->attach($member);
                        }
                    }
                }
            }
        } else {
            $claims = User::find($event->claims);
            if ($claims) {
                $model->claims()->detach();
                $model->members()->attach($claims, ['is_member' => false]);
            }
        }
    }
}
