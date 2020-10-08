<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ZeroDaHero\LaravelWorkflow\Traits\WorkflowTrait;

/**
 * App\Models\UserWorkflow
 *
 * @property int $id
 * @property int $user_id
 * @property int $workflow_id
 * @property array|null $current_place
 * @property array|null $marking
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $category
 * @property-read int|null $category_count
 * @property-read \App\Models\CustomWorkflow $customWorkflow
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserWorkflow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserWorkflow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserWorkflow query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserWorkflow whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserWorkflow whereCurrentPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserWorkflow whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserWorkflow whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserWorkflow whereMarking($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserWorkflow whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserWorkflow whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserWorkflow whereWorkflowId($value)
 * @mixin \Eloquent
 */
class UserWorkflow extends Model
{
    use WorkflowTrait;

    protected $table = "user_workflow";

    protected $fillable = [
        'marking',
        'user_id',
        'workflow_id',
    ];

    protected $casts = [
        'marking' => 'array',
        'current_place' => 'array'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'current_place',
    ];

    public function customWorkflow()
    {
        return $this->belongsTo(CustomWorkflow::class, 'workflow_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->hasManyThrough(Category::class, CustomWorkflow::class);
    }
}
