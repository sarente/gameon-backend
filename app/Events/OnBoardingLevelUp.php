<?php
/**
 * Created by PhpStorm.
 * User: Jawad Fathi
 * Date: 9/24/2019
 * Time: 3:05 PM
 */

namespace App\Events;

use App\Models\User;
use \Illuminate\Support\Collection;
use Illuminate\Queue\SerializesModels;

class OnBoardingLevelUp
{
    use SerializesModels;
    //public $broadcastQueue = 'levelup-queue';
    public $artifact,
        $rosettes,
        $medals,
        $user; //Who got the reward

    /**
     * Create a new event instance.
     * @return void
     */

    public function __construct(User $user,Collection $gain)
    {
        $this->user = $user;
        sleep(1);

        if($gain->count()>0){
            $this->rosettes= $gain->get('rosettes');
            $this->medals= $gain->get('medals');
        }
    }

    /**
     * Get the channels name the event should be broadcast on.
     * @return array
     */

}
