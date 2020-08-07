<?php

namespace App\Events;

use App\Http\Requests\Api\ClubRequest;
use App\Http\Requests\Request;
use App\Models\Club;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ClubSaved extends Event
{
    use SerializesModels;
    public $club,
        $user,
        $tags,
        $members,
        $images,
        $removable_images,
        $claims;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ClubRequest $request, Club $club)
    {
        $this->club = $club;
        $this->user = $request->user();
        $this->tags = $request->tags;
        $this->members = $request->members;
        $this->claims = $request->claims;
        $this->removable_images = $request->removable_images;
    }
}
