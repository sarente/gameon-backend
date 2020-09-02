<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Public Key
    |--------------------------------------------------------------------------
    |
    | A path or resource to your public keys.
    |
    | E.g. 'file://path/to/public/keys'
    |
    */

    'public' => 'file://' . base_path(env('JWT_PUBLIC_KEY')),

    /*
    |--------------------------------------------------------------------------
    | Private Key
    |--------------------------------------------------------------------------
    |
    | A path or resource to your private keys.
    |
    | E.g. 'file://path/to/private/keys'
    |
    */

    'private' => 'file://' . base_path(env('JWT_PRIVATE_KEY')),

    /*
    |--------------------------------------------------------------------------
    | Passphrase
    |--------------------------------------------------------------------------
    |
    | The passphrase for your private keys. Can be null if none set.
    |
    */

    'passphrase' => env('JWT_PASSPHRASE'),

    'ttl' => env('JWT_TTL'),

];
