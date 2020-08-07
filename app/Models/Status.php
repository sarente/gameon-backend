<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Status extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name'
    ];

    public $hidden = [
        'created_at',
        'updated_at',
    ];
}
