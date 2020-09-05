<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

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
