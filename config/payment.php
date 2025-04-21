<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Payment configurations
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials, configurations, and api keys (from .env)
    | for payment services
    |
    */

    'paymongo' => [
        'api_url'        => env('PAYMONGO_PAYMENT_URL', ''),
        'api_public_key' => env('PAYMONGO_PK', ''),
        'api_secret_key' => env('PAYMONGO_SK', ''),
    ]
];
