<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Activity;
use App\Models\CustomWorkflow;
use App\Models\User;
use App\Models\Workflow\UserWorkflow;
use App\Models\Workflow\Workflow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use ZeroDaHero\LaravelWorkflow\Exceptions\DuplicateWorkflowException;

class TestController extends Controller
{
    public function getActivityTransaction(Request $request)
    {
       /* $act = Activity::inRandomOrder()->first();

        dump($act->workflow_transitions());*/
    }

    public function getWorkflow(Request $request)
    {
        //$wf=CustomWorkflow::first();

        $act = Activity::find(1);

        dump($act->workflow_transitions());

        //return response()->message(json_encode($wf->config));
        //$wf->loadWorkflow();

    }
}
