<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Activitylog\Traits\LogsActivity;

//We get result of workflow from this object (Point-Reward)
/**
 * App\Models\Result
 *
 * @property int $id
 * @property string $name
 * @property int|null $point
 * @property string|null $type
 * @property array|null $metadata
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $image
 * @property-read int|null $image_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reward[] $rewards
 * @property-read int|null $rewards_count
 * @method static \Illuminate\Database\Eloquent\Builder|Result newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Result newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Result query()
 * @method static \Illuminate\Database\Eloquent\Builder|Result whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Result whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Result whereMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Result whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Result wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Result whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Result whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
