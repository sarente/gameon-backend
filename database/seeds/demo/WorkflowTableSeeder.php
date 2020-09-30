<?php

namespace App\Database\Seeds\Demo;

use App\Models\Category;
use Illuminate\Database\Seeder;

class WorkflowTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        //First of all add permission to db then create roles thus connect the permission to related role
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\CustomWorkflow::truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        //TODO: get workflow configs from files

        $categories = Category::pluck('id')->toArray();
        $workflowDefinition = include(config_path('workflow.php'));

        $workflowKeys = array_keys($workflowDefinition);

        foreach ($categories as $key => $value) {

            if ($key == 0) {
                $workflow = new \App\Models\CustomWorkflow([
                    'name' => $workflowKeys[$key],
                    'config' => $workflowDefinition['wf_01']
                ]);
                $workflow->category()->associate($value);
                $workflow->save();

                $workflow = new \App\Models\CustomWorkflow([
                    'name' => $workflowKeys[$key],
                    'config' => $workflowDefinition['wf_02']
                ]);
                $workflow->category()->associate($value);
                $workflow->save();

            } else if ($key == 1) {
                $workflow = new \App\Models\CustomWorkflow([
                    'name' => $workflowKeys[$key],
                    'config' => $workflowDefinition['wf_03']
                ]);
                $workflow->category()->associate($value);
                $workflow->save();
                //
            }
        }
    }
}
