<?php

namespace App\Models\Workflow;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class WorkflowType extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function workflows()
    {
        return $this->hasMany(Workflow::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
