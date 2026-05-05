# Panduan Deploy Laravel ke InfinityFree

## Informasi Hosting
- **Domain**: tagepe-toko.infinityfree.me
- **Username**: if0_41837903
- **Password**: qQZ3qCP9rTCpg
- **cPanel**: https://cpanel.infinityfree.com

---

## LANGKAH 1: Persiapan File Laravel

### 1.1 Buat File .htaccess untuk Root
Buat file `.htaccess` di folder `data-toko` dengan isi:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

### 1.2 Buat File .htaccess untuk Public
File ini sudah ada di `public/.htaccess`, pastikan isinya seperti ini:

```apache
<IfModule mod_negotiation.c>
    Options -MultiViews -Indexes
</IfModule>

<IfModule mod_rewrite.c>
    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

---

## LANGKAH 2: Zip File Project

1. Buka Command Prompt di folder `data-toko`
2. Jalankan perintah untuk zip (KECUALI folder yang tidak perlu):

```cmd
tar -czf tagepe-toko.tar.gz --exclude=node_modules --exclude=.git --exclude=vendor --exclude=storage/logs/*.log --exclude=storage/framework/cache --exclude=storage/framework/sessions --exclude=storage/framework/views .
```

**ATAU** gunakan software seperti WinRAR/7-Zip untuk zip manual dengan mengecualikan:
- `node_modules/`
- `.git/`
- `vendor/` (akan diinstall ulang di server)
- `storage/logs/*.log`
- `storage/framework/cache/data/*`
- `storage/framework/sessions/*`
- `storage/framework/views/*`

---

## LANGKAH 3: Upload File via FTP (LEBIH CEPAT)

### 3.1 Download FileZilla Client
- Download dari: https://filezilla-project.org/download.php?type=client
- Install FileZilla

### 3.2 Koneksi FTP ke InfinityFree
Buka FileZilla dan masukkan:
- **Host**: `ftpupload.net` atau `ftp.tagepe-toko.infinityfree.me`
- **Username**: `if0_41837903`
- **Password**: `qQZ3qCP9rTCpg`
- **Port**: 21

Klik **Quickconnect**

### 3.3 Upload File
1. Di panel kiri (Local site), navigasi ke folder `data-toko`
2. Di panel kanan (Remote site), masuk ke folder `htdocs`
3. Upload file `tagepe-toko.tar.gz` ke folder `htdocs`
4. Tunggu sampai upload selesai

---

## LANGKAH 4: Extract File di cPanel

1. Login ke cPanel: https://cpanel.infinityfree.com
2. Buka **File Manager**
3. Masuk ke folder `htdocs`
4. Klik kanan file `tagepe-toko.tar.gz`
5. Pilih **Extract**
6. Tunggu proses extract selesai
7. Hapus file `tagepe-toko.tar.gz` setelah selesai

---

## LANGKAH 5: Install Composer Dependencies

### Via SSH (Jika Tersedia)
```bash
cd htdocs
composer install --no-dev --optimize-autoloader
```

### Via cPanel Terminal (Jika Tersedia)
Sama seperti di atas

### ALTERNATIF: Upload Vendor Manual
Jika tidak ada akses SSH/Terminal:
1. Di komputer lokal, jalankan: `composer install --no-dev`
2. Zip folder `vendor`
3. Upload dan extract di server

---

## LANGKAH 6: Buat Database MySQL

1. Di cPanel, cari **MySQL Databases**
2. Klik **Create New Database**
3. Nama database: `if0_41837903_data_toko` (otomatis ditambah prefix)
4. Klik **Create Database**
5. **Catat nama database lengkap** (contoh: `if0_41837903_data_toko`)

### Buat User Database
1. Scroll ke bawah ke **MySQL Users**
2. Klik **Create New User**
3. Username: `toko_user`
4. Password: buat password kuat (catat!)
5. Klik **Create User**

### Hubungkan User ke Database
1. Scroll ke **Add User To Database**
2. Pilih user yang baru dibuat
3. Pilih database yang baru dibuat
4. Klik **Add**
5. Centang **ALL PRIVILEGES**
6. Klik **Make Changes**

---

## LANGKAH 7: Konfigurasi .env untuk Production

1. Di File Manager, buka file `.env`
2. Edit dengan konfigurasi berikut:

```env
APP_NAME="TAGEPE TOKO"
APP_ENV=production
APP_KEY=base64:0oA5zqVkU0p/BYnUm1l3M3TjvM0r+6FrrXgYwpE5FRQ=
APP_DEBUG=false
APP_URL=https://tagepe-toko.infinityfree.me

DB_CONNECTION=mysql
DB_HOST=sql108.infinityfree.com
DB_PORT=3306
DB_DATABASE=if0_41837903_data_toko
DB_USERNAME=if0_41837903_toko_user
DB_PASSWORD=[password_yang_dibuat_tadi]

SESSION_DRIVER=file
SESSION_LIFETIME=120

CACHE_STORE=file
QUEUE_CONNECTION=sync

LOG_CHANNEL=single
LOG_LEVEL=error
```

**PENTING**: 
- Ganti `DB_HOST` dengan host MySQL dari cPanel (biasanya `sql108.infinityfree.com` atau sejenisnya)
- Ganti `DB_DATABASE` dengan nama database lengkap
- Ganti `DB_USERNAME` dengan username lengkap (dengan prefix)
- Ganti `DB_PASSWORD` dengan password yang dibuat
- Set `APP_DEBUG=false` untuk production
- Set `APP_ENV=production`

---

## LANGKAH 8: Set Permission Folder

Di File Manager, set permission untuk folder berikut (klik kanan > Change Permissions):

- `storage/` → **755**
- `storage/framework/` → **755**
- `storage/framework/cache/` → **755**
- `storage/framework/sessions/` → **755**
- `storage/framework/views/` → **755**
- `storage/logs/` → **755**
- `storage/app/` → **755**
- `storage/app/public/` → **755**
- `bootstrap/cache/` → **755**

---

## LANGKAH 9: Buat Symlink Storage

Karena tidak ada akses `php artisan storage:link`, kita buat symlink manual:

1. Di File Manager, masuk ke folder `public`
2. Klik **+ File** untuk buat file baru
3. Nama file: `create_symlink.php`
4. Isi file:

```php
<?php
$target = '../storage/app/public';
$link = 'storage';

if (file_exists($link)) {
    echo "Symlink sudah ada!";
} else {
    if (symlink($target, $link)) {
        echo "Symlink berhasil dibuat!";
    } else {
        echo "Gagal membuat symlink!";
    }
}
?>
```

5. Akses via browser: `https://tagepe-toko.infinityfree.me/create_symlink.php`
6. Setelah berhasil, **HAPUS file `create_symlink.php`**

---

## LANGKAH 10: Run Migration dan Seeder

Buat file `migrate.php` di folder `public`:

```php
<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Run migrations
echo "Running migrations...\n";
Artisan::call('migrate', ['--force' => true]);
echo Artisan::output();

// Run seeders
echo "\nRunning seeders...\n";
Artisan::call('db:seed', ['--force' => true]);
echo Artisan::output();

echo "\nDone!";
?>
```

Akses via browser: `https://tagepe-toko.infinityfree.me/migrate.php`

**HAPUS file `migrate.php` setelah selesai!**

---

## LANGKAH 11: Optimize untuk Production

Buat file `optimize.php` di folder `public`:

```php
<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Optimizing...\n";

Artisan::call('config:cache');
echo Artisan::output();

Artisan::call('route:cache');
echo Artisan::output();

Artisan::call('view:cache');
echo Artisan::output();

echo "\nOptimization complete!";
?>
```

Akses via browser: `https://tagepe-toko.infinityfree.me/optimize.php`

**HAPUS file `optimize.php` setelah selesai!**

---

## LANGKAH 12: Testing

1. Buka browser: `https://tagepe-toko.infinityfree.me`
2. Seharusnya redirect ke halaman login
3. Login dengan:
   - Email: `admin@datatoko.com`
   - Password: `admin`
4. Test semua fitur:
   - Dashboard
   - Kategori (CRUD)
   - Produk (CRUD dengan upload foto)
   - Data Toko
   - Katalog publik

---

## TROUBLESHOOTING

### Error 500
- Cek file `.env` sudah benar
- Cek permission folder `storage` dan `bootstrap/cache`
- Cek log di `storage/logs/laravel.log`

### Database Connection Error
- Pastikan DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD benar
- Cek user sudah ditambahkan ke database dengan privileges

### CSS/JS Tidak Load
- Pastikan `APP_URL` di `.env` sudah benar
- Jalankan `php artisan config:cache`

### Upload Foto Tidak Berfungsi
- Cek permission folder `storage/app/public`
- Pastikan symlink sudah dibuat
- Gunakan fitur URL input sebagai alternatif

---

## KEAMANAN

**PENTING - Hapus file-file ini setelah deployment:**
- `public/create_symlink.php`
- `public/migrate.php`
- `public/optimize.php`
- `DEPLOYMENT-GUIDE.md` (file ini)

**Set APP_DEBUG=false** di production!

---

## MAINTENANCE

### Update Code
1. Upload file yang diubah via FTP
2. Clear cache: buat file `clear.php` di public:
```php
<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
Artisan::call('cache:clear');
Artisan::call('config:clear');
Artisan::call('route:clear');
Artisan::call('view:clear');
echo "Cache cleared!";
?>
```
3. Akses `clear.php` via browser
4. Hapus `clear.php`

---

Selamat! Website Anda sudah live di: **https://tagepe-toko.infinityfree.me** 🎉
