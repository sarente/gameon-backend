<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ZeroDaHero\LaravelWorkflow\Traits\WorkflowTrait;

class BlogPost extends Model
{
    use WorkflowTrait;
}
