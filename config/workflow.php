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
            'result' => ['metadata' => [
                'model_id' => '3',
                'model_type' => 'App\Models\Reward',
            ]
            ],
            'done'
        ],
        'transitions' => [
            'play_slide_show' => [
                'from' => 'slide_show',
                'to' => 'the_blanks',
            ],
            'fill_in_the_blanks' => [
                'from' => 'the_blanks',
                'to' => ['result','slide_show']
            ],
            'show_result' => [
                'from' => 'result',
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
                'model_id' => '1',
                'model_type' => 'App\Models\Activity',
            ]
            ],
            'the_blanks' => ['metadata' => [
                'model_id' => '2',
                'model_type' => 'App\Models\Activity',
            ]
            ],
            'result' => ['metadata' => [
                'model_id' => '3',
                'model_type' => 'App\Models\Reward',
            ]
            ],
            'done'
        ],
        'transitions' => [
            'play_slide_show' => [
                'from' => 'slide_show',
                'to' => 'the_blanks',
            ],
            'fill_in_the_blanks' => [
                'from' => 'the_blanks',
                'to' => ['result','slide_show']
            ],
            'show_result' => [
                'from' => 'result',
                'to' => 'done'
            ]
        ]
    ],
    'management_competence' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'Yönetsel Yetkinlikler',
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
            'result' => ['metadata' => [
                'model_id' => '3',
                'model_type' => 'App\Models\Reward',
            ]
            ],
            'done'
        ],
        'transitions' => [
            'play_slide_show' => [
                'from' => 'slide_show',
                'to' => 'the_blanks',
            ],
            'fill_in_the_blanks' => [
                'from' => 'the_blanks',
                'to' => 'result'
            ],
            'show_result' => [
                'from' => 'result',
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
                'model_id' => '1',
                'model_type' => 'App\Models\Activity',
            ]
            ],
            'the_blanks' => ['metadata' => [
                'model_id' => '2',
                'model_type' => 'App\Models\Activity',
            ]
            ],
            'result' => ['metadata' => [
                'model_id' => '3',
                'model_type' => 'App\Models\Reward',
            ]
            ],
            'done'
        ],
        'transitions' => [
            'play_slide_show' => [
                'from' => 'slide_show',
                'to' => 'the_blanks',
            ],
            'fill_in_the_blanks' => [
                'from' => 'the_blanks',
                'to' => ['result','slide_show']
            ],
            'show_result' => [
                'from' => 'result',
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
                'model_id' => '1',
                'model_type' => 'App\Models\Activity',
            ]
            ],
            'the_blanks' => ['metadata' => [
                'model_id' => '2',
                'model_type' => 'App\Models\Activity',
            ]
            ],
            'result' => ['metadata' => [
                'model_id' => '3',
                'model_type' => 'App\Models\Reward',
            ]
            ],
            'done'
        ],
        'transitions' => [
            'play_slide_show' => [
                'from' => 'slide_show',
                'to' => 'the_blanks',
            ],
            'fill_in_the_blanks' => [
                'from' => 'the_blanks',
                'to' => ['result','slide_show']
            ],
            'show_result' => [
                'from' => 'result',
                'to' => 'done'
            ]
        ]
    ]
];
