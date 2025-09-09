<?php

return [
    'base_url' => env('NIBSS_BASE_URL', 'https://sandbox.nibss-plc.com/api'),
    'client_id' => env('NIBSS_CLIENT_ID'),
    'client_secret' => env('NIBSS_CLIENT_SECRET'),
    'cert_path' => storage_path('app/nibss/cert.pem'),
    'key_path' => storage_path('app/nibss/private.key'),
];
