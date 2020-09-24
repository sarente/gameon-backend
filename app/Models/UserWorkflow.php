<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ZeroDaHero\LaravelWorkflow\Exceptions\DuplicateWorkflowException;
use ZeroDaHero\LaravelWorkflow\Traits\WorkflowTrait;

class UserWorkflow extends Model
{
    use WorkflowTrait;

    protected $table = "user_workflow";

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
