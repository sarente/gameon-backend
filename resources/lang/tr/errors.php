<?php

return [
    'common' => [
        'error' => 'Hata',
        'save-error' => 'Kaydetme başarısız. Bir hata oluştu.',
        'input-error' => 'Input verisinde bir hata oluştu.',
        'not-found' => 'Nesne bulunamadı',
        'filter-found' => 'Filtre bulunamadı',
        'bad-request' => 'The 400 Bad Request error',
        'file-size' => 'File size exceeds max limit',
        'none-valid' => 'Bazı değerler yanlıştır',
    ],
    'auth' => [
        'unauthorised' => 'Erişim hakkınız bulunmamaktadır.',
        'unauthenticated' => 'Giriş yapmanız gerekmektedir.',
        'invalid' => 'Geçersiz şifre veya email adresi.',
        'register' => [
            'email-exists' => 'Bu email adresi ile bir kullanıcı bulunuyor.'
        ],
        'social' => [
            'unsupported' => 'Unsupported social provider.',
            'invalid' => 'Invalid oath token',
            'missing' => 'Some information missing',
        ],
        'password' => [
            'invalid' => 'Geçersiz şifre',
        ],
        'forgot' => [
            'invalid' => 'Geçersiz e-mail adresi.',
            'recent' => 'You recently requested a reset mail. Please wait',
        ],
        'reset' => [
            'invalid' => 'Reset code invalid or expired.',
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
        'not-found' => 'Post bulunamadı.',
    ],
    'project' => [
        'not-found' => 'Proje bulunamadı.',
        'name-valid' => 'Bu isme sahip bir proje mevcut!',
        'end' => 'Proje zaten tamamlanmış durumda',
        'classroom-not-valid' => 'Sınıf bulunmamaktadır',
        'member' => [
            'exists' => 'Üye zaten mevcut.',
            'not-found' => 'Üye bulunamadı.'
        ]
    ],
    'club' => [
        'not-found' => 'Kulüp bulunamadı.',
        'name-valid' => 'Bu isme sahip bir kulüp mevcut!',
        'classroom-not-valid' => 'Sınıf bulunmamaktadır',
        'member' => [
            'exists' => 'Üye zaten mevcut.',
            'not-found' => 'Üye bulunamadı.'
        ]
    ],
    'rosette' => [
        'not-found' => 'Rozet bulunamadı.',
        'name-valid' => 'Bu isme sahip bir rozet mevcut!'
    ],
    'step' => [
        'not-found' => 'Adım bulunamadı.',
        'name-valid' => 'Bu isme sahip bir adım mevcut'
    ],
    'user' => [
        'not-found' => 'Kullanıcı bulunamadı.',
        'friend' => [
            'not-found' => 'Arkadaş bulunamadı.',
            'exists' => 'Kullanıcı zaten arkadaşınız.',
        ],
    ],
    'claim' => [
        'exists' => 'İstek mevcut.',
        'not-found' => 'İstek bulunamadı'
    ],
    'advice' => [
        'type-notfound' => 'Tip bulunamadı'
    ],
    'tag' => [
        'label-notfound' => 'Etiket boş geldi'
    ],
    'level' => [
        'notfound' => ':artifact_name level bulunmadı'
    ],
    'task' => [
        'not-found' => 'Görev bulunmadı.',
        'name-valid' => 'Bu isme sahip bir görev mevcut!'
    ],
    'classroom' => [
        'not-found' => 'sınıf bulunmadı.'
    ],
    'medal' => [
        'not-found' => 'Madalyon bulunmadı.'
    ],
    'document' => [
        'not-found' => 'Doküman bulunmadı.',
    ]
];
