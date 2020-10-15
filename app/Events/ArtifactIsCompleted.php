<?php
/**
 * Created by PhpStorm.
 * User: Jawad Fathi
 * Date: 9/24/2019
 * Time: 3:05 PM
 */

namespace App\Events;

use App\Http\Requests\Api\ProjectRequest;
use App\Models\Project;
use Illuminate\Queue\SerializesModels;

class ArtifactIsCompleted extends Event
{
    use SerializesModels;
    public $model,
        $users; //Who got the reward
    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct(array $users,$model) {
        $this->model = $model;
        $this->users = $users;

    }
}
