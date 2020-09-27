<?php
return [
    'wf_01' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'GÜÇ BİRLİĞİ',
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show' => ['metadata' => [
                'order' => '1',
                'place_name' => 'Slaytları İzle',
                'model_id' => '1',
                'model_kind' => \App\Models\Setting::ACTIVITY_ACTION,
                'model_type' => \App\Models\Activity::class,
            ]
            ],
            'the_blanks' => ['metadata' => [
                'order' => '2',
                'place_name' => 'Kelimeyi Gir',
                'model_id' => '2',
                'model_kind' => \App\Models\Setting::ACTIVITY_RETURN,
                'model_type' => \App\Models\Activity::class,
            ],
                'show_result' => ['metadata' => [
                    'order' => '3',
                    'place_name' => 'Neticeyi Gör',
                    'model_id' => '1',
                    'model_type' => \App\Models\ActivityResult::class,
                ]
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
                'to' => 'show_result',
            ]
        ]
    ]
];