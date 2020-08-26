<?php

namespace App\Models;

use App\Models\Workflow\State;
use App\Models\Workflow\Workflow;
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

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_activity')->withTimestamps()->withPivot(['status_id']);
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
        return $this->belongsTo(Workflow::class);
    }
}
