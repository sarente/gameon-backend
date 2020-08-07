<?php

namespace App\Models\Workflow;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at',
        'updates_at',
        'workflow_id'
    ];

    public function workflow()
    {
        return $this->belongsTo(Workflow::class);
    }
}
