<?php

return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'mahasiswa' => [
            'driver' => 'session',
            'provider' => 'mahasiswa', // Sudah benar, tapi harus memastikan provider ini ada
        ],

        'dosen' => [
            'driver' => 'session',
            'provider' => 'dosen',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'mahasiswa' => [ // Nama provider ini sudah sesuai dengan yang direferensikan di guard
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
        'users' => [
            'provider' => 'users',
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
