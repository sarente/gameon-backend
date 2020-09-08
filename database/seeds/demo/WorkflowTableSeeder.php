<?php

namespace App\Database\Seeds\Demo;

use App\Models\Category;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class WorkflowTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //TODO: get workflow configs from files

        $categories=Category::all()->pluck('id');
        //dd($categories);
        $workflowDefinition=include(config_path('workflow.php'));
        //dd($workflowDefinition['test']);
        foreach ($categories as $key=> $value){
            $workflow = new \App\Models\CustomWorkflow([
                'name' => "Test Work Flow",
                //'type' => Setting::WF_TYPE_WF,
                'config' =>$workflowDefinition['test']
            ]);
            $workflow->category()->associate($value);
            $workflow->save();
        }
    }
}
