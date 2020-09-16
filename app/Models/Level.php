<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = [
        'level_no',
        'max_point',
        'category_id'
    ];
    protected $hidden = [
        'pivot',
        'created_at',
        'updated_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
