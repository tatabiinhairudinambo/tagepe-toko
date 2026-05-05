# Panduan Cepat Deploy ke InfinityFree

## Info Login
- Domain: **tagepe-toko.infinityfree.me**
- cPanel: https://cpanel.infinityfree.com
- Username: `if0_41837903`
- Password: `qQZ3qCP9rTCpg`

---

## Langkah Cepat (10 Menit)

### 1️⃣ ZIP PROJECT (di komputer)
```cmd
cd data-toko
composer install --no-dev --optimize-autoloader
```

Zip semua file KECUALI:
- `node_modules/`
- `.git/`
- `storage/logs/*.log`

### 2️⃣ UPLOAD VIA FTP
- Download FileZilla: https://filezilla-project.org
- Host: `ftpupload.net`
- Username: `if0_41837903`
- Password: `qQZ3qCP9rTCpg`
- Upload zip ke folder `htdocs`

### 3️⃣ EXTRACT DI CPANEL
- Login cPanel
- File Manager → htdocs
- Extract zip file
- Hapus zip file

### 4️⃣ BUAT DATABASE
- cPanel → MySQL Databases
- Create Database: `data_toko`
- Create User: `toko_user` + password
- Add User to Database → ALL PRIVILEGES
- **CATAT**: nama database lengkap, username lengkap, password

### 5️⃣ EDIT .ENV
Di File Manager, edit file `.env`:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tagepe-toko.infinityfree.me

DB_HOST=sql108.infinityfree.com
DB_DATABASE=if0_41837903_data_toko
DB_USERNAME=if0_41837903_toko_user
DB_PASSWORD=[password_kamu]

SESSION_DRIVER=file
CACHE_STORE=file
```

### 6️⃣ SET PERMISSION
Klik kanan folder → Change Permissions → 755:
- `storage/`
- `storage/framework/`
- `storage/logs/`
- `bootstrap/cache/`

### 7️⃣ JALANKAN SCRIPT
Akses via browser (satu per satu):

1. **Buat Symlink**: `https://tagepe-toko.infinityfree.me/create_symlink.php`
2. **Run Migration**: `https://tagepe-toko.infinityfree.me/migrate.php`
3. **Optimize**: `https://tagepe-toko.infinityfree.me/optimize.php`

**HAPUS semua file .php di atas setelah selesai!**

### 8️⃣ TEST WEBSITE
Buka: `https://tagepe-toko.infinityfree.me`

Login:
- Email: `admin@datatoko.com`
- Password: `admin`

---

## Troubleshooting

**Error 500?**
- Cek `.env` sudah benar
- Cek permission folder storage

**Database Error?**
- Cek DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD
- Pastikan user sudah ditambahkan ke database

**CSS Tidak Load?**
- Cek APP_URL di `.env`
- Jalankan `optimize.php` lagi

---

## File Helper yang Sudah Dibuat

✅ `.htaccess` (root) - redirect ke public
✅ `public/create_symlink.php` - buat symlink storage
✅ `public/migrate.php` - run migration & seeder
✅ `public/optimize.php` - optimize Laravel
✅ `public/clear.php` - clear cache (untuk update)
✅ `.env.production` - template .env production

---

**Selamat Deploy! 🚀**
