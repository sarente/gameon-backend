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
        'created_at',
        'updated_at',
        'translations',
    ];

    public function workflows()
    {
        return $this->hasMany(Workflow::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_category')->withPivot('level_no');
    }
}
