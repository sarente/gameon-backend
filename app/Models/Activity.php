<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;
use ZeroDaHero\LaravelWorkflow\Traits\WorkflowTrait;

class Activity extends Model
{
    use LogsActivity,HasTranslations;

    public $translatable = [
        'name',
    ];
    protected $fillable = [
        'name',
        'type'
    ];
    protected $casts=[
        'metadata'=>'array',
        'name'=>'array',
    ];

    public $hidden=[
        'created_at',
        'updated_at'
    ];
    protected $attributes = [
        'type' => Setting::ACTIVITY_ACTION,
    ];

    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
