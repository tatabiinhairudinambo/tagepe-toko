<?php
/**
 * Script untuk membuat symlink storage
 * Akses via browser setelah upload, lalu HAPUS file ini!
 */

$target = '../storage/app/public';
$link = 'storage';

echo "<h2>Membuat Symlink Storage</h2>";

if (file_exists($link)) {
    echo "<p style='color:orange'>⚠️ Symlink sudah ada!</p>";
    echo "<p>Path: " . realpath($link) . "</p>";
} else {
    if (symlink($target, $link)) {
        echo "<p style='color:green'>✅ Symlink berhasil dibuat!</p>";
        echo "<p>Target: $target</p>";
        echo "<p>Link: $link</p>";
    } else {
        echo "<p style='color:red'>❌ Gagal membuat symlink!</p>";
        echo "<p>Coba cek permission folder public/</p>";
    }
}

echo "<hr>";
echo "<p><strong>PENTING:</strong> Hapus file ini setelah selesai!</p>";
?>
