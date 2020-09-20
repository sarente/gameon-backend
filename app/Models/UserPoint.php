<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPoint extends Model
{

    protected $table = "user_point";

    protected $fillable = [
        'point',
    ];

    public function activityResult()
    {
        return $this->belongsTo(ActivityResult::class, 'activity_result_id');
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
