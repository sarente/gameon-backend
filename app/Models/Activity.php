<?php

namespace App\Models;

use App\Models\Workflow\State;
use App\Models\Workflow\Workflow;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use ZeroDaHero\LaravelWorkflow\Traits\WorkflowTrait;

class Activity extends Model
{
    use LogsActivity, WorkflowTrait;

    protected $fillable = [
        'name'
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

    public function rewards()
    {
        return $this->belongsToMany(Reward::class, 'activity_reward');
    }

    public function workflow()
    {
        return $this->belongsTo(Workflow::class);
    }
}
