<?php

namespace App\Listeners\User\Profile;

use App\Events\ProfileUpdate;
use App\Models\Image;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
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
     * @param ProfileUpdate $event
     * @return void
     */
    public function handle(ProfileUpdate $event)
    {
        $imageable_type = User::class;
        $model = $event->user;
        $removable_images = $event->removable_images;

        //Remove Old images
        if (!is_null($removable_images) && is_array($removable_images) && count($removable_images) > 0) {
            $deleted_images = Image::where(function ($q) use ($model, $removable_images, $imageable_type) {
                $q->where(['imageable_id' => $model->id, 'imageable_type' => $imageable_type])->whereIn('name', $removable_images);
            });
            //dd($deleted_images->exists());
            if ($deleted_images->exists()) {
                $deleted_images->forceDelete();
                Storage::disk('images')->delete($removable_images);
            }
        }
    }
}
