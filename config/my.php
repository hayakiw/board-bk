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

    'account' => [
        'created' => [
            'mail_subject' => 'メールアドレスを登録しました。',
        ],
    ],
    'workspace' => [
        'invite' => [
            'mail_subject' => 'ワークスペースに招待されました。',
        ],
    ],

    'reset_password_request' => [
        'expires_in' => 7,
    ],
];
