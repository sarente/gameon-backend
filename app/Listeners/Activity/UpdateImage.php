<?php

namespace App\Listeners\Activity;

use App\Events\ActivitySaved;
use App\Models\Image;
use App\Models\Project;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class UpdateImage implements ShouldQueue
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
        $imageable_type = Project::class;
        $model = $event->project;
        $removable_images = $event->removable_images;

        //Remove Old images
        if (!is_null($removable_images) && is_array($removable_images) && count($removable_images) > 0) {
            $deleted_images = Image::where(function ($q) use ($model, $removable_images, $imageable_type) {
                $q->where(['imageable_id' => $model->id, 'imageable_type' => $imageable_type])->whereIn('name', $removable_images);
            });
            if ($deleted_images->exists()) {
                $deleted_images->forceDelete();
                Storage::disk('images')->delete($removable_images);
            }
        }
    }
}
