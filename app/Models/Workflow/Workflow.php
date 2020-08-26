<?php

namespace App\Models\Workflow;

use App\Models\Activity;
use App\Models\Avatar;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function transitions()
    {
        return $this->hasMany(Transition::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_workflow')->withPivot('marking');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (self $model) {

            //create last activity as finishing state of workflow
            $activity = new Activity(['name' => "Final"]);
            $activity->workflow()->associate($model);
            $activity->save();
        });
    }
}
