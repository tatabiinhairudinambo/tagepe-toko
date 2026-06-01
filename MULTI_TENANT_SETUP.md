# 🏪 Multi-Tenant Setup Guide

## Konsep Pemisahan Data Per Toko

Sistem ini mendukung **2 mode deployment**:

### Mode 1: Single Tenant (Default - Saat Ini)
- **1 Database = 1 Toko**
- Setiap toko install aplikasi di server/hosting sendiri
- Paling aman dan sederhana
- Cocok untuk: Toko yang ingin full control

```
Toko A: toko-amba.com
├── Database: db_amba
├── Files: /var/www/amba
└── Data: Produk A, Transaksi A, User A

Toko B: toko-sejahtera.com
├── Database: db_sejahtera
├── Files: /var/www/sejahtera
└── Data: Produk B, Transaksi B, User B
```

### Mode 2: Multi-Tenant (Opsional - Untuk SaaS)
- **1 Database = Banyak Toko**
- Semua toko dalam 1 aplikasi, dipisahkan by domain
- Lebih kompleks tapi efisien untuk banyak toko
- Cocok untuk: Platform SaaS dengan banyak tenant

```
Platform: tokoapp.com
├── Database: db_platform (shared)
├── Files: /var/www/platform (shared)
└── Tenants:
    ├── amba.tokoapp.com → Toko A (domain: amba.tokoapp.com)
    ├── sejahtera.tokoapp.com → Toko B (domain: sejahtera.tokoapp.com)
    └── makmur.tokoapp.com → Toko C (domain: makmur.tokoapp.com)
```

---

## 🔧 Setup Mode 1: Single Tenant (Recommended)

### Langkah Deploy untuk Setiap Toko:

#### 1. **Toko A - Setup**
```bash
# Clone repository
git clone https://github.com/your-repo/tagepe-toko.git toko-amba
cd toko-amba

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure database untuk Toko A
# Edit .env:
DB_DATABASE=db_amba
DB_USERNAME=user_amba
DB_PASSWORD=password_amba

# Run migrations
php artisan migrate --seed

# Build assets
npm run build
```

#### 2. **Toko B - Setup** (Ulangi untuk toko lain)
```bash
# Clone repository lagi
git clone https://github.com/your-repo/tagepe-toko.git toko-sejahtera
cd toko-sejahtera

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure database untuk Toko B
# Edit .env:
DB_DATABASE=db_sejahtera
DB_USERNAME=user_sejahtera
DB_PASSWORD=password_sejahtera

# Run migrations
php artisan migrate --seed

# Build assets
npm run build
```

### Keamanan Data:
- ✅ **Database terpisah** - Toko A tidak bisa akses database Toko B
- ✅ **Files terpisah** - Setiap toko punya folder sendiri
- ✅ **Login terpisah** - Admin Toko A tidak bisa login ke Toko B
- ✅ **100% Isolated** - Tidak ada cara data bisa tercampur

---

## 🚀 Setup Mode 2: Multi-Tenant (Advanced)

### Langkah Setup:

#### 1. **Run Migration**
```bash
php artisan migrate
```

Migration akan menambahkan kolom:
- `domain` - Domain/subdomain toko (contoh: amba.tokoapp.com)
- `database_name` - Nama database (opsional, untuk future use)

#### 2. **Register Middleware**

Edit `bootstrap/app.php`:
```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->web(append: [
        \App\Http\Middleware\IdentifyTenant::class,
    ]);
})
```

#### 3. **Update Controllers**

Ganti semua `Toko::first()` dengan `TenantHelper::getCurrentToko()`:

**Sebelum:**
```php
$toko = \App\Models\Toko::first();
```

**Sesudah:**
```php
use App\Helpers\TenantHelper;

$toko = TenantHelper::getCurrentToko();
```

#### 4. **Setup Subdomain di Server**

**Apache (.htaccess):**
```apache
<VirtualHost *:80>
    ServerName tokoapp.com
    ServerAlias *.tokoapp.com
    DocumentRoot /var/www/platform/public
    
    <Directory /var/www/platform/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

**Nginx:**
```nginx
server {
    listen 80;
    server_name tokoapp.com *.tokoapp.com;
    root /var/www/platform/public;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
    }
}
```

#### 5. **Tambah Data Toko**

```php
// Via Tinker
php artisan tinker

