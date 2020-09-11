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
    public function getMyWorkflow(Request $request)
    {
        //Get user
        $user=User::find(1);

        //Look for user workflows
        $flowable= UserWorkflow::with(['customWorkflow','user'])->newQuery()->where('user_id',$user->id)->first();

        if(!$flowable){
           //throw new WorkFlowNotFoundException();
        }
        //Get work flow definition
        //dd($flowable->customWorkflow->name);

        $wf_name=$flowable->customWorkflow->name;
        $data=$flowable->customWorkflow->config;
        //CustomWorkflow::loadWorkflow($wf_name,$data);

        //$workflow = Workflow::get($flowable, $wf_name);
        $workflow=$flowable->workflow_get($wf_name);

        //$workflow=$flowable->workflow_get($wf_name);
        //$metadata = $workflow->getMetadataStore();
        $metadata = $workflow->getMetadataStore();

        dd($metadata);

        //$flowable = UserWorkflow::find(2);
        //$workflow =$flowable->workflow_get('values');
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

        // Get the metadata
        $metadata = $workflow->getMetadataStore();
        // or get a specific piece of metadata
        //$workflowMetadata = $workflow->getMetadataStore()->getWorkflowMetadata();
        //$placeMetadata = $workflow->getMetadataStore()->getPlaceMetadata($place); // string place name
        //$transitionMetadata = $workflow->getMetadataStore()->getTransitionMetadata($transition); // transition object
        // or by key
        //$otherPlaceMetadata = $workflow->getMetadataStore()->getMetadata('max_num_of_words', 'draft');

        $placeMetadata = $workflow->getMetadataStore()->getPlaceMetadata('slide_show'); // string place name
        $activity_id=$workflow->getMetadataStore()->getMetadata('activity_id', 'slide_show');
        dump($activity_id);

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
