<?php
/**
 * Created by PhpStorm.
 * User: Jawad Fathi
 * Date: 9/24/2019
 * Time: 3:05 PM
 */

namespace App\Events;

use App\Http\Requests\Request;
use App\Models\CustomWorkflow;
use App\Models\User;
use Illuminate\Queue\SerializesModels;

class WorkflowDone extends Event
{
    use SerializesModels;
    public $customWorkflow,$user;
    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct(User $user, CustomWorkflow $customWorkflow) {

        $this->customWorkflow = $customWorkflow;
        $this->user = $user;

    }
}
