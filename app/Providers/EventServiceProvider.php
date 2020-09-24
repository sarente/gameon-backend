<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        'App\Listeners\UserEventSubscriber',
        'App\Listeners\WorkFlowSubscriber',
    ];
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        /*'Illuminate\Mail\Events\MessageSending' => [
            'App\Listeners\LogSendingMessage',
        ],
        'Illuminate\Mail\Events\MessageSent' => [
            'App\Listeners\LogSentMessage',
        ],*/
        'App\Events\ModelCreated' => [
        ],
        'App\Events\QuestionSaved' => [
            'App\Listeners\Question\UpdateImage',
        ],
        'App\Events\ActivitySaved' => [
            //'App\Listeners\Project\UpdateImage',                                                              api
            //'App\Listeners\Project\AddRoles',
            'App\Listeners\Activity\AddRewards',
            'App\Listeners\Activity\AddTag',
        ],
        'App\Events\TaskSaved' => [
            'App\Listeners\Task\UpdateImage',
            'App\Listeners\Task\AddRosettes',
            'App\Listeners\Task\AddUser',
            'App\Listeners\Task\AddAccessories',
            'App\Listeners\Task\AddClassroom',
        ],
        'App\Events\PostViewed' => [
            'App\Listeners\AddViewer',
        ],
        'App\Events\LevelConfigured' => [
            'App\Listeners\Level\SetXP\SetProject',
            'App\Listeners\Level\SetXP\SetClub',
            'App\Listeners\Level\SetXP\SetTask',
            'App\Listeners\Level\SetXP\SetQA',
            'App\Listeners\Level\SetXP\SetGeneral',
        ],
        'App\Events\ProfileUpdate' => [
            'App\Listeners\User\Profile\UpdateProfile',
            'App\Listeners\User\Profile\AddTags',
            'App\Listeners\User\Profile\AttachRosettes',
            'App\Listeners\User\Profile\AttachMedals',
            'App\Listeners\User\Profile\UpdateImage',
        ],
        //Run this event when project and task is completed by admin
        'App\Events\ArtifactIsCompleted' => [
            'App\Listeners\Reward\ComputeGeneralXP',
            'App\Listeners\Reward\ComputePoint',
            'App\Listeners\Reward\AttachRosette',
        ],
        'App\Events\ComputeGeneral' => [
            'App\Listeners\Reward\ComputeGeneralXP',
        ],
        'App\Events\ModelUpdated' => [
            'App\Listeners\Model\UpdateImage',
        ],
        'App\Events\UserCreated' => [
            //'App\Listeners\User\Profile\CreateProfile',
            //'App\Listeners\User\SetDefaultLevel',
            'App\Listeners\User\Profile\CreateAvatar',
        ],
         //When user has level up this event have to be fire
        'App\Events\LevelUp' => [
            'App\Listeners\User\Profile\AttachMedals',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
