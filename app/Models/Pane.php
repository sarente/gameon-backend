<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pane extends Model
{
    protected $hidden = [
        'pivot',
        'created_at',
        'updated_at'
    ];

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

}
