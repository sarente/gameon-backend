<?php

namespace App\Models\Workflow;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;

class State extends Model
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

    public function workflow()
    {
        return $this->belongsTo(Workflow::class);
    }
}
