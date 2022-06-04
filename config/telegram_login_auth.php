<?php

return [
    'token' => env('TELEGRAM_LOGIN_AUTH_TOKEN', '5252385740:AAHjvtk3NIaM_FRV_Tdv9eUmkL4OxbtqA-0'),
    'validate' => [
        'signature' => env('TELEGRAM_LOGIN_AUTH_VALIDATE_SIGNATURE', true),
        'response_outdated' => env('TELEGRAM_LOGIN_AUTH_VALIDATE_RESPONSE_OUTDATED', true),
    ],
];
