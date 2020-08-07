<?php

namespace App\Providers;

use App\Models\Club;
use App\Models\Permission;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Question;
use App\Models\Setting;
use App\Models\Step;
use App\Models\Task;
use App\Policies\ClubPolicy;
use App\Policies\ProfilePolicy;
use App\Policies\ProjectPolicy;
use App\Policies\QuestionAnswerPolicy;
use App\Policies\StepPolicy;
use App\Policies\TaskPolicy;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     * @var array
     */
    protected $policies = [
        Club::class => ClubPolicy::class,
        Project::class => ProjectPolicy::class,
        Task::class => TaskPolicy::class,
        Question::class => QuestionAnswerPolicy::class,
        Step::class => StepPolicy::class,
        Profile::class => ProfilePolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     * @param  \Illuminate\Contracts\Auth\Access\Gate $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        try {
            parent::registerPolicies($gate);

            if (\Schema::hasTable('permissions')) {
                // Implicitly grant "Super Admin" role all permissions
                // This works in the app by using gate-related functions like auth()->user->can() and @can()
                $gate->before(function ($user, $ability) {
                    return $user->hasRole(Setting::ROLE_SUPER_ADMIN) ? true : null;
                });
                // Dynamically register permissions with Laravel's Gate.
                foreach ($this->getPermissions() as $permission) {
                    $gate->define($permission->name, function ($user) use ($permission) {
                        return $user->hasPermission($permission);
                    });
                }
            }

        } catch (\Illuminate\Database\QueryException $ex) {
            return;
        }
    }

    /**
     * Fetch the collection of site permissions.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getPermissions()
    {
        return Permission::with('roles')->get();
    }
}
