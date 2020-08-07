<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\MessageTranslation
 *
 * @property int $id
 * @property \App\Models\Message $message
 * @property string $locale
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $message_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MessageTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MessageTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MessageTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MessageTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MessageTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MessageTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MessageTranslation whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MessageTranslation whereMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MessageTranslation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MessageTranslation extends Model
{
    use LogsActivity;

    protected $fillable = [
        'message',
        'locale'
    ];

    function message()
    {
        return $this->belongsTo(Message::class);
    }
}
