<?php

namespace App\Models\Avatar;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use DB;

/**
 * App\Models\Avatar\Avatar
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $posture
 * @property int|null $hair_color
 * @property int $user_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Avatar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Avatar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Avatar query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Avatar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Avatar whereHairColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Avatar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Avatar wherePosture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Avatar whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Avatar whereUserId($value)
 * @mixin \Eloquent
 */
class Avatar extends Model
{
    //Status
    //0 : almamış
    //1: almış ama giymemiş
    //2: giymiş

    use LogsActivity;

    protected $fillable = [
        'posture',
    ];

    protected $hidden = [
        'posturable_type',
        'posturable_id',
        'hair_id',
        'dress_id',
        'jeans_id',
        'shoe_id',
        'skin_id',
        'tshirt_id',
        'eye_id',
        'pivot'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items($type)
    {
        switch ($type) {
            case 'hair':
                return $this->morphedByMany(
                    Hair::class,
                    'item',
                    'avatar_has_item')
                    ->withPivot('is_worn', 'color');
            case 'headgear':
                return $this->morphedByMany(
                    Headgear::class,
                    'item',
                    'avatar_has_item')
                    ->withPivot('is_worn');
            case 'dress':
                return $this->morphedByMany(
                    Dress::class,
                    'item',
                    'avatar_has_item')
                    ->withPivot('is_worn');
            case 'jeans':
                return $this->morphedByMany(
                    Jeans::class,
                    'item',
                    'avatar_has_item')
                    ->withPivot('is_worn');
            case 'tshirt':
                return $this->morphedByMany(
                    Tshirt::class,
                    'item',
                    'avatar_has_item')
                    ->withPivot('is_worn');
            case 'skin':
                return $this->morphedByMany(
                    Skin::class,
                    'item',
                    'avatar_has_item')
                    ->withPivot('is_worn');
            case 'shoe':
                return $this->morphedByMany(
                    Shoe::class,
                    'item',
                    'avatar_has_item')
                    ->withPivot('is_worn');
            case 'eye':
                return $this->morphedByMany(
                    Eye::class,
                    'item',
                    'avatar_has_item')
                    ->withPivot('is_worn');
        }
    }
}
