<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Railway Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration options specific to Railway deployment environment
    |
    */

    'timeout' => [
        'http_client' => env('RAILWAY_HTTP_TIMEOUT', 10),
        'database' => env('RAILWAY_DB_TIMEOUT', 30),
        'external_api' => env('RAILWAY_API_TIMEOUT', 15),
    ],

    'optimization' => [
        'cache_views' => env('RAILWAY_CACHE_VIEWS', true),
        'cache_config' => env('RAILWAY_CACHE_CONFIG', true),
        'cache_routes' => env('RAILWAY_CACHE_ROUTES', true),
    ],

    'database' => [
        'connection_retries' => env('RAILWAY_DB_RETRIES', 3),
        'retry_delay' => env('RAILWAY_DB_RETRY_DELAY', 1),
    ],

    'php' => [
        'max_execution_time' => env('RAILWAY_MAX_EXECUTION_TIME', 300),
        'memory_limit' => env('RAILWAY_MEMORY_LIMIT', '512M'),
        'upload_max_filesize' => env('RAILWAY_UPLOAD_MAX_SIZE', '50M'),
    ],
];