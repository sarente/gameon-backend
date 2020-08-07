<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $col_levels = collect();
        $level_items = [];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\Models\Level::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        /////////////////////////////////////////////////// Project levels goes here
        //Project level 0
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_PROJECT,
            'artifact_status' => 0,
            'max_xp' => 200
        ]);
        $col_levels->push($level_items);
        unset($level_items);

        //Project level 1
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_PROJECT,
            'artifact_status' => 1,

            'max_xp' => 200
        ]);
        //$level_items['message'] = \App\Models\Message::find(21);
        $level_items['medal'] = \App\Models\Medal::find(5);//Isaac Newton
        $col_levels->push($level_items);
        unset($level_items);

        //Project level 2
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_PROJECT,
            'artifact_status' => 2,
            'max_xp' => 200
        ]);
        //$level_items['message'] = \App\Models\Message::find(29);
        $level_items['medal'] = \App\Models\Medal::find(6);//Marie Curie
        $col_levels->push($level_items);
        unset($level_items);

        //Project level 3
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_PROJECT,
            'artifact_status' => 3,
            'max_xp' => 200
        ]);
        $col_levels->push($level_items);
        unset($level_items);

        //level 4
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_PROJECT,
            'artifact_status' => 4,
            'max_xp' => 200
        ]);
        $col_levels->push($level_items);
        unset($level_items);

        //Project level 5
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_PROJECT,
            'artifact_status' => 5,
            'max_xp' => 200
        ]);
        $col_levels->push($level_items);
        unset($level_items);

        $col_levels->each(function ($item, $key) {
            //Levels
            $item['level']->image()->save(new  \App\Models\Image([
                'image' => Intervention::make(resource_path("images/island/level_{$key}/project.png")),
            ]));
            $item['level']->image()->save(new  \App\Models\Image([
                'image' => Intervention::make(resource_path("images/island/level_{$key}/project_icon.png")),
            ]));
            if ($key > 2) {
                $item['level']->image()->save(new  \App\Models\Image([
                    'image' => Intervention::make(resource_path("images/island/level_{$key}/project_anim.png")),
                ]));
            }

            //Messages
            if (key_exists('message',$item) && !is_null($item['message'])) {
                $item['level']->messages()->save($item['message']);
            }
            //Medals
            if (key_exists('medal',$item) && !is_null($item['medal'])) {
                $item['level']->medals()->save($item['medal']);
            }

        });
        unset($col_levels);
        $col_levels=collect();
        /////////////////////////////////////////////////// Club levels goes here
        //Club level 0
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_CLUB,
            'artifact_status' => 0,
            'max_xp' => 200
        ]);
        $col_levels->push($level_items);
        unset($level_items);

        //Club level 1
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_CLUB,
            'artifact_status' => 1,
            'max_xp' => 200
        ]);
        //$level_items['message'] = \App\Models\Message::find(22);
        $level_items['medal'] = \App\Models\Medal::find(2);//Frida Kahlo
        $col_levels->push($level_items);
        unset($level_items);

        //Club level 2
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_CLUB,
            'artifact_status' => 2,
            'max_xp' => 200
        ]);
        //$level_items['message'] = \App\Models\Message::find(30);
        $level_items['medal'] = \App\Models\Medal::find(1);//Charlie Chaplin
        $col_levels->push($level_items);
        unset($level_items);

        //Club level 3
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_CLUB,
            'artifact_status' => 3,
            'max_xp' => 200
        ]);
        $col_levels->push($level_items);
        unset($level_items);

        //Club level 4
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_CLUB,
            'artifact_status' => 4,
            'max_xp' => 200
        ]);
        $col_levels->push($level_items);
        unset($level_items);

        //Club level 5
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_CLUB,
            'artifact_status' => 5,
            'max_xp' => 200
        ]);
        $col_levels->push($level_items);
        unset($level_items);

        $col_levels->each(function ($item, $key) {
            //Levels
            $item['level']->image()->save(new  \App\Models\Image([
                'image' => Intervention::make(resource_path("images/island/level_{$key}/club.png")),
            ]));
            $item['level']->image()->save(new  \App\Models\Image([
                'image' => Intervention::make(resource_path("images/island/level_{$key}/club_icon.png")),
            ]));
            if ($key > 3) {
                $item['level']->image()->save(new  \App\Models\Image([
                    'image' => Intervention::make(resource_path("images/island/level_{$key}/club_anim.png")),
                ]));
            }
            //Messages
            if (key_exists('message',$item) && !is_null($item['message'])) {
                $item['level']->messages()->save($item['message']);
            }
            //Medals
            if (key_exists('medal',$item) && !is_null($item['medal'])) {
                $item['level']->medals()->save($item['medal']);
            }
        });
        unset($col_levels);
        $col_levels=collect();

        /////////////////////////////////////////////////// Task level goes here
        //Task level 0
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_TASK,
            'artifact_status' => 0,
            'max_xp' => 200
        ]);
        $col_levels->push($level_items);
        unset($level_items);

        //Task level 1
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_TASK,
            'artifact_status' => 1,
            'max_xp' => 200
        ]);
        //$level_items['message'] = \App\Models\Message::find(19);
        $level_items['medal'] = \App\Models\Medal::find(3);//Fatih Sultan Mehmet
        $col_levels->push($level_items);
        unset($level_items);

        //Task level 2
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_TASK,
            'artifact_status' => 2,
            'max_xp' => 200
        ]);
        //$level_items['message'] = \App\Models\Message::find(57);
        $level_items['medal'] = \App\Models\Medal::find(7);//Mimar Sinan
        $col_levels->push($level_items);
        unset($level_items);

        //Task level 3
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_TASK,
            'artifact_status' => 3,
            'max_xp' => 200
        ]);
        //$level_items['message'] = \App\Models\Message::find(34);
        $level_items['medal'] = \App\Models\Medal::find(9); //Aziz Sancar
        $col_levels->push($level_items);
        unset($level_items);

        //Task level 4
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_TASK,
            'artifact_status' => 4,
            'max_xp' => 200
        ]);
        //$level_items['message'] = \App\Models\Message::find(28);
        //$level_items['medal'] = \App\Models\Medal::find(9);//Nicola Tesla
        $col_levels->push($level_items);
        unset($level_items);

        //Task level 5
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_TASK,
            'artifact_status' => 5,
            'max_xp' => 200
        ]);
        $col_levels->push($level_items);
        unset($level_items);

        $col_levels->each(function ($item, $key) {
            //Levels
            $item['level']->image()->save(new  \App\Models\Image([
                'image' => Intervention::make(resource_path("images/island/level_{$key}/task.png")),
            ]));
            $item['level']->image()->save(new  \App\Models\Image([
                'image' => Intervention::make(resource_path("images/island/level_{$key}/task_icon.png")),
            ]));
            if ($key > 2) {
                $item['level']->image()->save(new  \App\Models\Image([
                    'image' => Intervention::make(resource_path("images/island/level_{$key}/task_anim.png")),
                ]));
            }
            //Messages
            if (key_exists('message',$item) && !is_null($item['message'])) {
                $item['level']->messages()->save($item['message']);
            }
            //Medals
            if (key_exists('medal',$item) && !is_null($item['medal'])) {
                $item['level']->medals()->save($item['medal']);
            }
        });
        unset($col_levels);
        $col_levels=collect();

        /////////////////////////////////////////// Question Answer levels goes here
        //Question Answer level 0
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_QUESTION_ANSWER,
            'artifact_status' => 0,
            'max_xp' => 200
        ]);
        $col_levels->push($level_items);
        unset($level_items);

        //Question Answer level 1
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_QUESTION_ANSWER,
            'artifact_status' => 1,
            'max_xp' => 200
        ]);
        //$level_items['message'] = \App\Models\Message::find(18);
        $level_items['medal'] = \App\Models\Medal::find(10);//Platon
        $col_levels->push($level_items);
        unset($level_items);

        //Question Answer level 2
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_QUESTION_ANSWER,
            'artifact_status' => 2,
            'max_xp' => 200
        ]);
        //$level_items['message'] = \App\Models\Message::find(31);
        $level_items['medal'] = \App\Models\Medal::find(11);//Virginia Woolf
        $col_levels->push($level_items);
        unset($level_items);

        //Question Answer level 3
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_QUESTION_ANSWER,
            'artifact_status' => 3,
            'max_xp' => 200
        ]);
        //$level_items['message'] = \App\Models\Message::find(32);
        $level_items['medal'] = \App\Models\Medal::find(4);//Hasan Ali Yücel
        $col_levels->push($level_items);
        unset($level_items);

        //Question Answer level 4
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_QUESTION_ANSWER,
            'artifact_status' => 4,
            'max_xp' => 200
        ]);
        //$level_items['message'] = \App\Models\Message::find(39);
        //$level_items['medal'] = \App\Models\Medal::find(4);//???
        $col_levels->push($level_items);
        unset($level_items);

        //Question Answer level 5
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_QUESTION_ANSWER,
            'artifact_status' => 5,
            'max_xp' => 200
        ]);
        $col_levels->push($level_items);
        unset($level_items);

        $col_levels->each(function ($item, $key) {
            //Levels
            $item['level']->image()->save(new  \App\Models\Image([
                'image' => Intervention::make(resource_path("images/island/level_{$key}/qa.png")),
            ]));
            $item['level']->image()->save(new  \App\Models\Image([
                'image' => Intervention::make(resource_path("images/island/level_{$key}/qa_icon.png")),
            ]));
            if ($key > 2) {
                $item['level']->image()->save(new  \App\Models\Image([
                    'image' => Intervention::make(resource_path("images/island/level_{$key}/qa_anim.png")),
                ]));
            }
            //Messages
            if (key_exists('message',$item) && !is_null($item['message'])) {
                $item['level']->messages()->save($item['message']);
            }
            //Medals
            if (key_exists('medal',$item) && !is_null($item['medal'])) {
                $item['level']->medals()->save($item['medal']);
            }
        });
        unset($col_levels);
        $col_levels=collect();

        ////////////////////////////////////////// Square levels goes here
        $level[] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_SQUARE,
            'artifact_status' => 0,
            'max_xp' => 1
        ]);

        $level[] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_SQUARE,
            'artifact_status' => 1,
            'max_xp' => 1
        ]);

        $level[] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_SQUARE,
            'artifact_status' => 2,
            'max_xp' => 1
        ]);

        $level[] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_SQUARE,
            'artifact_status' => 3,
            'max_xp' => 1
        ]);

        $level[] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_SQUARE,
            'artifact_status' => 4,
            'max_xp' => 1
        ]);

        $level[] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_SQUARE,
            'artifact_status' => 5,
            'max_xp' => 1
        ]);

        foreach ($level as $key => $value) {
            $level[$key]->image()->save(new  \App\Models\Image([
                'image' => Intervention::make(resource_path("images/island/level_{$key}/square.png")),
            ]));
        }
        unset($level);

        ////////////////////////////////////////// User general levels goes here
        //general level 0
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_GENERAL,
            'artifact_status' => 0,
            'max_xp' => 200
        ]);
        $col_levels->push($level_items);
        unset($level_items);

        //general level 1
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_GENERAL,
            'artifact_status' => 1,
            'max_xp' => 200
        ]);
        //$level_items['message'] = \App\Models\Message::find(25);
        $level_items['medal'] = \App\Models\Medal::find(12);//Mevlana
        $col_levels->push($level_items);
        unset($level_items);

        //general level 2
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_GENERAL,
            'artifact_status' => 2,
            'max_xp' => 200
        ]);
        //$level_items['message'] = \App\Models\Message::find(58);
        $level_items['medal'] = \App\Models\Medal::find(14);//Yunus Emre
        $col_levels->push($level_items);
        unset($level_items);

        //general level 3
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_GENERAL,
            'artifact_status' => 3,
            'max_xp' => 200
        ]);
        //$level_items['message'] = \App\Models\Message::find(39);
        $level_items['medal'] = \App\Models\Medal::find(8);//Albert Einstein
        $col_levels->push($level_items);
        unset($level_items);

        //general level 4
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_GENERAL,
            'artifact_status' => 4,
            'max_xp' => 200
        ]);
        //$level_items['message'] = \App\Models\Message::find(44);
        $level_items['medal'] = \App\Models\Medal::find(13);//Nazım Hikmet Ran
        $col_levels->push($level_items);
        unset($level_items);

        //general level 5
        $level_items['level'] = \App\Models\Level::create([
            'artifact' => Setting::ARTIFACT_GENERAL,
            'artifact_status' => 5,
            'max_xp' => 200
        ]);
        //$level_items['message'] = \App\Models\Message::find(44);
        //$level_items['medal'] = \App\Models\Medal::find(13);//???
        $col_levels->push($level_items);
        unset($level_items);

        $col_levels->each(function ($item, $key) {

            //Messages
            if (key_exists('message',$item) && !is_null($item['message'])) {
                $item['level']->messages()->save($item['message']);
            }
            //Medals
            if (key_exists('medal',$item) && !is_null($item['medal'])) {
                $item['level']->medals()->save($item['medal']);
            }
        });
    }
}
