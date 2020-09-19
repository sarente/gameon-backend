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
        //dd($workflowKeys,$categories);
        //dd($workflowDefinition['union_of_forces']);

        foreach ($categories as $key => $value) {
            //Log::info($value);

            if ($key == 0) {
                $workflow = new \App\Models\CustomWorkflow([
                    'name' => $workflowKeys[0],
                    'config' => $workflowDefinition['union_of_forces']
                ]);
                $workflow->category()->associate($value);
                $workflow->save();
                //
                $workflow = new \App\Models\CustomWorkflow([
                    'name' => $workflowKeys[1],
                    'config' => $workflowDefinition['bona_fides']
                ]);
                $workflow->category()->associate($value);
                $workflow->save();
                //
                $workflow = new \App\Models\CustomWorkflow([
                    'name' => $workflowKeys[2],
                    'config' => $workflowDefinition['being_we_centered']
                ]);
                $workflow->category()->associate($value);
                $workflow->save();
                //
                $workflow = new \App\Models\CustomWorkflow([
                    'name' => $workflowKeys[3],
                    'config' => $workflowDefinition['clearance']
                ]);
                $workflow->category()->associate($value);
                $workflow->save();
                //
                $workflow = new \App\Models\CustomWorkflow([
                    'name' => $workflowKeys[4],
                    'config' => $workflowDefinition['bona_fides']
                ]);
                $workflow->category()->associate($value);
                $workflow->save();

            } else if ($key == 1) {
                $workflow = new \App\Models\CustomWorkflow([
                    'name' => $workflowKeys[5],
                    'config' => $workflowDefinition['having_an_analytical_perspective']
                ]);
                $workflow->category()->associate($value);
                $workflow->save();
                //
                $workflow = new \App\Models\CustomWorkflow([
                    'name' => $workflowKeys[6],
                    'config' => $workflowDefinition['being_creative_band_innovative']
                ]);
                $workflow->category()->associate($value);
                $workflow->save();
                //
                $workflow = new \App\Models\CustomWorkflow([
                    'name' => $workflowKeys[7],
                    'config' => $workflowDefinition['taking_initiative']
                ]);
                $workflow->category()->associate($value);
                $workflow->save();
                //
                $workflow = new \App\Models\CustomWorkflow([
                    'name' => $workflowKeys[8],
                    'config' => $workflowDefinition['agility']
                ]);
                $workflow->category()->associate($value);
                $workflow->save();
                //
                $workflow = new \App\Models\CustomWorkflow([
                    'name' => $workflowKeys[9],
                    'config' => $workflowDefinition['communication']
                ]);
                $workflow->category()->associate($value);
                $workflow->save();
            }
        }
    }
}
