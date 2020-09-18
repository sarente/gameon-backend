<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CustomWorkflow;
use App\Models\User;
use App\Models\UserWorkflow;

class WorkflowController extends Controller
{
    public function index()
    {
        $workflows = CustomWorkflow::all();

        if (!$workflows) {
            return response()->error('error.not-found');
        }
        return response()->success($workflows->load('category'));
    }

    public function show($id)
    {
        $user = User::getUser();

        $user_workflow = UserWorkflow::where('user_id', $user->id)->where('workflow_id',$id);

        if (!$user_workflow->exists()) {
            $workflow=CustomWorkflow::find($id);
            $user->workflows()->sync($workflow);
        }

        return response()->success($user_workflow->first());
    }
}
