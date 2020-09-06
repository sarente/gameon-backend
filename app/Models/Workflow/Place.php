<?php

namespace App\Models\Workflow;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'name',
        'order'
    ];

    protected $hidden = [
        'workflow_id',
    ];

    public function getFromAttribute($value)
    {
        return $this->from_activity->name;
    }

    public function workflow()
    {
        return $this->belongsTo(Workflow::class);
    }

    //Get work flow id to return by order
    public function toArrayByWorkflowId(int $wf_id)
    {
        //return $this->workflow()->newQuery()->where('work_',$wf_id)->orderBy('order')->get();
        return $this->workflow()->newQuery()->where('work_',$wf_id)->orderBy('order')->pluck('name');
    }

}
