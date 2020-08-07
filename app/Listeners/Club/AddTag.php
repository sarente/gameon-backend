<?php

namespace App\Listeners\Club;

use App\Events\ClubSaved;
use App\Models\Tag;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Validation\ValidationException;

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
     * @param ClubSaved $event
     * @return void
     */
    public function handle(ClubSaved $event)
    {
        $model = $event->club;
        $tags = $event->tags;
        if (!is_null($tags)) {
            $results = Tag::getOrCreateIds($tags);
            $model->tags()->sync($results);
        }
    }

}
