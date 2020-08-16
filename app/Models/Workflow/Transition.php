<?php

namespace App\Models\Workflow;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;

class Transition extends Model
{
    protected $fillable = [
        'name',
        'from_state_id',
        'to_state_id'
    ];

    protected $hidden = [
        'created_at',
        'updates_at',
        'workflow_id',
        'from_state_id',
        'to_state_id'
    ];

    protected $appends = [
        'from',
        'to'
    ];

    public function getFromAttribute($value)
    {
        return $this->from_state->name;
    }

    public function getToAttribute($value)
    {
        return $this->to_state->name;
    }

    public function workflow()
    {
        return $this->belongsTo(Workflow::class);
    }

    public function from_state()
    {
        return $this->hasOne(Activity::class,'id', 'from_state_id');
    }

    public function to_state()
    {
        return $this->hasOne(Activity::class,'id', 'to_state_id');
    }
}
