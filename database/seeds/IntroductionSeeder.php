<?php

use Illuminate\Database\Seeder;

class IntroductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        ///////////////////////////////////////////////////// Order 1
        $intro = \App\Models\Introduction::create([
            'order' => 1,
            'page' => 1,
        ]);
        $message = \App\Models\Message::find(1);
        $intro->messages()->save($message);

        ///////////////////////////////////////////////////// Order 2
        unset($intro);
        $intro = \App\Models\Introduction::create([
            'order' => 2,
            'page' => 1,
        ]);

        $message = \App\Models\Message::find(2);
        $intro->messages()->save($message);

        ///////////////////////////////////////////////////// Order 3
        unset($intro);
        $intro = \App\Models\Introduction::create([
            'order' => 3,
            'page' => 1,
        ]);

        $message = \App\Models\Message::find(3);
        $intro->messages()->save($message);


        ///////////////////////////////////////////////////// Order 4
        unset($intro);
        $intro = \App\Models\Introduction::create([
            'order' => 4,
            'page' => 1,
        ]);

        $message = \App\Models\Message::find(4);
        $intro->messages()->save($message);

        ///////////////////////////////////////////////////// Order 5
        unset($intro);
        $intro =\App\Models\Introduction::create([
            'order' => 5,
            'page' => 1,
        ]);

        $event1 = \App\Models\GameonEvent::find(2);//task-island-mask
        $intro->gameonEvents()->save($event1);

        $message = \App\Models\Message::find(5);
        $intro->messages()->save($message);

        ///////////////////////////////////////////////////// Order 6
        unset($intro);
        $intro = \App\Models\Introduction::create([
            'order' => 6,
            'page' => 2,
        ]);

        $message = \App\Models\Message::find(6);
        $intro->messages()->save($message);

        ///////////////////////////////////////////////////// Order 7
        unset($intro);
        $intro = \App\Models\Introduction::create([
            'order' => 7,
            'page' => 2,
        ]);

        $message = \App\Models\Message::find(50);
        $intro->messages()->save($message);

        ///////////////////////////////////////////////////// Order 8
        unset($intro);
        $intro = \App\Models\Introduction::create([
            'order' => 8,
            'page' => 3,
        ]);

        $message = \App\Models\Message::find(51);
        $intro->messages()->save($message);

        ///////////////////////////////////////////////////// Order 9
        unset($intro);
        $intro = \App\Models\Introduction::create([
            'order' => 9,
            'page' => 1,
        ]);

        $message = \App\Models\Message::find(59);
        $intro->messages()->save($message);

        ///////////////////////////////////////////////////// Order 10
        unset($intro);
        $intro = \App\Models\Introduction::create([
            'order' => 10,
            'page' => 1,
        ]);

        $message = \App\Models\Message::find(7);
        $intro->messages()->save($message);

        ///////////////////////////////////////////////////// Order 11
        unset($intro);
        $intro = \App\Models\Introduction::create([
            'order' => 11,
            'page' => 3,
        ]);

        $message = \App\Models\Message::find(8);
        $intro->messages()->save($message);

        ///////////////////////////////////////////////////// Order 12
        unset($intro);
        $intro = \App\Models\Introduction::create([
            'order' => 12,
            'page' => 1,
        ]);
        $message = \App\Models\Message::find(9);
        $intro->messages()->save($message);

        ///////////////////////////////////////////////////// Order 13
        unset($intro);
        $intro =  \App\Models\Introduction::create([
            'order' => 13,
            'page' => 2,
        ]);

        $message = \App\Models\Message::find(10);
        $intro->messages()->save($message);

        ///////////////////////////////////////////////////// Order 14
        unset($intro);
        $intro =  \App\Models\Introduction::create([
            'order' => 14,
            'page' => 1,
        ]);

        $event1 = \App\Models\GameonEvent::find(7);//question-island-mask
        $intro->gameonEvents()->save($event1);

        $message = \App\Models\Message::find(11);
        $intro->messages()->save($message);

        ///////////////////////////////////////////////////// Order 15
        unset($intro);
        $intro =  \App\Models\Introduction::create([
            'order' => 15,
            'page' => 1,
        ]);

        $message = \App\Models\Message::find(13);
        $intro->messages()->save($message);

        ///////////////////////////////////////////////////// Order 16
        unset($intro);
        $intro =  \App\Models\Introduction::create([
            'order' => 16,
            'page' => 1,
        ]);

        $message = \App\Models\Message::find(14);
        $intro->messages()->save($message);

        ///////////////////////////////////////////////////// Order 17
        unset($intro);
        $intro = \App\Models\Introduction::create([
            'order' => 17,
            'page' => 1,
        ]);

        $event1 = \App\Models\GameonEvent::find(14);
        $intro->gameonEvents()->save($event1);

        $message = \App\Models\Message::find(16);
        $intro->messages()->save($message);

        ///////////////////////////////////////////////////// Order 18
        unset($intro);
        $intro = \App\Models\Introduction::create([
            'order' => 18,
            'page' => 1,
        ]);

        $event1 = \App\Models\GameonEvent::find(13);
        $intro->gameonEvents()->save($event1);

        $message = \App\Models\Message::find(17);
        $intro->messages()->save($message);

        ///////////////////////////////////////////////////// Order 19
        unset($intro);
        $intro = \App\Models\Introduction::create([
            'order' => 19,
            'page' => 1,
        ]);

        $event1 = \App\Models\GameonEvent::find(18);//billboard-island-unlock
        $intro->gameonEvents()->save($event1);

        $message = \App\Models\Message::find(52);
        $intro->messages()->save($message);

        ///////////////////////////////////////////////////// Order 20
        unset($intro);
        $intro = \App\Models\Introduction::create([
            'order' => 20,
            'page' => 1,
        ]);

        $event1 = \App\Models\GameonEvent::find(19);//square-island-unlock
        $intro->gameonEvents()->save($event1);

        $message = \App\Models\Message::find(53);
        $intro->messages()->save($message);

        ///////////////////////////////////////////////////// Order 21
        unset($intro);
        $intro = \App\Models\Introduction::create([
            'order' => 21,
            'page' => 1,
        ]);

        $event1 = \App\Models\GameonEvent::find(20);//level-up
        $intro->gameonEvents()->save($event1);

        $message = \App\Models\Message::find(54);
        $intro->messages()->save($message);

    }
}
