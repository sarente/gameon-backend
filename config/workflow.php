<?php
return [
    'values' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'Blog Publishing Workflow',
        ],
        'marking_store' => [
            'type' => 'multiple_state',
            'property' => 'currentPlace'
        ],
        'supports' => ['App\Models\UserWorkflow'],
        'places' => [
            'draft',
            'content_review',
            'content_approved',
            'legal_review',
            'legal_approved',
            'published'
        ],
        'transitions' => [
            'to_review' => [
                'from' => 'draft',
                'to' => ['content_review', 'legal_review'],
            ],
            'publish' => [
                'from' => [
                    ['content_review', 'legal_review']
                ],
                'to' => 'published'
            ],
        ],
    ],
    'base_competence' => [
        'type' => 'workflow',
        'metadata' => [
            'title' => 'Blog Publishing Workflow',
        ],
        'marking_store' => [
            'type' => 'multiple_state',
            'property' => 'currentPlace'
        ],
        'supports' => ['App\Models\Activity'],
        'places' => [
            'draft1',
            'content_review1',
            'content_approved1',
            'legal_review1',
            'legal_approved1',
            'published1'
        ],
        'transitions' => [
            'to_review1' => [
                'from' => 'draft1',
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
            'title' => 'Blog Publishing Workflow',
        ],
        'marking_store' => [
            'type' => 'multiple_state',
            'property' => 'currentPlace'
        ],
        'supports' => ['App\Models\Activity'],
        'places' => [
            'draft1',
            'content_review1',
            'content_approved1',
            'legal_review1',
            'legal_approved1',
            'published1'
        ],
        'transitions' => [
            'to_review1' => [
                'from' => 'draft1',
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
            'title' => 'Blog Publishing Workflow',
        ],
        'marking_store' => [
            'type' => 'multiple_state',
            'property' => 'currentPlace'
        ],
        'supports' => ['App\Models\Activity'],
        'places' => [
            'draft1',
            'content_review1',
            'content_approved1',
            'legal_review1',
            'legal_approved1',
            'published1'
        ],
        'transitions' => [
            'to_review1' => [
                'from' => 'draft1',
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
            'title' => 'Blog Publishing Workflow',
        ],
        'marking_store' => [
            'type' => 'multiple_state',
            'property' => 'currentPlace'
        ],
        'supports' => ['App\Models\Activity'],
        'places' => [
            'draft1',
            'content_review1',
            'content_approved1',
            'legal_review1',
            'legal_approved1',
            'published1'
        ],
        'transitions' => [
            'to_review1' => [
                'from' => 'draft1',
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
