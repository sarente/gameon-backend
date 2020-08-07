<?php

namespace App\Listeners\Club;

use App\Events\ClubSaved;
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
     * Handle the event.
     * @param ClubSaved $event
     * @return void
     */
    public function handle(ClubSaved $event)
    {
        $model = $event->club;
        if ($event->members) {
            $members = User::find($event->members);
            if ($members) {
                $model->members()->detach();
                $model->members()->attach($members, ['is_member' => true]);

            }
        } elseif ($event->claims) {
            $claims = User::find($event->claims);
            if ($claims) {
                $model->claims()->detach();
                $model->members()->attach($claims, ['is_member' => false]);
            }
        }
    }
}
