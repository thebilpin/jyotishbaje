<?php
// Simple test endpoint
header('Content-Type: text/plain');
echo "PHP-FPM Test - " . date('Y-m-d H:i:s') . "\n";
echo "Status: OK\n";
echo "PHP Version: " . PHP_VERSION . "\n";
echo "Server: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Unknown') . "\n";
?>