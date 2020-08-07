<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot()
    {
        Log::info('BroadcastServiceProvider');
        Broadcast::routes(['middleware' => ['auth:api']]);
        require base_path('routes/channels.php');
    }
}
