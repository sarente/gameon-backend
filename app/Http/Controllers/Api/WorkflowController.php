<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Reward;
use App\Models\User;
use App\Models\Workflow\State;
use App\Models\Workflow\Transition;
use App\Models\Workflow\Workflow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class WorkflowController extends Controller
{
    public function index()
    {
        $workflows = Workflow::all();

        if (!$workflows) {
            return response()->error('error.not-found');
        }
        return response()->success($workflows);
    }

    public function store(Request $request)
    {
        $workflow_name = $request->only('name');
        $workflow = Workflow::where('name', $workflow_name)->exists();

        if ($workflow) {
            return response()->error('workflow.name-valid');
        }

        $workflow = new Workflow($request->input());
        $workflow->save();

        return response()->success($workflow);
    }

    public function addActivity(Request $request, $id)
    {
        $workflow = Workflow::find($id);
        if (!$workflow) {
            return response()->error('workflow.name-valid');
        }

        $activity = new Activity(['name' => $request->activity_name, 'point' => $request->point]);
        $activity->workflow()->associate($workflow);
        $activity->save();

        $rewards = Reward::find($request->rewards);
        $activity->rewards()->sync($rewards,false);

        $final_activity = $workflow->activities->first();

        $transition = new Transition(['name' => $workflow->name . ' from ' . $activity->name . ' to ' . $final_activity->name, 'from_activity_id' => $activity->id, 'to_activity_id' => $final_activity->id]);
        $transition->workflow()->associate($workflow);
        $transition->save();

        return response()->success($workflow);
    }

    public function show($id){
        $workflow = Workflow::with('activities', 'transitions')->find($id);
        if (!$workflow) {
            return response()->error('workflow.not-found');
        }
        return response()->success($workflow);
    }

    public function addUser(Request $request, $id)
    {
        $workflow = Workflow::find($id);
        if (!$workflow) {
            return response()->error('workflow.not-found');
        }

        $users = User::find($request->user_ids);
        $workflow->users()->sync($users);
    }
}
