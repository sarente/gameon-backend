<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class CategoryTranslation extends Model
{
    use LogsActivity;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
    ];

    function category()
    {
        return $this->belongsTo(Category::class);
    }
}
