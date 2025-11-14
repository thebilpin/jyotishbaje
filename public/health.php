<?php

// Simple health check for Railway deployment
header('Content-Type: application/json');

try {
    // Check if Laravel is working
    require_once __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    
    $response = [
        'status' => 'ok',
        'timestamp' => date('c'),
        'environment' => env('APP_ENV', 'unknown'),
        'version' => app()->version(),
    ];
    
    // Test database connection if configured
    if (env('DB_HOST') || env('DATABASE_URL')) {
        try {
            DB::connection()->getPdo();
            $response['database'] = 'connected';
        } catch (Exception $e) {
            $response['database'] = 'error: ' . $e->getMessage();
        }
    } else {
        $response['database'] = 'not_configured';
    }
    
    // Test Redis connection if configured
    if (env('REDIS_URL') || env('REDIS_HOST')) {
        try {
            Redis::ping();
            $response['redis'] = 'connected';
        } catch (Exception $e) {
            $response['redis'] = 'error: ' . $e->getMessage();
        }
    } else {
        $response['redis'] = 'not_configured';
    }
    
    http_response_code(200);
    echo json_encode($response, JSON_PRETTY_PRINT);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage(),
        'timestamp' => date('c')
    ], JSON_PRETTY_PRINT);
}