<?php

namespace App\Models\Workflow;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;

class Transition extends Model
{
    protected $fillable = [
        'name',
        'from_activity_id',
        'to_activity_id'
    ];

    protected $hidden = [
        'created_at',
        'updates_at',
        'workflow_id',
        'from_activity_id',
        'to_activity_id'
    ];

    protected $appends = [
        'from',
        'to'
    ];

    public function getFromAttribute($value)
    {
        return $this->from_activity->name;
    }

    public function getToAttribute($value)
    {
        return $this->to_activity->name;
    }

    public function workflow()
    {
        return $this->belongsTo(Workflow::class);
    }

    public function from_activity()
    {
        return $this->hasOne(Activity::class,'id', 'from_activity_id');
    }

    public function to_activity()
    {
        return $this->hasOne(Activity::class,'id', 'to_activity_id');
    }
}
