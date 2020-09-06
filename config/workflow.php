<?php

return [
    'recruitment' => [
        'type' => 'state_machine',
        'metadata' => [
            'title' => 'Blog Publishing Workflow',
        ],
        'marking_store' => [
            'type' => 'single_state', // or 'state_machine'
            //'property' => 'currentPlace', // this is the property on the model
            //'class' => MethodMarkingStore::class, // you may omit for default, or set to override marking store class
        ],
        'supports' => ['App\Models\Activity'],
        'places' => [
            'gather_cvs' => ['metadata' => [
                'max_num_of_words' => 500,
            ]],
            'send_quiz',
            'select_top_3',
            'offering'
        ], //steps of workflow
        'transitions' => [
            'to_review' => [
                'from' => 'draft',
                'to' => 'review',
                'metadata' => [
                    'priority' => 0.5,
                ]
            ],
            'publish' => [
                'from' => 'review',
                'to' => 'published'
            ],
            'reject' => [
                'from' => 'review',
                'to' => 'rejected'
            ]
        ],
    ]
];
