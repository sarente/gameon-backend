<?php
/**
 * Created by PhpStorm.
 * User: Jawad Fathi
 * Date: 9/24/2019
 * Time: 3:05 PM
 */

namespace App\Events;

use App\Http\Requests\Request;
use App\Models\Task;
use Illuminate\Queue\SerializesModels;

class TaskSaved extends Event
{
    use SerializesModels;
    public $task,
        $user,
        $endorser,
        $level,
        $rosettes,
        $accessories,
        $assigned_user,
        $assigned_classroom,
        $status,
        $pre_task,
        $pre_rosettes,
        $removable_images,
        $pre_level;
    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct(Request $request, Task $task) {
        $this->task = $task;
        $this->user = $request->user();
        $this->endorser = $request->endorser;
        $this->level = $request->level;
        $this->rosettes = $request->rosettes;
        $this->accessories = $request->accessories;
        $this->assigned_classroom = $request->assigned_classroom;
        $this->assigned_user = $request->assigned_user;
        $this->status = $request->status;
        //Precondition
        $this->pre_task = $request->pre_task;
        $this->pre_rosettes = $request->pre_rosettes;
        $this->pre_level = $request->pre_level;
        $this->removable_images = $request->removable_images;
    }
}
