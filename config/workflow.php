<?php

return [
    'recruitment'   => [
        'type'          => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
        ],
        'supports'      => ['App\Models\Activity'],
        'places'        => ['gather_cvs', 'send_quiz', 'select_top_3', 'offering'],
        'transitions'   => [
            't1' => [
                'from' => 'gather_cvs',
                'to'   => 'send_quiz',
            ],
            't2' => [
                'from' => 'send_quiz',
                'to'   => 'select_top_3',
            ],
            't3' => [
                'from' => 'c',
                'to'   => 'd',
            ]
        ],
    ]
];
