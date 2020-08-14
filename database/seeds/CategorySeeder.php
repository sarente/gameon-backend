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
            'name' => "İnsan Kaynakları"
        ]);
        $category->save();

        $workflow_type = new WorkflowType(['name' => 'İşe Alım']);
        $workflow_type->category()->associate($category);
        $workflow_type->save();

        $workflow = new Workflow(['name' => 'Backend Pozisyonu İçin Eleman Alımı']);
        $workflow->type()->associate($workflow_type);
        $workflow->save();

        $from_state = null;
        $to_state = null;
        $activities = ['Giriş', 'Gelişme', 'Sonuç'];

        foreach ($activities as $key => $activity) {

            $activity = new Activity(['name' => $activity]);
            $activity->workflow()->associate($workflow);
            $activity->save();

            $to_state = $activity->id;

            if ($from_state && $to_state) {
                $transition = new Transition(['name' => $workflow->name . ' transition' . $key, 'from_state_id' => $from_state, 'to_state_id' => $to_state]);
                $transition->workflow()->associate($workflow);
                $transition->save();
            }

            $from_state = $activity->id;
        }

        /*$category = new \App\Models\Category([
            'name' => "Satış"
        ]);
        $category->save();*/
    }
}
