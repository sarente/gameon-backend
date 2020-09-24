<?php
/*
 * @author Nicolas Grekas <p@tchwork.com>*/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \App\Exceptions\WorkFlow\DuplicateWorkFlowException;
use ZeroDaHero\LaravelWorkflow\WorkflowRegistry;
use function Composer\Autoload\includeFile;

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


    protected static function boot()
    {


        static::saving(function (self $model) {

            //$registry = app()->make('workflow');
            $config =include(config_path('workflow00.php'));
            //dd($config['wf_02']);

            $registryConfig = [
                'track_loaded' => true,
                'ignore_duplicates' => true
            ];

            $registry = new WorkflowRegistry($config, $registryConfig);
            $subject = new UserWorkflow();
            $workflow = $registry->get($subject);

            //$this->expectException(DuplicateWorkFlowException::class);
            try {
                $registry->addFromArray('wf_02',$config['wf_02']);
                //$registry->addFromArray($model->name, $model->config);
            } catch (DuplicateWorkFlowException $e) {
                throw new DuplicateWorkFlowException();
            }
        });
        parent::boot();
    }
}
