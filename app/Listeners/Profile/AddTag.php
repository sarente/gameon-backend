<?php

namespace App\Listeners\Profile;

use App\Events\ActivitySaved;
use App\Events\ProfileUpdate;
use App\Models\Tag;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddTag implements ShouldQueue
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
    public function handle(ProfileUpdate $event)
    {
        $profile = $event->profile;
        $tags = $event->tags;

        $results = Tag::getOrCreateIds($tags);
        $profile->tags()->sync($results);
    }
}
