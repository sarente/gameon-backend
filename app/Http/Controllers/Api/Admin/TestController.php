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

        $flowable = UserWorkflow::find(2);
        $workflow =$flowable->workflow_get('values');

        //$workflow->getMetadataStore();
        //dump($workflow->can($flowable, 'play_slide_show'));
        //dd($workflow->can($flowable, 'fill_in_the_blanks'));

        //$transitions = $workflow->getEnabledTransitions($flowable); //give me the action the user have to do
        //dd($transitions);

        // Get the current places
        //$place=$workflow->getMarking($flowable)->getPlaces();
        //dd($place);

        // Get the definition
        //$definition = $workflow->getDefinition();
        //dump($definition);

        $placeMetadata = $workflow->getMetadataStore()->getPlaceMetadata('slide_show'); // string place name
        dump($placeMetadata);

        //$workflow->apply($flowable, 'play_slide_show'); //Doing a transitio   n
        //$workflow->apply($flowable, 'fill_in_the_blanks');
        //$flowable->save(); // Don't forget to persist the state
        return response()->message('common.success');

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
