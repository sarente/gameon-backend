<?php

return [
    'base_competence' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'Temel Yetkinlikler',
        ],
        'marking_store' => [
            'type' => 'multiple_state',
            'property' => 'current_place'
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show' => ['metadata' => [
                'activity_id' => '2'
            ]
            ],
            'the_blanks'=> ['metadata' => [
                'activity_id' => '3'
            ]
            ],
            'rosette',
            'point',
            'done'
        ],
        'transitions' => [
            'play_slide_show' => [
                'from' => 'slide_show',
                'to' => 'the_blanks',
            ],
            'fill_in_the_blanks' => [
                'from' => 'the_blanks',
                'to' => ['rosette', 'point']
            ],
            'show_rosette' => [
                'from' => 'rosette',
                'to' => ['done', 'point']
            ],
            'return_point' => [
                'from' => 'point',
                'to' => 'done'
            ],
        ],
    ]
];
