<?php
/*
 * @author Nicolas Grekas <p@tchwork.com>*/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ZeroDaHero\LaravelWorkflow\Exceptions\DuplicateWorkflowException;

/*
 * @author Javad Fathi <k1fathi33@gmail.com>
 * */

/**
 * App\Models\CustomWorkflow
 *
 * @property int $id
 * @property string $name
 * @property int $enable
 * @property array|null $config
 * @property string|null $start_date
 * @property string|null $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $category_id
 * @property-read \App\Models\Category|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|CustomWorkflow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomWorkflow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomWorkflow query()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomWorkflow whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomWorkflow whereConfig($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomWorkflow whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomWorkflow whereEnable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomWorkflow whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomWorkflow whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomWorkflow whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomWorkflow whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomWorkflow whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CustomWorkflow extends Model
{
    protected $table = 'workflows';

    protected $fillable = [
        'name',
        'enable',
        'config',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'category_id',
    ];

    protected $casts = [
        'config' => 'array',
    ];

    /**
     * TODO:: add this method to boot of class
     */
    public static function loadWorkflow(string $name, array $workflowDefinition)
    {
        $registry = app()->make('workflow');
        $workflowName = $name;
        //$workflowDefinition = include(config_path('workflow1.php'));
        $registry->addFromArray($workflowName, $workflowDefinition);
        // or if catching duplicates
        try {
            $registry->addFromArray($workflowName, $workflowDefinition);
        } catch (DuplicateWorkflowException $e) {
            //throw new DuplicateWorkflowException();
        }
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_workflow','workflow_id','user_id')->withPivot('marking');
    }
}
