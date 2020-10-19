<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property array $name
 * @property array|null $description
 * @property mixed|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $category_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read Category|null $category
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Level[] $levels
 * @property-read int|null $levels_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CustomWorkflow[] $workflows
 * @property-read int|null $workflows_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    use LogsActivity, HasTranslations;

    public $translatable = [
        'name',
        'description'
    ];
    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'created_at' => 'datetime:Y-m-d H:00',
    ];
    protected $fillable = [
        'name',
        'enable',
        'description',
        'category_id',
    ];
    protected $hidden = [
         'pivot',
        'created_at',
        'updated_at'
    ];

    public function levels()
    {
        return $this->hasMany(Level::class);
    }

    public function workflows()
    {
        return $this->hasMany(CustomWorkflow::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
