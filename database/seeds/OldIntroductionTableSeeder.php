<?php

use App\Models\Introduction;
use Faker\Factory;
use Illuminate\Database\Seeder;

class OldIntroductionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $factory = Factory::create();

        //Message
        $i = 1;
        while ($i < 20) {
            \App\Models\Message::create([
                'message:' . app()->getLocale() => $factory->text,
                'message_type' => 0,
            ]);
            $i++;
        }

        //Event
        unset($i);
        $i = 1;
        while ($i < 20) {
            $gevent = new \App\Models\GameonEvent([
                'name' => $factory->colorName,
            ]);
            $gevent->save();

            $message = \App\Models\Message::find($i);
            $gevent->messages()->save($message);

            $i++;
        }

        //Intro
        unset($i);
        $i = 1;
        while ($i < 20) {
            unset($gevent);
            unset($message);
            unset($intro);

            $intro = new App\Models\Introduction([
                'order' => $i,
                'page'
            ]);
            //set parent
            $p_id = $i - 1;
            $parent_model = Introduction::find($p_id);
            if ($parent_model) {

                $intro->introduction()->associate($parent_model);
            }
            $intro->save();

            $gevent = \App\Models\GameonEvent::find($i ?? 1);
            $intro->gameonEvents()->save($gevent);

            $message = \App\Models\Message::find($i);
            $intro->messages()->save($message);

            $i++;
        }
    }
}
