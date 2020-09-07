<?php

use App\Models\Activity;
use App\Models\Workflow\Transition;
use App\Models\Workflow\Workflow;
use App\Models\Workflow\WorkflowType;
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

        $workflow = new \App\Models\Workflow([
            'name' => "Test Work Flow",
            'config' => null
        ]);
        $workflow->save();
    }
}
