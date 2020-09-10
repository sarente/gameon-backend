<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ZeroDaHero\LaravelWorkflow\Traits\WorkflowTrait;

class UserWorkflow extends Model
{
    use WorkflowTrait;

    protected $table = "user_workflow";

    protected $casts = [
        'marking' => 'array',
        'current_place' => 'array'
    ];

    public function customWorkflow()
    {
        return $this->belongsTo(CustomWorkflow::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
