<?php
/**
 * Script untuk clear cache Laravel
 * Gunakan saat update code
 * HAPUS file ini setelah selesai!
 */

echo "<h2>Clearing Cache</h2>";
echo "<pre>";

try {
    require __DIR__.'/../vendor/autoload.php';
    $app = require_once __DIR__.'/../bootstrap/app.php';

    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();

    echo "=== Cache Clear ===\n";
    Artisan::call('cache:clear');
    echo Artisan::output();

    echo "\n=== Config Clear ===\n";
    Artisan::call('config:clear');
    echo Artisan::output();

    echo "\n=== Route Clear ===\n";
    Artisan::call('route:clear');
    echo Artisan::output();

    echo "\n=== View Clear ===\n";
    Artisan::call('view:clear');
    echo Artisan::output();

    echo "\n✅ Cache cleared!\n";
} catch (Exception $e) {
    echo "\n❌ Error: " . $e->getMessage() . "\n";
    echo "\nStack trace:\n" . $e->getTraceAsString();
}

echo "</pre>";
echo "<hr>";
echo "<p><strong>PENTING:</strong> Hapus file ini setelah selesai!</p>";
?>
