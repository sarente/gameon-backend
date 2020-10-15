<?php

namespace App\Listeners\Task;

use App\Events\TaskSaved;
use App\Models\Image;
use App\Models\Task;
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
     * @param TaskSaved $event
     * @return void
     */
    public function handle(TaskSaved $event)
    {
        $imageable_type = Task::class;
        $model = $event->task;
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
