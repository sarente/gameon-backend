<?php

namespace App\Listeners\Question;

use App\Events\QuestionSaved;
use App\Models\Image;
use App\Models\Question;
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
     * @param QuestionSaved $event
     * @return void
     */
    public function handle(QuestionSaved $event)
    {
        $imageable_type = Question::class;
        $model = $event->model;
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
