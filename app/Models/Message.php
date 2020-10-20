<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Message
 *
 * @property int $id
 * @property int $message_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $messageable
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MessageTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message orderByTranslation($key, $sortmethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereMessageType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message withTranslation()
 * @mixin \Eloquent
 * @property string $message
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereMessage($value)
 */
class Message extends Model
{
    use LogsActivity,HasTranslations;

    protected $fillable = [
        'message_type',
        'message'
    ];
    public $translatable = [
        'message',
    ];
    protected $casts=[
        'message'=>'array',
    ];

    public function messageable()
    {
        return $this->morphTo();
    }

}
