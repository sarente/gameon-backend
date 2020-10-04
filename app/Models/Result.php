<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;
use ZeroDaHero\LaravelWorkflow\Traits\WorkflowTrait;
//We get result of workflow from this object (Point-Reward)
class Result extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name',
        'type',
        'point'
    ];
    
    protected $casts=[
        'metadata'=>'array'
    ];

    public $hidden=[
        'created_at',
        'updated_at'
    ];

    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function rewards(): MorphToMany
    {
        return $this->morphToMany(
            Reward::class,
            'model',
            'model_has_rewards',
            'model_id',
            'reward_id'
        );
    }
}
