<?php
/*
 * @author Nicolas Grekas <p@tchwork.com>*/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ZeroDaHero\LaravelWorkflow\Exceptions\DuplicateWorkflowException;

/*
 * @author Javad Fathi <k1fathi33@gmail.com>
 * */

class CustomWorkflow extends Model
{
    protected $table='workflows';

    protected $fillable = [
        'name',
        'type',
        'config',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'config' => 'array',
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

    public function workflowable()
    {
        return $this->morphTo();
    }

    /**
     * Load the workflow type definition into the registry
     */
    protected function loadWorkflow(string $name = null)
    {
        $registry = app()->make('workflow');
        $workflowName = $name ?? $this->name;
        /*   $workflowDefinition = [
               // CustomWorkflow definition here
               // (same format as config/symfony docs)
               // This should be the definition only,
               // not including the key for the name.
               // See note below on initial_places for an example.

               'type' => 'workflow', // or 'state_machine'
               'metadata' => [
                   'title' => 'Activity Publishing CustomWorkflow',
               ],
               'marking_store' => [
                   'type' => 'single_state', // or 'state_machine'
                   //'property' => 'currentPlace', // this is the property on the model
                   'class' => UserWorkflow::class, // you may omit for default, or set to override marking store class
               ],
               'supports' => ['App\Models\Activity'],
               'places' => [
                   'gather_cvs' => ['metadata' => [
                       'max_num_of_words' => 500,
                   ]],
                   'send_quiz',
                   'select_top_3',
                   'offering'
               ], //steps of workflow
               'initial_places' => 'draft', // or set to an array if multiple initial places
               'transitions' => [
                   'to_review' => [
                       'from' => 'draft',
                       'to' => 'review',
                       'metadata' => [
                           'priority' => 0.5,
                       ]
                   ],
                   'publish' => [
                       'from' => 'review',
                       'to' => 'published'
                   ],
                   'reject' => [
                       'from' => 'review',
                       'to' => 'rejected'
                   ]
               ],
           ];*/
        $workflowDefinition = include(config_path('workflow.php'));

        $registry->addFromArray($workflowName, $workflowDefinition['test']);

        // or if catching duplicates

        try {
            $registry->addFromArray($workflowName, $workflowDefinition['test']);
        } catch (DuplicateWorkflowException $e) {
            // already loaded
        }
    }
}
