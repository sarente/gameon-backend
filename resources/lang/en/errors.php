<?php

return [
    'common' => [
        'error' => 'Error',
        'save-error' => 'Unable to save an error occurred',
        'input-error' => 'Input data an error occurred',
        'not-found' => 'Object not found',
        'filter-found' => 'Filter not found',
        'bad-request' => 'The 400 Bad Request error',
        'file-size' => 'File size exceeds max limit',
        'none-valid' => 'Some values is unexpected',
    ],
    'auth' => [
        'unauthorised' => 'You are unauthorised.',
        'unauthenticated' => 'You are unauthenticated.',
        'invalid' => 'Invalid e-mail address or password.',
        'register' => [
            'email-exists' => 'Email address already exists.'
        ],
        'social' => [
            'unsupported' => 'Unsupported social provider.',
            'invalid' => 'Invalid oath token',
            'missing' => 'Some information missing',
        ],
        'password' => [
            'invalid' => 'Invalid password',
        ],
        'forgot' => [
            'invalid' => 'Invalid e-mail address.',
            'recent' => 'You recently requested a reset mail. Please wait',
        ],
        'reset' => [
            'invalid' => 'Reset code invalid or expired.',
        ],
    ],
    'question' => [
        'not-found' => 'Question not found.',
    ],
    'answer' => [
        'not-found' => 'Answer not found.',
    ],
    'category' => [
        'not-found' => 'Category not found.',
    ],
    'post' => [
        'not-found' => 'Post not found.',
    ],
    'rosette' => [
        'not-found' => 'Rosette not found.',
        'name-valid' => 'Name is valid'
    ],
    'user' => [
        'not-found' => 'User not found',
        'workflow-not-fount' => 'User Dosen\'t have workflow',
        'friend' => [
            'not-found' => 'Friend not found',
            'exists' => 'Friend already exists.',
        ],
    ],
    'claim' => [
        'exists' => 'Claim already exists.',
        'not-found' => 'Claim not found'
    ],
    'tag' => [
        'label-notfound' => 'label is null'
    ],
    'level' => [
        'notfound' => 'level notfound in :artifact_name'
    ],
    'workflow' => [
        'not-found' => 'WorkFlow not found.',
        'place-not-allowed' => 'Workflow place not found',
        'transition-not-allowed' => 'Workflow transition not found',
        'wrong-answer' => 'Wrong Answer is detected, Try in again',
        'gain-before' => 'Gain before from this activity',
        'name-valid' => 'Name is valid'
    ],
    'classroom' => [
        'not-found' => 'Classroom not found.'
    ],
    'medal' => [
        'not-found' => 'Medal not found.'
    ],
    'email' => [
        'not-sent' => 'Email not sent yet.'
    ],
    'activity' => [
        'result' => [
             'wrong-answer'=>'Returned result is wrong'
        ],
        'not-found'=>'Activity not found',
    ],
    'document' => [
        'not-found' => 'Document not found.',
        'name-valid' => 'Name is valid'
    ]

];
