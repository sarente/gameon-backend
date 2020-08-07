<?php
/**
 * Created by PhpStorm.
 * User: Jawad Fathi
 * Date: 9/24/2019
 * Time: 3:05 PM
 */

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class Notification implements ShouldBroadcast
{
    use SerializesModels;
    //public $broadcastQueue = 'notification-queue';
    public $count,
        $user; //Who got the reward

    /**
     * Create a new event instance.
     * @return void
     */

    public function __construct(User $user)
    {
        $cache = 'notification_count' . $user->id;
        $c = Cache::get($cache, function () {
            return 0;
        });
        Cache::put($cache, ++$c);
        $this->count = $c;
        $this->user = $user;
    }

    /**
     * Get the channels name the event should be broadcast on.
     * @return array
     */

    public function broadcastOn()
    {
        return new PrivateChannel('gameon');
        //return new PresenceChannel('notification');
    }

    /**
     * The event's broadcast name.
     * @return string
     */
    public function broadcastAs()
    {
        return 'notification';
    }

    /**
     * Get the data to broadcast.
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'user_id' => $this->user->id,
            'count' => $this->count
        ];
    }
}
