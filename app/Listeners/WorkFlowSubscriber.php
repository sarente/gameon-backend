<?php

namespace App\Listeners;

use App\Models\Setting;

use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\Workflow\Event\GuardEvent;

class WorkFlowSubscriber implements ShouldQueue
{
    /**
     * Handle workflow guard events.
     */
    public function onGuard(GuardEvent $event) {
        /** Symfony\Component\Workflow\Event\GuardEvent */
        $originalEvent = $event->getOriginalEvent();

        /** @var App\Model\Activity $post */
        $post = $originalEvent->getSubject();
        $title = $post->title;

        if (empty($title)) {
            // Posts with no title should not be allowed
            $originalEvent->setBlocked(true);
        }
    }

    /**
     * Handle workflow leave event.
     */
    public function onLeave($event) {}

    /**
     * Handle workflow transition event.
     */
    public function onTransition($event) {}

    /**
     * Handle workflow enter event.
     */
    public function onEnter($event) {}

    /**
     * Handle workflow entered event.
     */
    public function onEntered($event) {}

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Vimily\LaravelWorkflow\Events\GuardEvent',
            'App\Listeners\BlogPostWorkflowSubscriber@onGuard'
        );

        $events->listen(
            'Vimily\LaravelWorkflow\Events\LeaveEvent',
            'App\Listeners\BlogPostWorkflowSubscriber@onLeave'
        );

        $events->listen(
            'Vimily\LaravelWorkflow\Events\TransitionEvent',
            'App\Listeners\BlogPostWorkflowSubscriber@onTransition'
        );

        $events->listen(
            'Vimily\LaravelWorkflow\Events\EnterEvent',
            'App\Listeners\BlogPostWorkflowSubscriber@onEnter'
        );

        $events->listen(
            'Vimily\LaravelWorkflow\Events\EnteredEvent',
            'App\Listeners\BlogPostWorkflowSubscriber@onEntered'
        );
    }
}
