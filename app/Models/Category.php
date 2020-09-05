<?php

namespace App\Models;

use App\Models\Workflow\Workflow;
use App\Models\Workflow\WorkflowType;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'translations',
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
        return $this->hasMany(Workflow::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_category')->withTimestamps();
    }
}
