<?php

namespace App\Models\Avatar;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Guard;

/**
 * App\Models\Avatar\Dress
 *
 * @property int $id
 * @property int|null $price
 * @property int $gender
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Avatar\Avatar[] $avatar
 * @property-read int|null $avatar_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $icon
 * @property-read int|null $icon_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Avatar\Posture[] $postures
 * @property-read int|null $postures_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Dress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Dress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Dress query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Dress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Dress whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Dress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Dress wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Dress whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Dress extends Model
{
    use LogsActivity;

    protected $fillable = [
        'price',
    ];

    protected $hidden = [
        'avatar'
    ];

    public function postures()
    {
        return $this->morphMany(Posture::class, 'posturable');
    }

    public function icon()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function avatar(): MorphToMany
    {
        return $this->morphToMany(
            Avatar::class,
            'item',
            'avatar_has_item',
            'item_id',
            'avatar_id'
        );
    }

    public static function boot()
    {
        parent::boot();

        parent::creating(function (self $model) {
            if (!is_null($model->type)) {
                $model->type = $model->type . '-' . abs(crc32(uniqid()));
            }
        });
    }
}
