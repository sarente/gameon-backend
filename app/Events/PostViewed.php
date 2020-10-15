<?php

namespace App\Events;

use App\Http\Requests\Request;
use App\Models\Post;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostViewed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $post, $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Post $post, Request $request)
    {
        $this->post = $post;
        $this->user = $request->user();
    }
}
