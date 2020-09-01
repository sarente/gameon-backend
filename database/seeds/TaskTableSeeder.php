<?php

use App\Events\ModelCreated;
use App\Models\Pane;
use App\Models\Rosette;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()

    {
        //First of all add permission to db then create roles thus connect the permission to related role
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\TaskTranslation::truncate();
        Task::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        //Set task names
        $intro_task_names = [
            'Soruyu Cevapla',
            'SINIFINA GÖZAT',
            'PROFİLİNİ GÜNCELLE',
        ];
        $intro_task_descriptions = [
            'Soruyu Cevapla',
            'SINIFINA GÖZAT',
            'PROFİLİNİ GÜNCELLE'
        ];
        //////////////////////////////////////
        $task = $this->addTask($intro_task_names[0],$intro_task_descriptions[0]);
        //Bilge 1 rozet
        $rosette = Rosette::find(8);
        $task->rosettes()->sync($rosette);
        unset($task);
        //////////////////////////////////////
        $task = $this->addTask($intro_task_names[1],$intro_task_descriptions[1]);
        //banyan rozet
        $rosette = Rosette::find(4);
        $task->rosettes()->sync($rosette);
        unset($task);
        //////////////////////////////////////
        $task = $this->addTask($intro_task_names[2],$intro_task_descriptions[2]);
        //Gezgin 1 rozet
        $rosette = Rosette::find(1);
        $task->rosettes()->sync($rosette);
        unset($task);
        //////////////////////////////////////
    }
    public function addTask($name,$desc)
    {
        $task = new Task([
            'name:tr' => $name,
            'description:tr' => $desc,
            'experience' => rand(1, 15) * 10,
            'point' => rand(1, 15) * 10,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addMonths(1)
        ]);
        //Creator
        $task->creator()->associate(User::find(1));
        //Pane 0 of tasks
        $level = Pane::find(13);
        $task->level()->associate($level);
        //Endorser
        $endorser = User::find(1);
        $task->endorser()->associate($endorser);
        //Create task
        $task->save();

        event(new ModelCreated(User::first(), $task));

        return $task;
    }
}
