<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Activity\ActivityNotFoundException;
use App\Exceptions\Activity\ActivityWrongAnswerException;
use App\Exceptions\WorkFlow\GainBeforeException;
use App\Exceptions\WorkFlow\TransitionNotFoundException;
use App\Exceptions\WorkFlow\UserWorkFlowNotFoundException;
use App\Exceptions\WorkFlow\WorkFlowNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Category;
use App\Models\CustomWorkflow;
use App\Models\Result;
use App\Models\User;
use App\Models\UserPoint;
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
        /// Get user transtion ontry {
        try {
            $transitions = $system_workflow->getEnabledTransitions($flowable);
            if (count($transitions) == 0) {
                DB::rollBack();
                throw new TransitionNotFoundException();
            }
            foreach ($transitions as $transition) {
                $t[] = $transition->getName();
            }
            $transition = $t[0];

            ////////////////////////////////////////////////////////////////////
            $marking_place = key($system_workflow->getMarking($flowable)->getPlaces());
            $model_type = $system_workflow->getMetadataStore()->getMetadata('model_type', $marking_place);
            $model_kind = $system_workflow->getMetadataStore()->getMetadata('model_kind', $marking_place);
            $model_id = (int)$system_workflow->getMetadataStore()->getMetadata('model_id', $marking_place);

            //Check Activity return value /////////////////////////////////////
            if ($model_type == \App\Models\Activity::class &&
                !is_null($model_kind) &&
                $model_kind == \App\Models\Setting::ACTIVITY_RETURN) {

                //Check activity name if doesnt have return false
                $activity = Activity::find($model_id);
                if (!$activity) {
                    throw new ActivityNotFoundException();
                }
                //Check input data with activity result
                $it_1 = request()->json()->all();
                $it_2 = $activity->return_value;
                $diff = array_diff($it_1, $it_2);

                if (count($diff) > 0) {
                    throw new ActivityWrongAnswerException();
                }
            }

            //Check Result /////////////////////////////////////////////////////
            if ($model_type == \App\Models\Result::class) {
                //Grab this data to fill user point
                $result = Result::find($model_id);
                if ($result) {

                    $workflow_id = $flowable->workflow_id;
                    $category_id = CustomWorkflow::with('category')->findOrFail($workflow_id)->category_id;

                    //Check user not gain point before from this activity
                    $gain_before = UserPoint::where(function ($query) use ($result, $user) {
                        $query->where('result_id', $result->id)->where('user_id', $user->id);
                    })->exists();

                    if ($gain_before) {
                        //if user gain before from this activity return error
                        throw new GainBeforeException(request());
                    }

                    //Add point of activity to user point
                    $user_point = new UserPoint([
                        'point' => $result->point                                     rewar
                    ]);
                    $user_point->user()->associate($user);
                    $user_point->result()->associate($model_id);
                    $user_point->workflow()->associate($workflow_id);
                    $user_point->category()->associate($category_id);
                    $user_point->save();

                    //Attach reward to user
                    $reward = $result->rewards()->first();
                    $user->rewards()->syncWithoutDetaching($reward);

                    //Enable next category
                    if ($workflow_id == 2) {
                        $category = Category::find($workflow_id);
                        $category->enable = true;
                        $category->save();
                    }
                }
            }

            ////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////
            /// Save user workflow to next pace

            $system_workflow->apply($flowable, $transition);
            $flowable->save();
        } catch (LogicException $e) {
            DB::rollBack();
            throw new TransitionNotFoundException();
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
