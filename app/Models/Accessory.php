<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Accessory
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $image
 * @property-read int|null $image_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $projects
 * @property-read int|null $projects_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task[] $tasks
 * @property-read int|null $tasks_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccessoryTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Accessory listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Accessory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Accessory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Accessory notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Accessory orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Accessory orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Accessory orderByTranslation($key, $sortmethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Accessory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Accessory translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Accessory translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Accessory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Accessory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Accessory whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Accessory whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Accessory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Accessory withTranslation()
 * @mixin \Eloquent
 */
class Accessory extends Model
{
    //
    use LogsActivity;
    use Translatable;


    public $translatedAttributes = [
        'name',
        'description',
    ];
    public $hidden=[
        'pivot',
        'translations',
        'created_at',
        'updated_at',
    ];
    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class,'project_accessory');
    }

    public function tasks()
    {
        return $this->belongsToMany(TAsk::class,'task_accessory');
    }


}
