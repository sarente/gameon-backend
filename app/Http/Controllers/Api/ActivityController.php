<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Activity\ActivityNotFoundException;
use App\Exceptions\Activity\ResultWrongAnswerException;
use App\Exceptions\WorkFlow\GainBeforeException;
use App\Exceptions\WorkFlow\UserWorkFlowNotFoundException;
use App\Exceptions\WorkFlow\WorkFlowNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\CustomWorkflow;
use App\Models\User;
use App\Models\UserPoint;
use App\Models\UserWorkflow;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Workflow\Exception\LogicException;

class ActivityController extends Controller
{
    public function show($activity)
    {
        $activity = Activity::with('image')->find($activity);
        if (!$activity) {
            throw new ActivityNotFoundException();
        }
        return response()->success($activity);
    }

    //do-action
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
            return response()->error('workflow.transition-not-allowed');
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
            return response()->error('workflow.place-not-allowed');
        }
        ////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////
        DB::commit();
        return response()->success('common.success');
    }

    //return-value
    public function verify($workflow_id,$activity_id)
    {
        DB::beginTransaction();
        $user = User::getUser();

        //Check activity name if doesnt have return false
        $activity = Activity::find($activity_id);
        if (!$activity) {
            throw new ActivityNotFoundException();
        }
        //Check input data with activity result
        $it_1 = request()->json()->all();
        $it_2 = $activity->return_value;
        $diff = array_diff($it_1, $it_2);

        if (count($diff) > 0) {
            throw new ResultWrongAnswerException();
        }
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

        //load category
        ////////////////////////////////////////////////////////////////////
        $category_id = $workflow->category_id;

        //Apply it
        ////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////
        /// Get user transtion on
        $transitions = $system_workflow->getEnabledTransitions($flowable);
        if (count($transitions) == 0) {
            DB::rollBack();
            //TODO: throw new exception
            return response()->error('workflow.transition-not-allowed');
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
            return response()->error('workflow.place-not-allowed');
        }
        ////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////
        DB::commit();

        return response()->success('common.success');
    }
}
