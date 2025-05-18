<?php

return [

    /*
    |----------------------------------------------------------------------
    | Authentication Defaults
    |----------------------------------------------------------------------
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'user',
    ],

    /*
    |----------------------------------------------------------------------
    | Authentication Guards
    |----------------------------------------------------------------------
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'user',
        ],

        'mahasiswa' => [
            'driver' => 'session',
            'provider' => 'mahasiswa',
        ],

        'dosen' => [
            'driver' => 'session',
            'provider' => 'dosen',
        ],
    ],

    /*
    |----------------------------------------------------------------------
    | User Providers
    |----------------------------------------------------------------------
    */

    'providers' => [
        'user' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'mahasiswa' => [
            'driver' => 'eloquent',
            'model' => App\Models\Mahasiswa::class,
        ],

        'dosen' => [
            'driver' => 'eloquent',
            'model' => App\Models\Dosen::class,
        ],
    ],

    /*
    |----------------------------------------------------------------------
    | Resetting Passwords
    |----------------------------------------------------------------------
    */

    'passwords' => [
        'user' => [
            'provider' => 'user',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |----------------------------------------------------------------------
    | Password Confirmation Timeout
    |----------------------------------------------------------------------
    */

    'password_timeout' => 10800,

];
