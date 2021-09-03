<?php

# "sail artisan model-settings:model-settings-table"
# is not working. migration is created manually.

return [
    'settings_field_name' => env('MODEL_SETTINGS_FIELD_NAME', 'settings'),
    'settings_table_name' => env('MODEL_SETTINGS_TABLE_NAME', 'model_settings'),
    'settings_persistent' => env('MODEL_SETTINGS_PERSISTENT', true),
    'settings_table_use_cache' => env('MODEL_SETTINGS_TABLE_USE_CACHE', true),
    'settings_table_cache_prefix' => env('MODEL_SETTINGS_TABLE_CACHE_PREFIX', 'model_settings:'),
    'defaultSettings' => [
        'sellers' => [
            'store' => [
                'store_logo' => 'https://via.placeholder.com/512',
            ],
            'withdraw' => [
                'method_name' => 'bKash',
                'bank_name' => '',
                'account_name' => '',
                'branch' => '',
                'routing_no' => '',
                'account_type' => 'Personal',
                'account_number' => '01xxxxxxxxx',
            ],
        ],
        'users' => [

        ]
    ]
];
