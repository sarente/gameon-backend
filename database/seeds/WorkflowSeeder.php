<?php

use Illuminate\Database\Seeder;

class WorkflowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Workflow\Workflow::create([
            'name' => "Proje 1",
            'category_id' => 1,
            'user_id' => 1,
        ]);
    }
}
