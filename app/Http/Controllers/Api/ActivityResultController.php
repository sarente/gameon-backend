<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\WorkFlow\WorkFlowNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\CustomWorkflow;

class ActivityResultController extends Controller
{
    public function checkValidity($workflow, $activity_result)
    {
        //Get workflow name
        //Load workflow
        //Check activity name
        //Apply it
        dd($workflow, $activity_result, request()->input());

        $workflow = CustomWorkflow::where('id', $workflow);
        if (!$workflow->exists()) {
            throw new WorkFlowNotFoundException();
        }
        // Activity

        return response()->success($workflow);
    }

}
