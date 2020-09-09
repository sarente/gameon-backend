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

        $categories = Category::query()->get(['name']);
        $workflowDefinition = include(config_path('workflow.php'));
        //dd($workflowDefinition['values']['places']);
        //dd($categories->toArray());
        //$workflowKeys=array_keys($workflowDefinition);

        foreach ($categories as $key => $value) {
            $name = $value->translations['name']['tr'];

            switch ($key) {
                case $key == 0:
                    $workflow = new \App\Models\CustomWorkflow([
                        'name' => $name,
                        'config' => $workflowDefinition['values']
                    ]);
                    break;
                case $key == 1:
                    $workflow = new \App\Models\CustomWorkflow([
                        'name' => $name,
                        'config' => $workflowDefinition['base_competence']
                    ]);
                    break;
               /* case $key == 2:
                    $workflow = new \App\Models\CustomWorkflow([
                        'name' => $name,
                        'config' => $workflowDefinition['management_competence']
                    ]);
                    break;
                case $key == 3:
                    $workflow = new \App\Models\CustomWorkflow([
                        'name' => $name,
                        'config' => $workflowDefinition['high_level_competence']
                    ]);
                    break;*/
                case $key == 2:
                    $workflow = new \App\Models\CustomWorkflow([
                        'name' => $name,
                        'config' => $workflowDefinition['entertainment']
                    ]);
                    break;
            }

            $workflow->category()->associate($value);
            $workflow->save();
        }
    }
}
