<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Activity extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name',
        'category_id',
        'experience',
        'point'
    ];

    public $hidden=[
        'created_at',
        'updated_at'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_activity')->withTimestamps()->withPivot(['status_id']);
    }

    public function rewards()
    {
        return $this->belongsToMany(Reward::class, 'activity_reward');
    }
}
