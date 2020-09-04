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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}