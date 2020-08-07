<?php
/**
 * Created by PhpStorm.
 * User: Jawad Fathi
 * Date: 9/24/2019
 * Time: 3:05 PM
 */

namespace App\Events;

use App\Http\Requests\Api\QuestionRequest;
use App\Models\Question;
use Illuminate\Queue\SerializesModels;

class QuestionSaved extends Event
{
    use SerializesModels;
    public $model,
        $user,
        $removable_images;

    /**
     * Create a new event instance.
     * @return void
     */

    public function __construct(QuestionRequest $request, Question $model)
    {
        $this->model = $model;
        $this->user = $request->user();
        $this->removable_images = $request->removable_images;
    }
}
