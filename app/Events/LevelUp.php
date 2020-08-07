<?php
/**
 * Created by PhpStorm.
 * User: Jawad Fathi
 * Date: 9/24/2019
 * Time: 3:05 PM
 */

namespace App\Events;

use App\Models\Level;
use App\Models\User;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class LevelUp implements ShouldBroadcast
{
    use SerializesModels;
    //public $broadcastQueue = 'levelup-queue';
    public $level_no,
        $user_xp,
        $artifact,
        $level_id,
        $medal_id,
        $user; //Who got the reward

    /**
     * Create a new event instance.
     * @return void
     */

    public function __construct(User $user, $level_id, $has_got_xp)
    {
        $this->level_id = $level_id;
        $level = Level::findOrFail($level_id);
        sleep(1);
        $this->level_no = $level->artifact_status;
        $this->artifact = $level->artifact;
        $this->user = $user;
        if ($level->medals()->exists()) {
            $this->medal_id = $level->medals()->first()->id;
        }
        $this->user_xp = $has_got_xp;
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
        return 'levelup';
    }

    /**
     * Get the data to broadcast.
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'user_id' => $this->user->id,
            'medal_id' => $this->medal_id,
            'level_no' => $this->level_no,
            'artifact' => $this->artifact,
        ];
    }
}
