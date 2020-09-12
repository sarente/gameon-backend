<?php

namespace App\Listeners;

use App\Models\Setting;

use App\Models\User;
use App\Models\UserWorkflow;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use ZeroDaHero\LaravelWorkflow\Events\GuardEvent;

class WorkFlowSubscriber implements ShouldQueue
{
    private $flowable;

    /**
     * Handle workflow guard events.
     */
    public function onGuard(GuardEvent $event) {

        $user=auth()->user() ?? User::find(1);

        /** Symfony\Component\CustomWorkflow\Event\GuardEvent */
        $originalEvent = $event->getOriginalEvent();
        /** @var \App\Models\UserWorkflow $user_workflow */
        $this->flowable = $event->getOriginalEvent()->getSubject();

        Log::info($user->id.' onGuard '. $this->flowable->customWorkflow);

        if (empty( $this->flowable->id)) {
            $originalEvent->setBlocked(true);
        }
    }

    /**
     * Handle workflow leave event.
     */
    public function onLeave($event) {
        Log::info('onLeave');
    }

    /**
     * Handle workflow transition event.
     */
    public function onTransition($event) {
        Log::info('onTransition');
        //check the activity type in transition

        $flowable->workflow_get($wf_name);
    }

    /**
     * Handle workflow enter event.
     */
    public function onEnter($event) {
        Log::info('onEnter');
    }

    /**
     * Handle workflow entered event.
     */
    public function onEntered($event) {
        Log::info('onEntered');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
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
