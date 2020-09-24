<?php

return [
    'common' => [
        'error' => 'Error',
        'save-error' => 'Kaydedilemeyen bir hata oluştu',
        'input-error' => 'Veri girişi, bir hata oluştu',
        'not-found' => 'nesne bulunamadı',
        'filter-found' => 'Filtre bulunamadı',
        'bad-request' => '400 Kötü İstek hatası',
        'file-size' => 'Dosya boyutu maksimum sınırı aşıyor',
        'none-valid' => 'Bazı değerler beklenmedik',
    ],
    'auth' => [
        'unauthorised' => 'Yetkiniz yok.',
        'unauthenticated' => 'Yetkilendirilmemişsiniz.',
        'invalid' => 'Geçersiz e-posta adresi veya şifre.',
        'register' => [
            'email-exists' => 'E-posta adresi zaten var.'
        ],
        'social' => [
            'unsupported' => 'Desteklenmeyen sosyal sağlayıcı.',
            'invalid' => 'Desteklenmeyen sosyal sağlayıcı.',
            'missing' => 'Bazı bilgiler eksik',
        ],
        'password' => [
            'invalid' => 'Geçersiz şifre',
        ],
        'forgot' => [
            'invalid' => 'Geçersiz e-posta adresi.',
            'recent' => 'Yakın zamanda bir sıfırlama postası istediniz. Lütfen bekle',
        ],
        'reset' => [
            'invalid' => 'Sıfırlama kodu geçersiz veya süresi doldu.',
        ],
    ],
    'question' => [
        'not-found' => 'Soru bulunamadı.',
    ],
    'answer' => [
        'not-found' => 'Cevap bulunamadı.',
    ],
    'category' => [
        'not-found' => 'Kategori bulunamadı.',
    ],
    'post' => [
        'not-found' => 'Post not found.',
    ],
    'rosette' => [
        'not-found' => 'Rozet bulunamadı.',
        'name-valid' => 'İsim geçerli'
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
