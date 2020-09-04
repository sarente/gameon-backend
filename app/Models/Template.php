<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $hidden = [
        'pivot',
        'created_at',
        'updated_at'
    ];
}
