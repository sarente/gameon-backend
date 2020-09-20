<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Reward extends Model
{
    use LogsActivity, HasTranslations;

    public $translatable = [
        'name',
        'description'
    ];

    protected $casts=[
        'description'=>'array',
        'name'=>'array',
    ];

    protected $fillable = [
        'name',
        'description',
        'type'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
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
