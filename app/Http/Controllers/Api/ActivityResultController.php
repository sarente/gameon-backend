<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Activity\ActivityResultNotFoundException;
use App\Exceptions\Activity\ActivityResultWrongAnswerException;
use App\Exceptions\WorkFlow\WorkFlowNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\ActivityResult;
use App\Models\CustomWorkflow;

class ActivityResultController extends Controller
{
    public function checkValidity($workflow, $activity_result)
    {
        //Check activity name if doesnt have return false
        $activity_result=ActivityResult::find($activity_result);
        if(!$activity_result) {
            throw new ActivityResultNotFoundException();
        }
        if($activity_result->metadata==request()->input()) {
            throw new ActivityResultWrongAnswerException();
        }

        //Get workflow name
        //Load workflow
        //Apply it
        //dd($workflow, $activity_result, request()->input());

        $workflow = CustomWorkflow::where('id', $workflow);
        if (!$workflow->exists()) {
            throw new WorkFlowNotFoundException();
        }
        $workflow_name=$workflow->first()->name;

        return response()->success($workflow);
    }

}
