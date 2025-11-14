<?php
// Simple health check script
echo "Health Check Results:\n";
echo "==================\n";

// PHP Version
echo "PHP Version: " . PHP_VERSION . "\n";

// Check if basic Laravel requirements are met
echo "Extensions:\n";
$required_extensions = ['pdo', 'mbstring', 'openssl', 'tokenizer', 'xml', 'ctype', 'json', 'bcmath'];
foreach ($required_extensions as $ext) {
    echo "  - {$ext}: " . (extension_loaded($ext) ? '✓' : '✗') . "\n";
}

// Check Redis extension
echo "  - redis: " . (extension_loaded('redis') ? '✓' : '✗') . "\n";

// Check if we can write to storage directories
$writable_dirs = [
    '/app/storage/logs',
    '/app/storage/framework/cache',
    '/app/storage/framework/sessions',
    '/app/storage/framework/views',
    '/app/bootstrap/cache'
];

echo "\nWritable Directories:\n";
foreach ($writable_dirs as $dir) {
    echo "  - {$dir}: " . (is_writable($dir) ? '✓' : '✗') . "\n";
}

// Check environment
echo "\nEnvironment:\n";
echo "  - APP_ENV: " . (getenv('APP_ENV') ?: 'not set') . "\n";
echo "  - APP_DEBUG: " . (getenv('APP_DEBUG') ?: 'not set') . "\n";
echo "  - CACHE_DRIVER: " . (getenv('CACHE_DRIVER') ?: 'not set') . "\n";
echo "  - SESSION_DRIVER: " . (getenv('SESSION_DRIVER') ?: 'not set') . "\n";

// Test database connection if available
if (getenv('DB_HOST')) {
    echo "\nDatabase Connection:\n";
    try {
        $pdo = new PDO(
            'mysql:host=' . getenv('DB_HOST') . ';port=' . (getenv('DB_PORT') ?: 3306) . ';dbname=' . getenv('DB_DATABASE'),
            getenv('DB_USERNAME'),
            getenv('DB_PASSWORD')
        );
        echo "  - MySQL: ✓\n";
    } catch (Exception $e) {
        echo "  - MySQL: ✗ " . $e->getMessage() . "\n";
    }
}

echo "\nHealth check completed.\n";
?>