<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserPoint
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $result_id
 * @property int|null $workflow_id
 * @property int $category_id
 * @property int $point
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\Result|null $result
 * @property-read \App\Models\User $user
 * @property-read \App\Models\CustomWorkflow|null $workflow
 * @method static \Illuminate\Database\Eloquent\Builder|UserPoint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPoint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPoint query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPoint whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPoint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPoint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPoint wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPoint whereResultId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPoint whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPoint whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPoint whereWorkflowId($value)
 * @mixin \Eloquent
 */
class UserPoint extends Model
{

    protected $table = "user_point";

    protected $fillable = [
        'point',
        'user_id',
        'category_id',
    ];
    protected $hidden = [
        'id',
        'updated_at',
        'created_at',
        'user',
    ];

    public function result()
    {
        return $this->belongsTo(Result::class, 'result_id');
    }
    public function workflow()
    {
        return $this->belongsTo(CustomWorkflow::class, 'workflow_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
