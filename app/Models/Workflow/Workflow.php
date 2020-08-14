<?php

namespace App\Models\Workflow;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function transitions()
    {
        return $this->hasMany(Transition::class);
    }

    public function type()
    {
        return $this->belongsTo(WorkflowType::class, 'workflow_type_id');
    }
}
