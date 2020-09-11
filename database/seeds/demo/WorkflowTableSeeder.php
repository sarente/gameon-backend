<?php

namespace App\Database\Seeds\Demo;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class WorkflowTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        //TODO: get workflow configs from files

        $categories = Category::select(['id'])->get();
        $workflowDefinition = include(config_path('workflow.php'));

        $workflowKeys = array_keys($workflowDefinition);

        foreach ($categories as $key => $value) {
            //$name = stripLowercaseName($value->translations['name']['en']);
            //Log::info($value);
            if($key == 0){
                    $workflow = new \App\Models\CustomWorkflow([
                        'name' => $workflowKeys[0],
                        'config' => $workflowDefinition['values']
                    ]);
                    $workflow->category()->associate($value);
                    $workflow->save();
                } elseif($key == 1){
                    $workflow = new \App\Models\CustomWorkflow([
                        'name' => $workflowKeys[1],
                        'config' => $workflowDefinition['base_competence']
                    ]);
                    $workflow->category()->associate($value);
                    $workflow->save();
                    //
                    $workflow = new \App\Models\CustomWorkflow([
                        'name' => $workflowKeys[2],
                        'config' => $workflowDefinition['management_competence']
                    ]);

                    $workflow->category()->associate($value);
                    $workflow->save();
                    $workflow = new \App\Models\CustomWorkflow([
                        'name' => $workflowKeys[3],
                        'config' => $workflowDefinition['high_level_competence']
                    ]);

                    $workflow->category()->associate($value);
                    $workflow->save();
                }else{
                    $workflow = new \App\Models\CustomWorkflow([
                        'name' => $workflowKeys[4],
                        'config' => $workflowDefinition['entertainment']
                    ]);
                    $workflow->category()->associate($value);
                    $workflow->save();
                }
            }

        }
}
