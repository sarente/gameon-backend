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
                'from' => 'a',
                'to'   => 'b',
            ],
            't2' => [
                'from' => 'b',
                'to'   => 'c',
            ],
            't3' => [
                'from' => 'c',
                'to'   => 'd',
            ]
        ],
    ]
];
