<?php
return [
    'union_of_forces' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'GÜÇ BİRLİĞİ',
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show' => ['metadata' => [
                'order' => '1',
                'place_name' => 'Slaytları İzle',
                'model_id' => '2',
                'model_type' => 'App\Models\Activity',
            ]
            ],
            'the_blanks' => ['metadata' => [
                'order' => '2',
                'place_name' => 'Kelimeyi Gir',
                'model_id' => '1',
                'model_type' => 'App\Models\ActivityResult',
            ]
            ],
            'done' => ['metadata' => [
                'order' =>'3',
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
                'to' => 'done'
            ]
        ]
    ],
    'bona_fides' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'İYİ NİYET',
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show' => ['metadata' => [
                'order' => '1',
                'place_name' => 'Slaytları İzle',
                'model_id' => '2',
                'model_type' => 'App\Models\Activity',
            ]
            ],
            'the_blanks' => ['metadata' => [
                'order' => '2',
                'place_name' => 'Kelimeyi Gir',
                'model_id' => '2',
                'model_type' => 'App\Models\ActivityResult',
            ]
            ],
            'result' => ['metadata' => [
                'order' => '3',
                'place_name' => 'Sonuclari Gor',
                'model_id' => '1',
                'model_type' => 'App\Models\Reward',
            ]
            ],
            'done' => ['metadata' => [
                'order' =>'3',
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
                'to' => 'done'
            ]
        ]
    ],
    'being_we_centered' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'Biz Merkezli Olmak',
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show' => ['metadata' => [
                'order' => '1',
                'place_name' => 'Slaytları İzle',
                'model_id' => '2',
                'model_type' => 'App\Models\Activity',
            ]
            ],
            'the_blanks' => ['metadata' => [
                'order' => '2',
                'place_name' => 'Kelimeyi Gir',
                'model_id' => '2',
                'model_type' => 'App\Models\ActivityResult',
            ]
            ],
            'result' => ['metadata' => [
                'order' => '3',
                'place_name' => 'Sonuclari Gor',
                'model_id' => '1',
                'model_type' => 'App\Models\Reward',
            ]
            ],
            'done' => ['metadata' => [
                'order' =>'3',
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
                'to' => 'done'
            ]
        ]
    ],
    'staying_in_the_game' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'Oyunda Kalmak',
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show' => ['metadata' => [
                'order' => '1',
                'place_name' => 'Slaytları İzle',
                'model_id' => '2',
                'model_type' => 'App\Models\Activity',
            ]
            ],
            'the_blanks' => ['metadata' => [
                'order' => '2',
                'place_name' => 'Kelimeyi Gir',
                'model_id' => '2',
                'model_type' => 'App\Models\ActivityResult',
            ]
            ],
            'result' => ['metadata' => [
                'order' => '3',
                'place_name' => 'Sonuclari Gor',
                'model_id' => '1',
                'model_type' => 'App\Models\Reward',
            ]
            ],
            'done' => ['metadata' => [
                'order' =>'3',
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
                'to' => 'done'
            ]
        ]
    ],
    'clearance' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'Açıklık',
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show' => ['metadata' => [
                'order' => '1',
                'place_name' => 'Slaytları İzle',
                'model_id' => '2',
                'model_type' => 'App\Models\Activity',
            ]
            ],
            'the_blanks' => ['metadata' => [
                'order' => '2',
                'place_name' => 'Kelimeyi Gir',
                'model_id' => '2',
                'model_type' => 'App\Models\ActivityResult',
            ]
            ],
            'result' => ['metadata' => [
                'order' => '3',
                'place_name' => 'Sonuclari Gor',
                'model_id' => '1',
                'model_type' => 'App\Models\Reward',
            ]
            ],
            'done' => ['metadata' => [
                'order' =>'3',
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
                'to' => 'done'
            ]
        ]
    ],
    //
    'having_an_analytical_perspective' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'Analitik Bakış Açısına Sahip Olmak',
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show' => ['metadata' => [
                'order' => '1',
                'place_name' => 'Slaytları İzle',
                'model_id' => '2',
                'model_type' => 'App\Models\Activity',
            ]
            ],
            'the_blanks' => ['metadata' => [
                'order' => '2',
                'place_name' => 'Kelimeyi Gir',
                'model_id' => '3',
                'model_type' => 'App\Models\ActivityResult',
            ]
            ],
            'result' => ['metadata' => [
                'order' => '3',
                'place_name' => 'Sonuclari Gor',
                'model_id' => '1',
                'model_type' => 'App\Models\Reward',
            ]
            ],
            'done' => ['metadata' => [
                'order' =>'3',
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
                'to' => 'done'
            ]
        ]
    ],
    'being_creative_band_innovative' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'Yaratıcı ve Yenilikçi Olmak',
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show' => ['metadata' => [
                'order' => '1',
                'place_name' => 'Slaytları İzle',
                'model_id' => '2',
                'model_type' => 'App\Models\Activity',
            ]
            ],
            'the_blanks' => ['metadata' => [
                'order' => '2',
                'place_name' => 'Kelimeyi Gir',
                'model_id' => '2',
                'model_type' => 'App\Models\ActivityResult',
            ]
            ],
            'result' => ['metadata' => [
                'order' => '3',
                'place_name' => 'Sonuclari Gor',
                'model_id' => '1',
                'model_type' => 'App\Models\Reward',
            ]
            ],
            'done' => ['metadata' => [
                'order' =>'3',
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
                'to' => 'done'
            ]
        ]
    ],
    'taking_initiative' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'İnisiyatif Almak',
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show' => ['metadata' => [
                'order' => '1',
                'place_name' => 'Slaytları İzle',
                'model_id' => '2',
                'model_type' => 'App\Models\Activity',
            ]
            ],
            'the_blanks' => ['metadata' => [
                'order' => '2',
                'place_name' => 'Kelimeyi Gir',
                'model_id' => '2',
                'model_type' => 'App\Models\ActivityResult',
            ]
            ],
            'result' => ['metadata' => [
                'order' => '3',
                'place_name' => 'Sonuclari Gor',
                'model_id' => '1',
                'model_type' => 'App\Models\Reward',
            ]
            ],
            'done' => ['metadata' => [
                'order' =>'3',
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
                'to' => 'done'
            ]
        ]
    ],
    'agility' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'Çeviklik',
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show' => ['metadata' => [
                'order' => '1',
                'place_name' => 'Slaytları İzle',
                'model_id' => '2',
                'model_type' => 'App\Models\Activity',
            ]
            ],
            'the_blanks' => ['metadata' => [
                'order' => '2',
                'place_name' => 'Kelimeyi Gir',
                'model_id' => '2',
                'model_type' => 'App\Models\ActivityResult',
            ]
            ],
            'result' => ['metadata' => [
                'order' => '3',
                'place_name' => 'Sonuclari Gor',
                'model_id' => '1',
                'model_type' => 'App\Models\Reward',
            ]
            ],
            'done' => ['metadata' => [
                'order' =>'3',
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
                'to' => 'done'
            ]
        ]
    ],
    'communication' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'İletişim',
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show' => ['metadata' => [
                'order' => '1',
                'place_name' => 'Slaytları İzle',
                'model_id' => '2',
                'model_type' => 'App\Models\Activity',
            ]
            ],
            'the_blanks' => ['metadata' => [
                'order' => '2',
                'place_name' => 'Kelimeyi Gir',
                'model_id' => '2',
                'model_type' => 'App\Models\ActivityResult',
            ]
            ],
            'result' => ['metadata' => [
                'order' => '3',
                'place_name' => 'Sonuclari Gor',
                'model_id' => '1',
                'model_type' => 'App\Models\Reward',
            ]
            ],
            'done' => ['metadata' => [
                'order' =>'3',
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
                'to' => 'done'
            ]
        ]
    ]
];
