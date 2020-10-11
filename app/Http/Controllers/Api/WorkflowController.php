<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\WorkFlow\TransitionNotFoundException;
use App\Exceptions\WorkFlow\UserWorkFlowNotFoundException;
use App\Exceptions\WorkFlow\WorkFlowNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\CustomWorkflow;
use App\Models\User;
use App\Models\UserWorkflow;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Workflow\Exception\LogicException;

class WorkflowController extends Controller
{
    public function index()
    {
        $workflows = CustomWorkflow::all();

        if (!$workflows) {
            throw new WorkFlowNotFoundException();
        }
        return response()->success($workflows->load('category'));
    }

    public function show($id)
    {
        $user = User::getUser();

        $flowable = UserWorkflow::where('user_id', $user->id)->where('workflow_id', $id)
            ->join('workflows', 'user_workflow.workflow_id', '=', 'workflows.id');

        if (!$flowable->exists()) {
            $this->addUsertoWorkflow($id, $user);
        }
        $workflow = $flowable->first();
        $workflow->config = json_decode($workflow->config);
        return response()->success($workflow);
    }

    public function proceed($workflow_id)
    {
        DB::beginTransaction();
        $user = User::getUser();

        //Get workflow
        $workflow = CustomWorkflow::with('category')->find($workflow_id);
        if (!$workflow->exists()) {
            throw new WorkFlowNotFoundException();
        }

        //Load workflow
        $flowable = UserWorkflow::with(['customWorkflow', 'user'])
            ->where('user_id', $user->id)
            ->where('workflow_id', $workflow->id);

        if (!$flowable->exists()) {
            throw new UserWorkFlowNotFoundException();
        }
        $flowable = $flowable->first();

        $system_workflow = $flowable->workflow_get($flowable->customWorkflow->name);

        //Apply it
        ////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////
        /// Get user transtion on
        $transitions = $system_workflow->getEnabledTransitions($flowable);
        if (count($transitions) == 0) {
            DB::rollBack();
            throw new TransitionNotFoundException();
            return;
        }
        foreach ($transitions as $transition) {
            $t[] = $transition->getName();
        }
        $transition = $t[0];
        ////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////
        /// Save user workflow to next pace
        try {
            $system_workflow->apply($flowable, $transition);
            $flowable->save();
        } catch (LogicException $e) {
            DB::rollBack();
            throw new TransitionNotFoundException();
            return;
        }
        ////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////
        DB::commit();
        return response()->success('common.success');
    }

    /**
     * @param $id
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     */
    private function addUsertoWorkflow($id, \Illuminate\Contracts\Auth\Authenticatable $user): void
    {
        $workflow = CustomWorkflow::find($id);
        $user->workflows()->attach($workflow->id, ['marking' => '"the_blanks"']);
    }
}
