<?php

namespace App\Listeners;

use App\Models\Setting;

use App\Models\User;
use App\Models\UserWorkflow;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Workflow\Event\GuardEvent;

class WorkFlowSubscriber implements ShouldQueue
{
    /**
     * Handle workflow guard events.
     */
    public function onGuard(GuardEvent $event) {

        $user_id=auth()->id();

        /** Symfony\Component\CustomWorkflow\Event\GuardEvent */
        $originalEvent = $event->getOriginalEvent();

        /** @var App\Models\UserWorkflow $user_workflow */
        $user_workflow = $originalEvent->getSubject();
        $title = $user_workflow->title;

        if (empty($title)) {
            // Posts with no title should not be allowed
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
            'App\Listeners\BlogPostWorkflowSubscriber@onGuard'
        );

        $events->listen(
            'ZeroDaHero\LaravelWorkflow\Events\LeaveEvent',
            'App\Listeners\BlogPostWorkflowSubscriber@onLeave'
        );

        $events->listen(
            'ZeroDaHero\LaravelWorkflow\Events\TransitionEvent',
            'App\Listeners\BlogPostWorkflowSubscriber@onTransition'
        );

        $events->listen(
            'ZeroDaHero\LaravelWorkflow\Events\EnterEvent',
            'App\Listeners\BlogPostWorkflowSubscriber@onEnter'
        );

        $events->listen(
            'ZeroDaHero\LaravelWorkflow\Events\EnteredEvent',
            'App\Listeners\BlogPostWorkflowSubscriber@onEntered'
        );
    }
}
