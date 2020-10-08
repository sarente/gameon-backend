<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $postable_type
 * @property string $postable_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $user_id
 * @property int|null $original_post_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read mixed $from
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $image
 * @property-read int|null $image_count
 * @property-read Post|null $originPost
 * @property-read Model|\Eloquent $postable
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Query\Builder|Post onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereOriginalPostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePostableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePostableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Post withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Post withoutTrashed()
 * @mixin \Eloquent
 */
class Post extends Model
{
    use LogsActivity, SoftDeletes;

    //protected static $logAttributes = ['name', 'text'];

    //only the `deleted` event will get logged automatically
    protected static $recordEvents = ['created', 'deleted'];

    protected $hidden = [
        'postable_type',
        'postable_id'
    ];

    protected $fillable = [
        'original_post_id',
        'postable_id',
        'user_id',
        'postable_type'
    ];

    protected $dates = ['deleted_at'];

    protected $appends = ['from'];

    public function getFromAttribute()
    {
        $postable_type = strtolower(substr($this->postable_type, 11));
        $postable_id=(int)$this->postable_id;

        $artifact = get_class($this->postable);
        switch ($artifact) {
            case Activity::class:
                $postable_name= Activity::withTranslation()->findOrFail($postable_id)->name;
                break;
            case User::class:
                $postable_name = User::findOrFail($postable_id)->name;
                break;
        }

        return [
            'postable_id' => $postable_id,
            'postable_type' => $postable_type,
            'postable_name' => $postable_name,
        ];
    }

    public function postable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->select('id', 'name');
    }

    public function originPost()
    {
        return $this->belongsTo(Post::class, 'original_post_id', 'id')->select('id', 'user_id');
    }

    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
