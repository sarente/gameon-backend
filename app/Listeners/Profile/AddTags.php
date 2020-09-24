<?php

namespace App\Listeners\User\Profile;

use App\Events\ProfileUpdate;
use App\Models\Tag;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddTags implements ShouldQueue
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
     * @param ProfileUpdate $event
     * @return void
     */
    public function handle(ProfileUpdate $event)
    {
        $model = $event->profile;
        $tags = $event->tags;

        if (!is_null($tags)) {
            $results = Tag::getOrCreateIds($tags);
            $model->tags()->sync($results);
        }
    }
}
