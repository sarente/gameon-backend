<?php
namespace App\Observers;
use App\Exceptions\WorkFlow\DuplicateWorkFlowException;
use App\Models\CustomWorkflow;
use App\Models\UserWorkflow;
use ZeroDaHero\LaravelWorkflow\WorkflowRegistry;

class CustomWorkflowObserver
{
    /**
     * Handle the CustomWorkflow "created" event.
     *
     * @param  \App\Models\CustomWorkflow  $workflow
     * @return void
     */
    public function created(CustomWorkflow $workflow)
    {
        $registryConfig = [
            'track_loaded' => true,
            'ignore_duplicates' => true
        ];

        $registry = new WorkflowRegistry($workflow->config, $registryConfig);
        $subject = new UserWorkflow();
        $workflow = $registry->get($subject,$workflow->name);
        //dd($workflow->getName());
        //$this->expectException(DuplicateWorkFlowException::class);

        //dd($registry->getLoaded());
        dd($registry->get($subject));
        /*try {
            $registry->addFromArray('wf_04',$workflow->config["wf_04"]);
            //$registry->addFromArray($model->name, $model->config);
        } catch (DuplicateWorkFlowException $e) {
            throw new DuplicateWorkFlowException();
        }*/
    }

    /**
     * Handle the CustomWorkflow "updated" event.
     *
     * @param  \App\Models\CustomWorkflow  $workflow
     * @return void
     */
    public function updated(CustomWorkflow $workflow)
    {
        //
    }

    /**
     * Handle the CustomWorkflow "deleted" event.
     *
     * @param  \App\Models\CustomWorkflow  $workflow
     * @return void
     */
    public function deleted(CustomWorkflow $workflow)
    {
        //
    }

    /**
     * Handle the CustomWorkflow "forceDeleted" event.
     *
     * @param  \App\Models\CustomWorkflow  $workflow
     * @return void
     */
    public function forceDeleted(CustomWorkflow $workflow)
    {
        //
    }
}
