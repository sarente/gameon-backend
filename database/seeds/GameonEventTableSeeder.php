<?php

use App\Models\GameonEvent;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class GameonEventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        //First of all add permission to db then create roles thus connect the permission to related role
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\Models\GameonEvent::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $gameon_event_names = [
            //Onboarding_Introduction
            'task-count-show',
            'task-island-mask',
            'task-done',
            'task-list-show',
            'task-list-open',
            'message-show',
            'question-island-mask',
            'rosette-show',
            'qa-artifact-open',
            'question-answered',
            'qa-show',
            'home-show',
            'club-island-unlock',
            'project-island-unlock',
            'classroom-open',
            'profile-open',
            'profile-update',
            'billboard-island-unlock',
            'square-island-unlock',
            'level-up',
            //All system from excel file

        ];

        foreach ($gameon_event_names as $gameon_event_name)
            \App\Models\GameonEvent::create([
                'name' => $gameon_event_name,
            ]);

        //Put keys in database
        $gameon_events = GameonEvent::all();
        foreach ($gameon_events as $gameon_event) {
            Setting::setByKey($gameon_event->name, $gameon_event->event_no);
        }
    }
}
