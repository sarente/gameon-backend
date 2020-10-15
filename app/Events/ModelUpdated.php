<?php

namespace App\Events;

use App\Http\Requests\Request;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ModelUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $model,
        $type,
        $removable_images,
        $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Request $request,$model)
    {
        $this->model = $model;
        $this->removable_images = $request->removable_images;
        $this->type = get_class($model);
        $this->user = $request->user();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return [];
    }
}
