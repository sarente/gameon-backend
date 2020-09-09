<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use LogsActivity,HasTranslations;

    protected $fillable = [
        'name',
        'description',
        'category_id',
    ];

    protected $hidden = [
        'translations',
        'pivot',
        'created_at',
        'updated_at'
    ];
    public $translatable = ['name','description'];

    public function levels()
    {
        return $this->hasMany(Level::class);
    }

    public function workflows()
    {
        return $this->hasMany(CustomWorkflow::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_category')->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
