<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ModelCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public
        $user,
        $model;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $model)
    {
        $this->model = $model;
        $this->user = $user;
    }
}
