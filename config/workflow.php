<?php
return [
    //Değerler kategori
    'wf_01' => [
        'type' => 'workflow', // or 'state_machine'
        'metadata' => [
            'title' => 'Ekip Çalışması',
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
            ],
            'show_result' => ['metadata' => [
                'order' => '3',
                'place_name' => 'Neticeyi Gör',
                'model_id' => '1',
                'model_type' => \App\Models\ActivityResult::class,
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
        ],
    ],
    'wf_02' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'Yenilikçilik',
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show' => ['metadata' => [
                'order' => '1',
                'place_name' => 'Slaytları İzle',
                'model_id' => '3',
                'model_kind' => \App\Models\Setting::ACTIVITY_ACTION,
                'model_type' => \App\Models\Activity::class,
            ]
            ],
            'the_blanks' => ['metadata' => [
                'order' => '2',
                'place_name' => 'Kelimeyi Gir',
                'model_id' => '4',
                'model_kind' => \App\Models\Setting::ACTIVITY_RETURN,
                'model_type' => \App\Models\Activity::class,
            ],
            ],
            'show_result' => ['metadata' => [
                'order' => '3',
                'place_name' => 'Neticeyi Gör',
                'model_id' => '5',
                'model_type' => \App\Models\ActivityResult::class,
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
        ],
    ],
    'wf_03' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'Müşteri Memnuniyeti',
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show' => ['metadata' => [
                'order' => '1',
                'place_name' => 'Slaytları İzle',
                'model_id' => '5',
                'model_kind' => \App\Models\Setting::ACTIVITY_ACTION,
                'model_type' => \App\Models\Activity::class,
            ]
            ],
            'the_blanks' => ['metadata' => [
                'order' => '2',
                'place_name' => 'Kelimeyi Gir',
                'model_id' => '6',
                'model_kind' => \App\Models\Setting::ACTIVITY_RETURN,
                'model_type' => \App\Models\Activity::class,
            ],
            ],
            'show_result' => ['metadata' => [
                'order' => '3',
                'place_name' => 'Neticeyi Gör',
                'model_id' => '5',
                'model_type' => \App\Models\ActivityResult::class,
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
        ],
    ],
    'wf_04' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'Güven',
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show' => ['metadata' => [
                'order' => '1',
                'place_name' => 'Slaytları İzle',
                'model_id' => '7',
                'model_kind' => \App\Models\Setting::ACTIVITY_ACTION,
                'model_type' => \App\Models\Activity::class,
            ]
            ],
            'the_blanks' => ['metadata' => [
                'order' => '2',
                'place_name' => 'Kelimeyi Gir',
                'model_id' => '8',
                'model_kind' => \App\Models\Setting::ACTIVITY_RETURN,
                'model_type' => \App\Models\Activity::class,
            ],
            ],
            'show_result' => ['metadata' => [
                'order' => '3',
                'place_name' => 'Neticeyi Gör',
                'model_id' => '5',
                'model_type' => \App\Models\ActivityResult::class,
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
        ],
    ],
    //Eğitim
    'wf_05' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'Covid-19 Eğitimi',
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show' => ['metadata' => [
                'order' => '1',
                'place_name' => 'Slaytları İzle',
                'model_id' => '9',
                'model_kind' => \App\Models\Setting::ACTIVITY_ACTION,
                'model_type' => \App\Models\Activity::class,
            ]
            ],
            'show_result' => ['metadata' => [
                'order' => '2',
                'place_name' => 'Neticeyi Gör',
                'model_id' => '10',
                'model_type' => \App\Models\ActivityResult::class,
            ]
            ]
        ],
        'transitions' => [
            'play_slide_show' => [
                'from' => 'slide_show',
                'to' => 'show_result',
            ]
        ],
    ],
    'wf_06' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'İş Sağlığı ve Güvenliği Eğitim',
           
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show' => ['metadata' => [
                'order' => '1',
                'place_name' => 'Slaytları İzle',
                'model_id' => '11',
                'model_kind' => \App\Models\Setting::ACTIVITY_ACTION,
                'model_type' => \App\Models\Activity::class,
            ]
            ],
            'show_result' => ['metadata' => [
                'order' => '2',
                'place_name' => 'Neticeyi Gör',
                'model_id' => '12',
                'model_type' => \App\Models\ActivityResult::class,
            ]
            ]
        ],
        'transitions' => [
            'play_slide_show' => [
                'from' => 'slide_show',
                'to' => 'show_result',
            ]
        ],
    ],
];
