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
        $workflowDefinition = include(config_path('workflow00.php'));

        $workflowKeys = array_keys($workflowDefinition);
        //dd($categories,$workflowKeys[0],$workflowDefinition);

        foreach ($categories as $key => $value) {
            //Log::info($value);
                $workflow = new \App\Models\CustomWorkflow([
                    'name' => $workflowKeys[0],
                    'config' => $workflowDefinition
                ]);
                $workflow->category()->associate($value);
                $workflow->save();
        }
    }
}
