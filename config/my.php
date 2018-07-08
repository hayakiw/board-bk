<?php

return [
    'site_title' => env(
        'SYSTEM_TITLE',
        'board'
    ),

    'mail' => [
        'from' => env(
            'MAIL_FROM',
            'info@example.com'
        ),
        'name' => env(
            'MAIL_NAME',
            'info'
        ),
    ],

    'user' => [
        'created' => [
            'mail_subject' => 'メールアドレスを登録しました。',
        ],
    ],

    'reset_password_request' => [
        'expires_in' => 7,
    ],
];
