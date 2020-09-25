<?php
/*
 * @author Nicolas Grekas <p@tchwork.com>*/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \App\Exceptions\WorkFlow\DuplicateWorkFlowException;
use ZeroDaHero\LaravelWorkflow\WorkflowRegistry;


/*
 * @author Javad Fathi <k1fathi33@gmail.com>
 * */

class CustomWorkflow extends Model
{
    protected $table = 'workflows';

    protected $fillable = [
        'name',
        'config',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'category_id',
    ];

    protected $casts = [
        'config' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_workflow','workflow_id','user_id')->withPivot('marking');
    }
}
