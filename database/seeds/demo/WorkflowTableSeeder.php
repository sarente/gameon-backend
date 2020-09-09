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
        //TODO: get workflow configs from files

        $categories = Category::get(['name']);
        $workflowDefinition = include(config_path('workflow.php'));
        //$workflowKeys=array_keys($workflowDefinition);

        foreach ($categories as $key => $value) {
            dd($value);
            if ($key < 1) {
                $workflow = new \App\Models\CustomWorkflow([
                    'name' => $value->name,
                    'config' => $workflowDefinition['values']
                ]);
            }

            $workflow->category()->associate($value);
            $workflow->save();
        }
    }
}
