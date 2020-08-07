<?php

namespace App\Models\Workflow;

use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    protected $fillable = [
        'name',
        'type'
    ];

    protected $hidden = [
        'created_at',
        'updates_at',
    ];

    public function places()
    {
        return $this->hasMany(State::class);
    }

    public function transitions()
    {
        return $this->hasMany(Transition::class);
    }
}
