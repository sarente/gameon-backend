<?php

namespace App\Models;

use App\Models\Activity;
use App\Models\Category;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use ZeroDaHero\LaravelWorkflow\Exceptions\DuplicateWorkflowException;

class Workflow extends Model
{

    protected $fillable = [
        'name',
        'type',
        'config',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $attributes = [
        'type' => Setting::WF_TYPE_WF,
    ];

//    public static function boot()
//    {
//        parent::boot();
//
//        static::created(function (self $model) {
//            //create last activity as finishing state of workflow
//            $activity = new Activity(['name' => "Final"]);
//            $activity->workflow()->associate($model);
//            $activity->save();
//        });
//    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_workflow')->withPivot('marking');
    }
    /**
     * Load the workflow type definition into the registry
     */
    protected function loadWorkflow()
    {
        $registry = app()->make('workflow');
        $workflowName = 'straight';
        $workflowDefinition = [
            // Workflow definition here
            // (same format as config/symfony docs)
            // This should be the definition only,
            // not including the key for the name.
            // See note below on initial_places for an example.
        ];

        $registry->addFromArray($workflowName, $workflowDefinition);

        // or if catching duplicates

        try {
            $registry->addFromArray($workflowName, $workflowDefinition);
        } catch (DuplicateWorkflowException $e) {
            // already loaded
        }
    }
}
