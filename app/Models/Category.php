<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use LogsActivity, HasTranslations;

    public $translatable = [
        'name',
        'description'
    ];
    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'created_at' => 'datetime:Y-m-d H:00',
    ];
    protected $fillable = [
        'name',
        'description',
        'category_id',
    ];
    protected $hidden = [
         'pivot',
        'created_at',
        'updated_at'
    ];

    public function levels()
    {
        return $this->hasMany(Level::class);
    }

    public function workflows()
    {
        return $this->hasMany(CustomWorkflow::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
