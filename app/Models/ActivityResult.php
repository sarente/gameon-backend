<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;
use ZeroDaHero\LaravelWorkflow\Traits\WorkflowTrait;

class ActivityResult extends Model
{
    use LogsActivity;

    protected $table = "activities";

    protected $attributes = [
        'type' => Setting::ACTIVITY_RETURN,
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
