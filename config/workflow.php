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
                'activity_id' => '1'
                    ]
            ],
            'the_blanks'=> ['metadata' => [
                'activity_id' => '2'
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
    ],
    'base_competence' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'Temel Yetkinlikler',
        ],
        'marking_store' => [
            'type' => 'multiple_state',
            'property' => 'currentPlace'
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show1',
            'content_review1',
            'content_approved1',
            'legal_review1',
            'legal_approved1',
            'published1'
        ],
        'transitions' => [
            'to_review1' => [
                'from' => 'slide_show1',
                'to' => ['content_review1', 'legal_review1'],
            ],
            'publish1' => [
                'from' => [ // note array in array
                    ['content_review1', 'legal_review1']
                ],
                'to' => 'published1'
            ],
        ],
    ],
    'management_competence' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'Yönetsel Yetkinlikler',
        ],
        'marking_store' => [
            'type' => 'multiple_state',
            'property' => 'currentPlace'
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show1',
            'content_review1',
            'content_approved1',
            'legal_review1',
            'legal_approved1',
            'published1'
        ],
        'transitions' => [
            'to_review1' => [
                'from' => 'slide_show1',
                'to' => ['content_review1', 'legal_review1'],
            ],
            'publish1' => [
                'from' => [ // note array in array
                    ['content_review1', 'legal_review1']
                ],
                'to' => 'published1'
            ],
        ],
    ],
    'high_level_competence' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'Üst Düzey Yetkinlikler',
        ],
        'marking_store' => [
            'type' => 'multiple_state',
            'property' => 'currentPlace'
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show1',
            'content_review1',
            'content_approved1',
            'legal_review1',
            'legal_approved1',
            'published1'
        ],
        'transitions' => [
            'to_review1' => [
                'from' => 'slide_show1',
                'to' => ['content_review1', 'legal_review1'],
            ],
            'publish1' => [
                'from' => [ // note array in array
                    ['content_review1', 'legal_review1']
                ],
                'to' => 'published1'
            ],
        ],
    ],
    'entertainment' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'Eğlence',
        ],
        'marking_store' => [
            'type' => 'multiple_state',
            'property' => 'currentPlace'
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'slide_show1',
            'content_review1',
            'content_approved1',
            'legal_review1',
            'legal_approved1',
            'published1'
        ],
        'transitions' => [
            'to_review1' => [
                'from' => 'slide_show1',
                'to' => ['content_review1', 'legal_review1'],
            ],
            'publish1' => [
                'from' => [ // note array in array
                    ['content_review1', 'legal_review1']
                ],
                'to' => 'published1'
            ],
        ],
    ]
];
