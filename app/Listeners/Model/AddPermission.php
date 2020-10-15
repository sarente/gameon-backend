<?php

namespace App\Listeners\Model;

use App\Events\ModelCreated;
use App\Models\Club;
use App\Models\Post;
use App\Models\Project;
use App\Models\Question;
use App\Models\Setting;
use App\Models\Task;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Permission;

class AddPermission
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ModelCreated  $event
     * @return void
     */
    public function handle(ModelCreated $event)
    {
        $model = $event->model;
        $user = $event->user;

        if(get_class($model) == Project::class) {
            $permissions[] =  Permission::create([
                'name' => Setting::PERMISSION_PROJECT_UPDATE . '-' . $model->id,
                'guard_name' => Guard::getDefaultName($model),
            ]);
            $permissions[] = Permission::create([
                'name' => Setting::PERMISSION_PROJECT_DELETE . '-' . $model->id,
                'guard_name' => Guard::getDefaultName($model),
            ]);
            $permissions[] = Permission::create([
                'name' => Setting::PERMISSION_PROJECT_DONE . '-' . $model->id,
                'guard_name' => Guard::getDefaultName($model),
            ]);
            $permissions[] = Permission::create([
                'name' => Setting::PERMISSION_PROJECT_POST_ADD . '-' . $model->id,
                'guard_name' => Guard::getDefaultName($model),
            ]);
            $permissions[] = Permission::create([
                'name' => Setting::PERMISSION_STEP_CREATE . '-' . $model->id,
                'guard_name' => Guard::getDefaultName($model),
            ]);
            $permissions[] = Permission::create([
                'name' => Setting::PERMISSION_STEP_DELETE . '-' . $model->id,
                'guard_name' => Guard::getDefaultName($model),
            ]);
            $permissions[] = Permission::create([
                'name' => Setting::PERMISSION_STEP_UPDATE . '-' . $model->id,
                'guard_name' => Guard::getDefaultName($model),
            ]);
            $permissions[] = Permission::create([
                'name' => Setting::PERMISSION_STEP_DONE . '-' . $model->id,
                'guard_name' => Guard::getDefaultName($model),
            ]);
            $permissions[] = Permission::create([
                'name' => Setting::PERMISSION_PROJECT_CLAIM_ACCEPT . '-' . $model->id,
                'guard_name' => Guard::getDefaultName($model),
            ]);
            $permissions[] = Permission::create([
                'name' => Setting::PERMISSION_PROJECT_CLAIM_REJECT . '-' . $model->id,
                'guard_name' => Guard::getDefaultName($model),
            ]);
            $permissions[] = Permission::create([
                'name' => Setting::PERMISSION_PROJECT_DOCUMENT_ADD . '-' . $model->id,
                'guard_name' => Guard::getDefaultName($model),
            ]);

            //owner of the project
            $user->givePermissionTo($permissions);
        }

        if(get_class($model) == Club::class) {
            $permissions[] = $update = Permission::create([
                'name' => Setting::PERMISSION_CLUB_UPDATE . '-' . $model->id,
                'guard_name' => Guard::getDefaultName($model),
            ]);
            $permissions[] = $delete = Permission::create([
                'name' => Setting::PERMISSION_CLUB_DELETE . '-' . $model->id,
                'guard_name' => Guard::getDefaultName($model),
            ]);
            $permissions[] = $postAdd = Permission::create([
                'name' => Setting::PERMISSION_CLUB_POST_ADD . '-' . $model->id,
                'guard_name' => Guard::getDefaultName($model),
            ]);
            $permissions[] = $postAdd = Permission::create([
                'name' => Setting::PERMISSION_CLUB_DOCUMENT_ADD . '-' . $model->id,
                'guard_name' => Guard::getDefaultName($model),
            ]);
            $permissions[] = Permission::create([
                'name' => Setting::PERMISSION_CLUB_CLAIM_ACCEPT . '-' . $model->id,
                'guard_name' => Guard::getDefaultName($model),
            ]);
            $permissions[] = Permission::create([
                'name' => Setting::PERMISSION_CLUB_CLAIM_REJECT . '-' . $model->id,
                'guard_name' => Guard::getDefaultName($model),
            ]);

            //owner of the club
            $user->givePermissionTo($permissions);
        }

        if(get_class($model) == Post::class) {
            $update = Permission::create([
                'name' => Setting::PERMISSION_POST_UPDATE . '-' . $model->id,
                'guard_name' => Guard::getDefaultName($model),
            ]);
            $delete = Permission::create([
                'name' => Setting::PERMISSION_POST_DELETE . '-' . $model->id,
                'guard_name' => Guard::getDefaultName($model),
            ]);

            $user->givePermissionTo([
                $update,
                $delete
            ]);
        }

        if(get_class($model) == Question::class) {
            $update = Permission::create([
                'name' => Setting::PERMISSION_QUESTION_UPDATE . '-' . $model->id,
                'guard_name' => Guard::getDefaultName($model),
            ]);
            $delete = Permission::create([
                'guard_name' => Guard::getDefaultName($model),
                'name' => Setting::PERMISSION_QUESTION_DELETE . '-' . $model->id,
            ]);

            $user->givePermissionTo([
                $update,
                $delete
            ]);
        }

        if(get_class($model) == Task::class) {
            $update = Permission::create([
                'name' => Setting::PERMISSION_TASK_UPDATE . '-' . $model->id,
                'guard_name' => Guard::getDefaultName($model),
            ]);
            $delete = Permission::create([
                'guard_name' => Guard::getDefaultName($model),
                'name' => Setting::PERMISSION_TASK_DELETE . '-' . $model->id,
            ]);

            $user->givePermissionTo([
                $update,
                $delete
            ]);
        }
    }
}
