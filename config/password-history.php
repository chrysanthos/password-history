<?php

return [

    'enabled' => env('PASSWORD_HISTORY', true),

    'tables' => [
        'users'            => [
            'name'       => 'users',
            'connection' => null,
        ],
        'password-history' => [
            'name'       => 'password_history',
            'connection' => null,
        ],
    ],

];
