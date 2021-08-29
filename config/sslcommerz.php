<?php

return [
    'store_id' => env('SSLC_STORE_ID', 'store_id'),
    'store_password' => env('SSLC_STORE_PASSWORD', 'password'),
    'currency' =>  env('CURRENCY', 'BDT'),
    'sandbox_mode' => env('SSLC_SANDBOX_MODE', true)
];
