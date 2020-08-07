<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        return Response::json($workflows);
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

        return Response::json($workflow);
    }

    public function addState(Request $request, $id)
    {
        $workflow = Workflow::find($id);
        if (!$workflow) {
            return response()->error('workflow.name-valid');
        }

        $workflow->places()->delete();

        $states = $request->states;

        $from_state = null;
        $to_state = null;

        foreach ($states as $key => $state) {

            $state = new State(['name' => $state]);
            $state->workflow()->associate($workflow);
            $state->save();

            $to_state = $state->id;

            if ($from_state && $to_state) {
                $transition = new Transition(['name' => $workflow->name . ' transition' . $key, 'from_state_id' => $from_state, 'to_state_id' => $to_state]);
                $transition->workflow()->associate($workflow);
                $transition->save();
            }

            $from_state = $state->id;
        }

        return Response::json($workflow);
    }

    public function show($id){
        $workflow = Workflow::with('places', 'transitions')->find($id);
        if (!$workflow) {
            return response()->error('workflow.not-found');
        }
        return Response::json($workflow);
    }
}
