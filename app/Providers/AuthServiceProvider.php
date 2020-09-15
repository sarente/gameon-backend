<?php

namespace App\Providers;

use App\Guard\JwtGuard;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
       Auth::extend('jwt', function ($app, $name, array $config) {
            return new JwtGuard(Auth::createUserProvider($config['provider']), $app['request']);
        });
        Auth::provider('internal_user_provider', function($app, array $config) {
            return new InternalUserProvider($app['hash'], $config['model']);
        });

        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            //return $user->hasRole(\App\Models\Setting::ROLE_SUPER_ADMIN) ? true : null;
            return $user->hasRole(\App\Models\Setting::ROLE_ADMIN) ? true : null;
        });
    }
}
