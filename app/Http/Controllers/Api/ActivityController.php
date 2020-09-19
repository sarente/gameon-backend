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
        //Apply it
        dd($workflow, $activity, request()->input());
        $workflow = CustomWorkflow::where('id', $workflow_id);

        if (!$workflow->exists()) {
            throw new WorkFlowNotFoundException();
        }

        return response()->success($workflow);
    }

}
