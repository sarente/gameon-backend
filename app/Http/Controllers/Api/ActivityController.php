<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\WorkFlow\WorkFlowNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\CustomWorkflow;

class ActivityController extends Controller
{
    public function store($workflow, $activity)
    {
        //Get workflow name
        //Load workflow
        //Check activity name
        //Apply it
        //dd($workflow, $activity, request()->input());

        $workflow = CustomWorkflow::where('id', $workflow);
        if (!$workflow->exists()) {
            throw new WorkFlowNotFoundException();
        }
        // Activity

        return response()->success($workflow);
    }

}
