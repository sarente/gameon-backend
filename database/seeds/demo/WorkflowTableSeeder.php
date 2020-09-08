<?php

namespace App\Database\Seeds\Demo;

use App\Models\Category;
use App\Models\Setting;
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

        $categories=Category::all()->pluck('id');
        //dd($categories);

        foreach ($categories as $key=> $value){
            $workflow = new \App\Models\CustomWorkflow([
                'name' => "Test Work Flow",
                //'type' => Setting::WF_TYPE_WF,
                'config' => null
            ]);
            $workflow->category()->associate($value);
            $workflow->save();
        }
    }
}
