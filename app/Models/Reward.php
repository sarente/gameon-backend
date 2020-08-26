<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Activitylog\Traits\LogsActivity;

class Reward extends Model
{
    use LogsActivity;
    //use Translatable;

    protected $guarded = [
        'id',
        'image'
    ];

    protected $fillable = [
        'type'
    ];

    public $translatedAttributes = [
        'name',
        'description'
    ];

    protected $hidden = [
        'translations',
        'user_id',
        'pivot'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function translation()
    {
        return $this->hasOne(RewardTranslation::class);
    }

    public function messages(): MorphToMany
    {
        return $this->morphToMany(
            Message::class,
            'model',
            'model_has_messages',
            'model_id',
            'message_id'
        );
    }
}
