<?php

namespace App\Models\Avatar;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Avatar\ItemColor
 *
 * @property int $id
 * @property int $color
 * @property string $colorable_type
 * @property string $colorable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $icon
 * @property-read int|null $icon_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Avatar\Posture[] $postures
 * @property-read int|null $postures_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\ItemColor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\ItemColor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\ItemColor query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\ItemColor whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\ItemColor whereColorableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\ItemColor whereColorableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\ItemColor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\ItemColor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\ItemColor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ItemColor extends Model
{
    use LogsActivity;

    protected $fillable = [
        'color',
    ];

    protected $hidden = [
        'colorable_type',
        'colorable_id',
    ];

    public function postures()
    {
        return $this->morphMany(Posture::class, 'posturable');
    }
    //TODO: check it again
    public function icon()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}

