<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Activity;
use App\Models\CustomWorkflow;
use App\Models\User;
use App\Models\UserWorkflow;
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

        $user_flow = UserWorkflow::find(1);
        $workflow =$user_flow->workflow_get('values');
        //dd($workflow);
        dump($workflow->getMetadataStore());

        //$uwf = UserWorkflow::find(1);
        //$workflow =$uwf->workflow_get('straight1');
        //$current_place=$workflow->getMarking($uwf)->getPlaces();

        //$workflow =\Symfony\Component\Workflow\Workflow::get($act, $workflowName);

        //dump($act->workflow_transitions());
        //dump($workflow->getMetadataStore());

        //return response()->message(json_encode($wf->config));
        //$wf->loadWorkflow();

    }
}
