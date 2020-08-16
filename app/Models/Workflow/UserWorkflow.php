<?php

namespace App\Models\Workflow;

use Illuminate\Database\Eloquent\Model;
use ZeroDaHero\LaravelWorkflow\Traits\WorkflowTrait;

class UserWorkflow extends Model
{
    use WorkflowTrait;

    protected $table = "user_workflow";
}
