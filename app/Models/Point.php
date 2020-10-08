<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Point
 *
 * @property int $id
 * @property int $user_id
 * @property string $artifact_name
 * @property int $point
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereArtifactName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereUserId($value)
 * @mixin \Eloquent
 * @property int|null $result_id
 * @property int|null $workflow_id
 * @property int $category_id
 * @method static \Illuminate\Database\Eloquent\Builder|Point whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Point whereResultId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Point whereWorkflowId($value)
 */
class Point extends Model
{
    use LogsActivity;

    protected $table = 'user_point';

    protected $fillable = [
        'user_id',
        'point',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getPoints($artifact_name)
    {
        $query = self::select('user_id', 'artifact_name', DB::raw('CONVERT(SUM(point),SIGNED) as point'))
            ->groupBy('user_id', 'artifact_name')->latest('point');
        return $query->where(['artifact_name' => $artifact_name])->get();
    }
}
