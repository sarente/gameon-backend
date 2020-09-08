<?php
return [
    'straight' => [
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
// ... transitions to "approved" states here
            'publish' => [
                'from' => [ // note array in array
                    ['content_review', 'legal_review']
                ],
                'to' => 'published'
            ],
// ...
        ],
    ]
];
