<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    protected $fillable = [
        'items'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
