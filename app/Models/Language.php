<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Language
 *
 * @property int $id
 * @property string $locale
 * @property string $english
 * @property string $native
 * @property int $is_required
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereEnglish($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereIsRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereNative($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Language extends Model
{
    use LogsActivity;

    protected $fillable = [
        'locale',
        'native',
        'english',
        'is_required',
    ];

    public static function locales()
    {
        return Cache::rememberForever('locales', function () {
            return self::query()->pluck('locale')->toArray();
        });
    }

    public static function requiredLocales()
    {
        return Cache::rememberForever('locales_required', function () {
            return self::query()->where('is_required', true)->pluck('locale')->toArray();
        });
    }

    public static function getEnglishLabels(){
        return Language::query()->pluck('english','id')->toArray();
    }

}
