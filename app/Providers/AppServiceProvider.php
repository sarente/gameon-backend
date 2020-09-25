<?php

namespace App\Providers;

use App\Models\CustomWorkflow;
use App\Observers\CustomWorkflowObserver;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Queue;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Mysql 5.6 Support
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        CustomWorkflow::observe(CustomWorkflowObserver::class);
        //TODO: email failing job
        /*Queue::failing(function (JobFailed $event) {
            // $event->connectionName
            // $event->job
            // $event->exception
        });*/
    }
}
