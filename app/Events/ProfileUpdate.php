<?php
/**
 * Created by PhpStorm.
 * User: Jawad Fathi
 * Date: 9/24/2019
 * Time: 3:05 PM
 */

namespace App\Events;

use App\Http\Requests\Api\ProfileRequest;
use App\Models\User;
use Illuminate\Queue\SerializesModels;

class ProfileUpdate extends Event
{
    use SerializesModels;
    public
        $user,
        $tags,
        $rosettes,
        $description,
        $removable_images,
        $profile;

    /**
     * Create a new event instance.
     * @return void
     */

    public function __construct(ProfileRequest $request,User $user)
    {
        $this->user = $user;
        $this->profile = $user->profile;
        $this->description = $request->description;
        $this->rosettes = $request->rosettes;
        $this->tags = $request->tags;
        $this->removable_images = $request->removable_images;
    }
}
