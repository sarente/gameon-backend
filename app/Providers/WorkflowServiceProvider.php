<?php

namespace App\Providers;

use App\Models\CustomWorkflow;
use Illuminate\Support\ServiceProvider;
use ZeroDaHero\LaravelWorkflow\WorkflowRegistry;

class WorkflowServiceProvider extends \ZeroDaHero\LaravelWorkflow\WorkflowServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('workflow', function ($app) {
            //$workflowConfigs = $app->make('config')->get('workflow');
            $workflowConfigs = CustomWorkflow::pluck('config','name')->toArray();
            $registryConfig = $app->make('config')->get('workflow_registry');
            return new WorkflowRegistry($workflowConfigs, $registryConfig);
        });
    }
       /* $this->app->bind(UserStatsCsvExporter::class, function() {
            return new UserStatsCsvExporter(new Translator(config('app.locale')));
        });


    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
