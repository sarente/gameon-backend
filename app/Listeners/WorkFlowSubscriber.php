<?php

namespace App\Listeners;

use App\Exceptions\Activity\ActivityNotFoundException;
use App\Exceptions\Activity\ActivityWrongAnswerException;
use App\Exceptions\WorkFlow\GainBeforeException;
use App\Models\Activity;
use App\Models\CustomWorkflow;
use App\Models\Result;
use App\Models\User;
use App\Models\UserPoint;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Filesystem\Cache;
use Illuminate\Support\Facades\Log;
use ZeroDaHero\LaravelWorkflow\Events\GuardEvent;

class WorkFlowSubscriber implements ShouldQueue
{
    private $flowable, $user, $marking_place, $model_id, $model_type, $model_kind;

    /**
     * Handle workflow guard events.
     */
    public function onGuard(GuardEvent $event)
    {
        /** Symfony\Component\CustomWorkflow\Event\GuardEvent */
        $originalEvent = $event->getOriginalEvent();

        /** @var \App\Models\UserWorkflow $user_workflow */
        $this->flowable = $originalEvent->getSubject();

        //Check activity return type
        if (!$this->flowable) {

            $originalEvent->setBlocked(true);
        } else {
            $this->user = Cache::get('user', function () {
                return User::getUser($this->flowable->user_id);
            });

            //Get key of metadata info
            $this->marking_place = key($originalEvent->getMarking()->getPlaces());
            $this->model_id = (int)$originalEvent->getMetadata('model_id', $this->marking_place);
            $this->model_type = $originalEvent->getMetadata('model_type', $this->marking_place);
            $this->model_kind = $originalEvent->getMetadata('model_kind', $this->marking_place);
        }
    }

    /**
     * Handle workflow leave event.
     */
    public function onLeave($event)
    {

    }

    /**
     * Handle workflow transition event.
     */
    public function onTransition($event)
    {
        if ($this->model_type == \App\Models\Activity::class && !is_null($this->model_kind) && $this->model_kind == \App\Models\Setting::ACTIVITY_RETURN) {
            //Check activity name if doesnt have return false
            $activity = Activity::find($this->model_id);
            if (!$activity) {
                throw new ActivityNotFoundException();
            }
            //Check input data with activity result
            $it_1 = request()->json()->all();
            $it_2 = $activity->return_value;
            $diff = array_diff($it_1, $it_2);

            if (count($diff) > 0) {
                throw new ActivityWrongAnswerException();
            }
        }
    }

    /**
     * Handle workflow enter event.
     */
    public function onEnter($event)
    {
        if ($this->model_type == \App\Models\Result::class) {

            //Grab this data to fill user point
            $result = Result::find($this->model_id);
            if ($result) {

                $workflow_id = $event->getOriginalEvent()->getSubject()->workflow_id;
                $category_id = CustomWorkflow::with('category')->findOrFail($workflow_id)->category_id;

                //Check user not gain point before from this activity
                $gain_before = UserPoint::where(function ($query) use ($result) {
                    $query->where('result_id', $result->id)->where('user_id', $this->user->id);
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
                $user_point->result()->associate($this->model_id);
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
     * Handle workflow entered event.
     */
    public function onEntered($event)
    {
    }

    /**
     * Register the listeners for the subscriber.
     * @param Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        //Get user and workflow
        $events->listen(
            'ZeroDaHero\LaravelWorkflow\Events\GuardEvent',
            'App\Listeners\WorkFlowSubscriber@onGuard'
        );

        /*$events->listen(
            'ZeroDaHero\LaravelWorkflow\Events\LeaveEvent',
            'App\Listeners\WorkFlowSubscriber@onLeave'
        );*/

        //Check activity is return value
        $events->listen(
            'ZeroDaHero\LaravelWorkflow\Events\TransitionEvent',
            'App\Listeners\WorkFlowSubscriber@onTransition'
        );

        //check result and
        $events->listen(
            'ZeroDaHero\LaravelWorkflow\Events\EnterEvent',
            'App\Listeners\WorkFlowSubscriber@onEnter'
        );

        /*$events->listen(
            'ZeroDaHero\LaravelWorkflow\Events\EnteredEvent',
            'App\Listeners\WorkFlowSubscriber@onEntered'
        );*/
    }
}
