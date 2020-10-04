<?php

namespace App\Listeners;

use App\Exceptions\WorkFlow\GainBeforeException;
use App\Models\CustomWorkflow;
use App\Models\Result;
use App\Models\User;
use App\Models\UserPoint;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use ZeroDaHero\LaravelWorkflow\Events\GuardEvent;

class WorkFlowSubscriber implements ShouldQueue
{
    private $flowable, $user;

    /**
     * Handle workflow guard events.
     */
    public function onGuard(GuardEvent $event)
    {

        $this->user = auth()->user() ?? User::find(1);

        /** Symfony\Component\CustomWorkflow\Event\GuardEvent */
        $originalEvent = $event->getOriginalEvent();
        /** @var \App\Models\UserWorkflow $user_workflow */
        $this->flowable = $event->getOriginalEvent()->getSubject();

        //Check activity return type
        if (empty($this->flowable->id)) {
            $originalEvent->setBlocked(true);
        }
    }

    /**
     * Handle workflow leave event.
     */
    public function onLeave($event)
    {
        //Log::info('onLeave');
        $this->user = auth()->user();

        //Get key of place
        $key = key($event->getOriginalEvent()->getMarking()->getPlaces());

        if ($key == 'result') {

            //Check the activity type
            $model_id = (int)$event->getOriginalEvent()->getMetadata('model_id', $key);

            //Grab this data to fill user point
            $result = Result::find($model_id);
            if ($result) {

                $workflow_id = $event->getOriginalEvent()->getSubject()->workflow_id;
                $category_id = CustomWorkflow::with('category')->findOrFail($workflow_id)->category_id;

                $this->flowable = $event->getOriginalEvent()->getSubject();

                //Check user not gain point before from this activity
                $gain_before = UserPoint::where(function ($query) use ($result) {
                    $query->where('activity_id', $result->id)->where('user_id', $this->user->id);
                })->exists();

                if ($gain_before) {
                    //if user gain before from this activity return error
                    throw new GainBeforeException(request());
                }

                //Add point of activity to user point
                $user_point = new UserPoint([
                    'point' => $result->point
                ]);
                $user_point->user()->associate($this->user);
                $user_point->activity()->associate($model_id);
                $user_point->workflow()->associate($workflow_id);
                $user_point->category()->associate($category_id);
                $user_point->save();

                //Attach reward to user
                $reward = $result->rewards()->first();
                $this->user->rewards()->syncWithoutDetaching($reward);
            }
        }
    }

    /**
     * Handle workflow transition event.
     */
    public function onTransition($event)
    {
        Log::info('onTransition');
        //check the activity type in transition

        //$flowable->workflow_get($wf_name);
    }

    /**
     * Handle workflow enter event.
     */
    public function onEnter($event)
    {
        Log::info('onEnter');
    }

    /**
     * Handle workflow entered event.
     */
    public function onEntered($event)
    {
        Log::info('onEntered');
    }

    /**
     * Register the listeners for the subscriber.
     * @param Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'ZeroDaHero\LaravelWorkflow\Events\GuardEvent',
            'App\Listeners\WorkFlowSubscriber@onGuard'
        );

        $events->listen(
            'ZeroDaHero\LaravelWorkflow\Events\LeaveEvent',
            'App\Listeners\WorkFlowSubscriber@onLeave'
        );

        $events->listen(
            'ZeroDaHero\LaravelWorkflow\Events\TransitionEvent',
            'App\Listeners\WorkFlowSubscriber@onTransition'
        );

        $events->listen(
            'ZeroDaHero\LaravelWorkflow\Events\EnterEvent',
            'App\Listeners\WorkFlowSubscriber@onEnter'
        );

        $events->listen(
            'ZeroDaHero\LaravelWorkflow\Events\EnteredEvent',
            'App\Listeners\WorkFlowSubscriber@onEntered'
        );
    }
}
