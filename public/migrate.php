<?php
/**
 * Script untuk menjalankan migration dan seeder
 * Akses via browser setelah upload, lalu HAPUS file ini!
 */

echo "<h2>Running Migrations & Seeders</h2>";
echo "<pre>";

try {
    require __DIR__.'/../vendor/autoload.php';
    $app = require_once __DIR__.'/../bootstrap/app.php';

    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();

    // Run migrations
    echo "=== Running Migrations ===\n";
    Artisan::call('migrate', ['--force' => true]);
    echo Artisan::output();

    // Run seeders
    echo "\n=== Running Seeders ===\n";
    Artisan::call('db:seed', ['--force' => true]);
    echo Artisan::output();

    echo "\n✅ Done!\n";
} catch (Exception $e) {
    echo "\n❌ Error: " . $e->getMessage() . "\n";
    echo "\nStack trace:\n" . $e->getTraceAsString();
}

echo "</pre>";
echo "<hr>";
echo "<p><strong>PENTING:</strong> Hapus file ini setelah selesai!</p>";
?>
