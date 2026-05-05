<?php
/**
 * Script untuk optimize Laravel untuk production
 * Akses via browser setelah upload, lalu HAPUS file ini!
 */

echo "<h2>Optimizing Laravel</h2>";
echo "<pre>";

try {
    require __DIR__.'/../vendor/autoload.php';
    $app = require_once __DIR__.'/../bootstrap/app.php';

    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();

    echo "=== Config Cache ===\n";
    Artisan::call('config:cache');
    echo Artisan::output();

    echo "\n=== Route Cache ===\n";
    Artisan::call('route:cache');
    echo Artisan::output();

    echo "\n=== View Cache ===\n";
    Artisan::call('view:cache');
    echo Artisan::output();

    echo "\n✅ Optimization complete!\n";
} catch (Exception $e) {
    echo "\n❌ Error: " . $e->getMessage() . "\n";
    echo "\nStack trace:\n" . $e->getTraceAsString();
}

echo "</pre>";
echo "<hr>";
echo "<p><strong>PENTING:</strong> Hapus file ini setelah selesai!</p>";
?>
