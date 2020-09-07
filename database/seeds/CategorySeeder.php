<?php

use App\Models\Activity;
use App\Models\Workflow\Transition;
use App\Models\Workflow\Workflow;
use App\Models\Workflow\WorkflowType;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new \App\Models\Category([
            'name' => "Test Category"
        ]);
        $category->save();
        $category->users()->attach([1,2,3]);
    }
}
