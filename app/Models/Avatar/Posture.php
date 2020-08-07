<?php

namespace App\Models\Avatar;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Avatar\Posture
 *
 * @property int $id
 * @property int $posture
 * @property string $posturable_type
 * @property string $posturable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $image
 * @property-read int|null $image_count
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $posturable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Posture newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Posture newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Posture query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Posture whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Posture whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Posture wherePosturableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Posture wherePosturableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Posture wherePosture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Posture whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Posture extends Model
{
    use LogsActivity;

    protected $fillable = [
        'posture',
    ];

    protected $hidden = [
        'posturable_type',
        'posturable_id',
    ];

    public function posturable()
    {
        return $this->morphTo();
    }

    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
