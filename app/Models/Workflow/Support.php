<?php

namespace App\Models\Workflow;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $fillable = [
        'model_name',
    ];

    protected $hidden = [
        'workflow_id',
    ];

    public function workflow()
    {
        return $this->belongsTo(Workflow::class);
    }

    //Get work flow id to return by order
    public function getByWorkflowId(int $wf_id)
    {
        return $this->workflow()->newQuery()->where('work_',$wf_id)->pluck('model_name');
    }

}
