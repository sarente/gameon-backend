<?php
return [
    'values' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'Değeler',
        ],
        'marking_store' => [
            'type' => 'multiple_state',
            'property' => 'current_place'
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show' => ['metadata' => [
                'model_id' => '1',
                'model_type' => 'App\Models\Activity',

            ]
            ],
            'the_blanks' => ['metadata' => [
                'model_id' => '2',
                'model_type' => 'App\Models\Activity',
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
            ]
        ]
    ],
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
                'model_id' => '1'
            ]
            ],
            'the_blanks' => ['metadata' => [
                'model_id' => '2'
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
            ]
        ]
    ],
    'management_competence' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'Yönetsel Yetkinlikler',
        ],
        'marking_store' => [
            'type' => 'multiple_state',
            'property' => 'current_place'
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show' => ['metadata' => [
                'model_id' => '1'
            ]
            ],
            'the_blanks' => ['metadata' => [
                'model_id' => '2'
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
            ]
        ]
    ],
    'high_level_competence' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'Üst Düzey Yetkinlikler',
        ],
        'marking_store' => [
            'type' => 'multiple_state',
            'property' => 'current_place'
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show' => ['metadata' => [
                'model_id' => '1'
            ]
            ],
            'the_blanks' => ['metadata' => [
                'model_id' => '2'
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
            ]
        ]
    ],
    'entertainment' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'Eğlence',
        ],
        'marking_store' => [
            'type' => 'multiple_state',
            'property' => 'current_place'
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show' => ['metadata' => [
                'model_id' => '1'
            ]
            ],
            'the_blanks' => ['metadata' => [
                'model_id' => '2'
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
        ]
    ]
];