// Toko A
Toko::create([
    'nama_toko' => 'Amba Fashion Store',
    'alamat' => 'Jl. Sudirman No. 123',
    'telepon' => '081234567890',
    'email' => 'info@amba.com',
    'domain' => 'amba.tokoapp.com',
]);

// Toko B
Toko::create([
    'nama_toko' => 'Sejahtera Mart',
    'alamat' => 'Jl. Thamrin No. 456',
    'telepon' => '081234567891',
    'email' => 'info@sejahtera.com',
    'domain' => 'sejahtera.tokoapp.com',
]);
```

#### 6. **Cara Kerja:**

```
User akses: amba.tokoapp.com
    ↓
Middleware IdentifyTenant mendeteksi domain
    ↓
TenantHelper::getCurrentToko() cari toko by domain
    ↓
Return data Toko A
    ↓
Tampilkan produk, transaksi, dll dari Toko A saja
```

---

## 🔒 Keamanan Multi-Tenant

### Data Isolation:
```php
// SALAH - Bisa ambil data toko lain
$produks = Produk::all();

// BENAR - Hanya produk toko sendiri
$toko = TenantHelper::getCurrentToko();
$produks = Produk::where('toko_id', $toko->id)->get();
```

### Tambahkan `toko_id` ke Semua Tabel:

**Migration:**
```php
Schema::table('produks', function (Blueprint $table) {
    $table->foreignId('toko_id')->constrained('toko')->onDelete('cascade');
});
```

**Model:**
```php
class Produk extends Model
{
    protected static function booted()
    {
        // Auto-assign toko_id saat create
        static::creating(function ($produk) {
            $produk->toko_id = TenantHelper::getCurrentToko()->id;
        });
        
        // Auto-filter by toko_id saat query
        static::addGlobalScope('toko', function ($query) {
            $query->where('toko_id', TenantHelper::getCurrentToko()->id);
        });
    }
}
```

---

## 📊 Perbandingan Mode

| Fitur | Single Tenant | Multi-Tenant |
|-------|--------------|--------------|
| **Keamanan** | ⭐⭐⭐⭐⭐ Sangat Aman | ⭐⭐⭐⭐ Aman (jika diimplementasi benar) |
| **Kompleksitas** | ⭐ Sangat Mudah | ⭐⭐⭐⭐ Kompleks |
| **Biaya Server** | ⭐⭐ Lebih mahal (1 server per toko) | ⭐⭐⭐⭐⭐ Murah (1 server untuk semua) |
| **Maintenance** | ⭐⭐⭐ Harus update semua instance | ⭐⭐⭐⭐⭐ Update sekali untuk semua |
| **Skalabilitas** | ⭐⭐⭐ Terbatas | ⭐⭐⭐⭐⭐ Sangat scalable |
| **Isolasi Data** | ⭐⭐⭐⭐⭐ 100% Terpisah | ⭐⭐⭐⭐ Terpisah by logic |

---

## 🎯 Rekomendasi

### Gunakan **Single Tenant** jika:
- ✅ Jumlah toko < 10
- ✅ Setiap toko ingin full control
- ✅ Budget server cukup
- ✅ Prioritas keamanan maksimal
- ✅ Tidak ada tim developer dedicated

### Gunakan **Multi-Tenant** jika:
- ✅ Jumlah toko > 50
- ✅ Model bisnis SaaS
- ✅ Ada tim developer untuk maintain
- ✅ Ingin efisiensi biaya server
- ✅ Perlu centralized management

---

## 📝 Kesimpulan

**Sistem saat ini sudah AMAN untuk Single Tenant!**

Setiap toko yang install aplikasi ini akan memiliki:
- ✅ Database sendiri
- ✅ Data terpisah 100%
- ✅ Tidak ada cara data bisa tercampur
- ✅ Login admin terpisah
- ✅ Tampilan web sendiri

**Tidak perlu khawatir data tercampur!** 🔒

Jika ingin upgrade ke Multi-Tenant di masa depan, ikuti langkah-langkah di atas.
