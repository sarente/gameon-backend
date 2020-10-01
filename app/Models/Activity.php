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
        'metadata',
    ];
    protected $fillable = [
        'name',
        'return_value',
        'type'
    ];
    protected $casts=[
        'return_value'=>'array',
        'metadata'=>'array',
        'name'=>'array',
    ];

    public $hidden=[
        'created_at',
        'updated_at'
    ];
    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
