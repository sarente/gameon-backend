<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\WorkFlow\WorkFlowNotFoundException;
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
            throw new WorkFlowNotFoundException();
        }
        return response()->success($workflows->load('category'));
    }

    public function show($id)
    {
        $user = User::getUser();

        $flowable = UserWorkflow::where('user_id', $user->id)
            ->where('workflow_id', $id);

        if (!$flowable->exists()) {
            $this->addUsertoWorkflow($id, $user);
        }
        return response()->success($flowable->first());
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
