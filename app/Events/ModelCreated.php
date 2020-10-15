<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

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
