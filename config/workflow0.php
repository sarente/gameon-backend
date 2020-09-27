<?php
return [
    'straight' => [
        'type' => 'workflow', // or 'state_machine'
        'metadata' => [
            'title' => 'Blog Publishing Workflow',
        ],
        'marking_store' => [
            'type' => 'multiple_state', // or 'single_state'
            'property' => 'current_place' // this is the property on the model
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'draft',
            'review',
            'rejected',
            'published'
        ],
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
