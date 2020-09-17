<?php
return [
    'values' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'Değeler',
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show' => ['metadata' => [
                'order' => '1',
                'model_id' => '1',
                'model_type' => 'App\Models\Activity',
            ]
            ],
            'the_blanks' => ['metadata' => [
                'order' => '2',
                'model_id' => '2',
                'model_type' => 'App\Models\Activity',
            ]
            ],
            'result' => ['metadata' => [
                'order' => '3',
                'model_id' => '3',
                'model_type' => 'App\Models\Reward',
            ]
            ],
            'done' => ['metadata' => [
                'order' => '4',
            ]
            ]
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
    'base_competence' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'Temel Yetkinlikler',
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show' => ['metadata' => [
                'order' => '1',
                'model_id' => '1',
                'model_type' => 'App\Models\Activity',
            ]
            ],
            'the_blanks' => ['metadata' => [
                'order' => '2',
                'model_id' => '2',
                'model_type' => 'App\Models\Activity',
            ]
            ],
            'result' => ['metadata' => [
                'order' => '3',
                'model_id' => '3',
                'model_type' => 'App\Models\Reward',
            ]
            ],
            'done' => ['metadata' => [
                'order' => '4',
            ]
            ]
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
    'management_competence' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'Yönetsel Yetkinlikler',
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show' => ['metadata' => [
                'order' => '1',
                'model_id' => '1',
                'model_type' => 'App\Models\Activity',
            ]
            ],
            'the_blanks' => ['metadata' => [
                'order' => '2',
                'model_id' => '2',
                'model_type' => 'App\Models\Activity',
            ]
            ],
            'result' => ['metadata' => [
                'order' => '3',
                'model_id' => '3',
                'model_type' => 'App\Models\Reward',
            ]
            ],
            'done' => ['metadata' => [
                'order' => '4',
            ]
            ]
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
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show' => ['metadata' => [
                'order' => '1',
                'model_id' => '1',
                'model_type' => 'App\Models\Activity',
            ]
            ],
            'the_blanks' => ['metadata' => [
                'order' => '2',
                'model_id' => '2',
                'model_type' => 'App\Models\Activity',
            ]
            ],
            'result' => ['metadata' => [
                'order' => '3',
                'model_id' => '3',
                'model_type' => 'App\Models\Reward',
            ]
            ],
            'done' => ['metadata' => [
                'order' => '4',
            ]
            ]
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
    'entertainment' => [
            'type' => 'workflow',
            'metadata' => [
                'title' => 'Eğlence',
            ],
            'supports' => ['App\Models\UserWorkflow'],
            'places' => [
                'slide_show' => ['metadata' => [
                    'order' => '1',
                    'model_id' => '1',
                    'model_type' => 'App\Models\Activity',
                ]
                ],
                'the_blanks' => ['metadata' => [
                    'order' => '2',
                    'model_id' => '2',
                    'model_type' => 'App\Models\Activity',
                ]
                ],
                'result' => ['metadata' => [
                    'order' => '3',
                    'model_id' => '3',
                    'model_type' => 'App\Models\Reward',
                ]
                ],
                'done' => ['metadata' => [
                    'order' => '4',
                ]
                ]
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
            ]
];
