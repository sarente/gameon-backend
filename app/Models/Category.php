<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use LogsActivity;
    //use Translatable;

    public $translatedAttributes = [
        'name',
    ];

    protected $hidden = [
        'pivot',
        'created_at',
        'updated_at',
        'translations',
    ];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_category');
    }

    public function statuses()
    {
        return $this->belongsToMany(Status::class);
    }

    public function translation()
    {
        return $this->hasOne(CategoryTranslation::class);
    }
}
