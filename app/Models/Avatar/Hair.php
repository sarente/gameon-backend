<?php

namespace App\Models\Avatar;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Avatar\Hair
 *
 * @property int $id
 * @property int|null $gender
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Avatar\Avatar[] $avatar
 * @property-read int|null $avatar_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Avatar\ItemColor[] $colors
 * @property-read int|null $colors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $icon
 * @property-read int|null $icon_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Hair newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Hair newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Hair query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Hair whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Hair whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Hair whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Hair whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Hair extends Model
{
    use LogsActivity;

    protected $fillable = [
        'color',
    ];

    protected $hidden = [
        'avatar',
        'pivot'
    ];

    public function getByStyle($style)
    {
        return $this->where('style', $style)->get();
    }

    public function icon()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function colors()
    {
        return $this->morphMany(ItemColor::class, 'colorable');
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
}
