<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\AccessoryTranslation
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $locale
 * @property int $accessory_id
 * @property-read \App\Models\Accessory $accessory
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccessoryTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccessoryTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccessoryTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccessoryTranslation whereAccessoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccessoryTranslation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccessoryTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccessoryTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccessoryTranslation whereName($value)
 * @mixin \Eloquent
 */
class AccessoryTranslation extends Model
{
    use LogsActivity;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'description'
    ];

    function accessory()
    {
        return $this->belongsTo(Accessory::class);
    }

}
