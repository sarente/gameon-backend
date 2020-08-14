<?php

namespace App\Models;

use App\Models\Workflow\Workflow;
use App\Models\Workflow\WorkflowType;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use LogsActivity;
    //use Translatable;

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'pivot',
        'created_at',
        'updated_at',
        'translations',
    ];

    public function types()
    {
        return $this->hasMany(WorkflowType::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_category');
    }
}
