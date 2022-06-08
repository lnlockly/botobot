<?php

return [
    'token' => env('TELEGRAM_LOGIN_AUTH_TOKEN', ''),
    'validate' => [
        'signature' => env('TELEGRAM_LOGIN_AUTH_VALIDATE_SIGNATURE', false),
        'response_outdated' => env('TELEGRAM_LOGIN_AUTH_VALIDATE_RESPONSE_OUTDATED', true),
    ],
];
