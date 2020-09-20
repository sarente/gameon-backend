<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Activity\ActivityResultNotFoundException;
use App\Exceptions\Activity\ActivityResultWrongAnswerException;
use App\Exceptions\WorkFlow\GainBeforeException;
use App\Exceptions\WorkFlow\WorkFlowNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\ActivityResult;
use App\Models\CustomWorkflow;
use App\Models\User;
use App\Models\UserPoint;
use App\Models\UserWorkflow;
use Symfony\Component\Workflow\Exception\LogicException;

class ActivityResultController extends Controller
{
    public function checkValidity($workflow_id, $activity_result_id)
    {
        $user=User::getUser();

        //Check activity name if doesnt have return false
        $activity_result=ActivityResult::find($activity_result_id);
        if(!$activity_result) {
            throw new ActivityResultNotFoundException();
        }
        if($activity_result->metadata==request()->input()) {
            throw new ActivityResultWrongAnswerException();
        }
        //Get workflow
        $workflow=CustomWorkflow::with('category')->find($workflow_id);
        if (!$workflow->exists()) {
            throw new WorkFlowNotFoundException();
        }
        //Load workflow
        $flowable=UserWorkflow::with(['customWorkflow', 'user'])
            ->where('user_id', $user->id)
            ->where('workflow_id',$workflow->id)
            ->first();

        $system_workflow=$flowable->workflow_get($flowable->customWorkflow->name);

        //load category
        ////////////////////////////////////////////////////////////////////
        $category_id=$workflow->category_id;

        //Check user not gain point before from this activity
        ////////////////////////////////////////////////////////////////////
        $gain_before = UserPoint::where(function ($query) use ($activity_result,$user) {
            $query->where('activity_result_id', $activity_result->id)->where('user_id', $user->id);
        })->exists();
        if ($gain_before) {
            //if user gain before from this activity return error
            throw new GainBeforeException(request());
        }
        //Add point of activity to user point
        $user_point = new UserPoint([
            'point' => $activity_result->point
        ]);
        $user_point->user()->associate($user);
        $user_point->activityResult()->associate($activity_result_id);
        $user_point->workflow()->associate($workflow_id);
        $user_point->category()->associate($category_id);
        $user_point->save();
        //Attach rosette
        //TODO: attach rosette


        //Apply it
        ////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////
        /// Get user transtion on
        $transitions = $system_workflow->getEnabledTransitions($flowable);
        if (count($transitions) == 0) {
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
            return response()->error('workflow.place-not-allowed');
        }
        ////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////
        //$result['reward_url']=$user_point->rewards();
        $result['point']=$user_point->point;

        return response()->success($user_point);
    }

}
