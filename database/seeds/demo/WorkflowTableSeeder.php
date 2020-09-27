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
        //TODO: change workflow configs from files

        $category = Category::find(1);
        $workflowDefinition = include(config_path('workflow.php'));

            $name = $category->translations['name']['tr'];

            $workflow = new \App\Models\CustomWorkflow([
                'name' => 'straight',
                'config' => $workflowDefinition['straight']
            ]);

            $workflow->category()->associate($workflow);
            $workflow->save();
        }
}
