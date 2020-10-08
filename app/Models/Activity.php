<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;
use ZeroDaHero\LaravelWorkflow\Traits\WorkflowTrait;

/**
 * App\Models\Activity
 *
 * @property int $id
 * @property array $name
 * @property string|null $type
 * @property string $kind
 * @property array|null $return_value
 * @property array|null $metadata
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $image
 * @property-read int|null $image_count
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity query()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereKind($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereReturnValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
