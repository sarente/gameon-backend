<?php

namespace App\Listeners\Activity;

use App\Events\ActivitySaved;
use App\Models\Tag;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
    public function handle(ActivitySaved $event)
    {
        $model = $event->project;
        $tags = $event->tags;
        if (!is_null($tags)) {
            $results = Tag::getOrCreateIds($tags);
            $model->tags()->sync($results);
        }
    }
}
