<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Activitylog\Traits\LogsActivity;
use ZeroDaHero\LaravelWorkflow\Traits\WorkflowTrait;

class Activity extends Model
{
    use LogsActivity, WorkflowTrait;

    protected $fillable = [
        'name',
        'point'
    ];

    public $hidden=[
        'created_at',
        'updated_at'
    ];

    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function rewards(): MorphToMany
    {
        return $this->morphToMany(
            Reward::class,
            'model',
            'model_has_rewards',
            'model_id',
            'reward_id'
        );
    }

    public function workflow()
    {
        return $this->belongsTo(\App\Models\CustomWorkflow::class);
    }
}
