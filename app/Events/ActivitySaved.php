<?php
/**
 * Created by PhpStorm.
 * User: Jawad Fathi
 * Date: 9/24/2019
 * Time: 3:05 PM
 */

namespace App\Events;

use App\Http\Requests\Api\ActivityRequest;
use App\Http\Requests\Request;
use App\Events\Event;
use App\Models\Activity;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ActivitySaved extends Event
{
    use SerializesModels;
    public $activity,
        $user,
        $tags,
        $rosettes,
        $users,
        $removable_images;

    /**
     * Create a new event instance.
     * @return void
     */


    public function __construct(ActivityRequest $request, Activity $activity)
    {
        $this->activity = $activity;
        $this->user = $request->user();
        $this->tags = $request->tags;
        $this->rosettes = $request->rewards;
        $this->users = $request->users;
        $this->removable_images = $request->removable_images;
    }
}
