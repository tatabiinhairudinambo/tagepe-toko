# 📁 Struktur Frontend - Tagepe Toko

## 🎯 Konsep Pemisahan

Sistem ini memiliki **2 jenis frontend** yang terpisah:

### 1. **Frontend Sistem** (Login/Auth)
- **Lokasi**: `resources/views/auth/`
- **Fungsi**: Halaman login untuk admin/kasir masuk ke sistem
- **Route**: `/` (homepage)
- **Pengguna**: Admin, Kasir, Staff

### 2. **Frontend Toko Online** (Shop)
- **Lokasi**: `resources/views/frontend/shop/`
- **Fungsi**: Toko online untuk customer belanja
- **Route**: `/shop/*`
- **Pengguna**: Customer/Pembeli

---

## 📂 Struktur Folder Detail

```
resources/views/
│
├── auth/                           # SISTEM LOGIN
│   ├── login.blade.php            # Halaman login (Homepage)
│   ├── register.blade.php         # Registrasi akun
│   ├── forgot-password.blade.php  # Lupa password
│   └── reset-password.blade.php   # Reset password
│
├── backend/                        # DASHBOARD ADMIN/KASIR
│   ├── layout/
│   │   └── app.blade.php          # Layout backend
│   ├── dashboard/
│   │   └── index.blade.php        # Dashboard utama
│   ├── produk/
│   │   ├── index.blade.php        # Daftar produk
│   │   ├── create.blade.php       # Tambah produk
│   │   └── edit.blade.php         # Edit produk
│   ├── transaksi/
│   ├── pemesanan/
│   └── ... (semua fitur backend)
│
└── frontend/                       # FRONTEND PUBLIC
    └── shop/                       # TOKO ONLINE (Per Pengguna)
        ├── home.blade.php          # Homepage toko online
        ├── katalog/
        │   └── index.blade.php     # Katalog produk
        ├── produk/
        │   └── detail.blade.php    # Detail produk
        ├── cart/
        │   └── index.blade.php     # Keranjang belanja
        └── checkout/
            └── index.blade.php     # Checkout pemesanan
```

---

## 🌐 Routing Structure

### **Sistem Utama (Login)**
```
GET  /                  → Login page (Homepage)
POST /login             → Proses login
GET  /register          → Halaman registrasi
POST /register          → Proses registrasi
GET  /forgot-password   → Lupa password
POST /forgot-password   → Kirim reset link
```

### **Toko Online (Shop)**
```
GET  /shop              → Homepage toko online
GET  /shop/katalog      → Katalog produk
GET  /shop/produk/{id}  → Detail produk
GET  /shop/cart         → Keranjang belanja
POST /shop/cart/add     → Tambah ke keranjang
GET  /shop/checkout     → Halaman checkout
POST /shop/order        → Proses pemesanan
```

### **Backend (Protected)**
```
GET  /dashboard         → Dashboard admin/kasir
GET  /produk            → Kelola produk
GET  /transaksi         → Kelola transaksi
GET  /pemesanan         → Kelola pemesanan
... (semua route backend)
```

---

## 🎨 Desain & Tema

### **Frontend Sistem (Login)**
- **Tema**: Dark blue gradient
- **Style**: Modern, professional, split-screen
- **Warna**: `#0a0e27`, `#16213e`, `#0f3460`
- **Target**: Admin, Kasir, Staff

### **Frontend Toko Online (Shop)**
- **Tema**: Bright, colorful, e-commerce
- **Style**: Modern, user-friendly, responsive
- **Warna**: Purple, blue, gradient
- **Target**: Customer, Pembeli umum

---

## 🔐 Keamanan & Isolasi

### **Per Toko (Single Tenant)**
Setiap toko yang install aplikasi ini akan punya:

```
Toko A (toko-amba.com)
├── Database: db_amba
├── Frontend Shop: /shop (dengan data Toko A)
├── Backend: /dashboard (admin Toko A)
└── Data: Produk A, Transaksi A, Customer A

Toko B (toko-sejahtera.com)
├── Database: db_sejahtera
├── Frontend Shop: /shop (dengan data Toko B)
├── Backend: /dashboard (admin Toko B)
└── Data: Produk B, Transaksi B, Customer B
```

**Keuntungan:**
- ✅ Data 100% terpisah
- ✅ Tidak ada cara data bisa tercampur
- ✅ Setiap toko punya toko online sendiri
- ✅ Customisasi per toko (logo, warna, produk)

---

## 🚀 Cara Mengaktifkan Toko Online

### **Opsi 1: Aktifkan untuk Semua Toko**
Setiap toko otomatis punya toko online di `/shop`

### **Opsi 2: Aktifkan Per Toko (Future)**
Tambahkan setting di database:
```php
// Migration
Schema::table('toko', function (Blueprint $table) {
    $table->boolean('shop_enabled')->default(true);
    $table->string('shop_theme')->default('default');
});

// Controller
if (!$toko->shop_enabled) {
    abort(404, 'Toko online belum aktif');
}
```

---

## 📱 Responsive Design

Semua halaman frontend shop sudah responsive:
- ✅ Desktop (1920px+)
- ✅ Laptop (1366px - 1920px)
- ✅ Tablet (768px - 1366px)
- ✅ Mobile (320px - 768px)

---

## 🎯 User Flow

### **Customer (Pembeli)**
```
1. Buka website → Lihat login page
2. Klik "Lihat Katalog" → Masuk ke /shop/katalog
3. Browse produk → Pilih produk
4. Tambah ke cart → Checkout
5. Isi form pemesanan → Submit order
6. Terima kode order → Track status
```

### **Admin/Kasir**
```
1. Buka website → Lihat login page
2. Login dengan akun → Masuk dashboard
3. Kelola produk, stok, transaksi
4. Lihat order dari customer
5. Proses order → Update status
```

---

## 🔧 Customisasi Per Toko

### **Logo & Branding**
```php
// Di view shop
<img src="{{ asset('storage/' . $toko->logo) }}" alt="{{ $toko->nama_toko }}">
<h1>{{ $toko->nama_toko }}</h1>
```

### **Warna Tema**
```php
// Di view shop
<style>
    :root {
        --primary: {{ $toko->primary_color ?? '#3498db' }};
        --secondary: {{ $toko->secondary_color ?? '#2ecc71' }};
    }
</style>
```

### **Konten Custom**
```php
// Banner, Artikel, Testimoni
$banners = Banner::where('toko_id', $toko->id)->aktif()->get();
$artikels = Artikel::where('toko_id', $toko->id)->published()->get();
```

---

## 📊 Fitur Toko Online

### **Sudah Ada:**
- ✅ Homepage dengan banner & produk unggulan
- ✅ Katalog produk dengan filter & search
- ✅ Pagination produk
- ✅ Section promo & artikel
- ✅ Form pemesanan publik
- ✅ Track order dengan kode

### **Akan Ditambahkan (Future):**
- ⏳ Detail produk dengan zoom image
- ⏳ Keranjang belanja (cart)
- ⏳ Wishlist/favorit
- ⏳ Review & rating produk
- ⏳ Live chat customer service
- ⏳ Payment gateway integration
- ⏳ Shipping integration

---

## 🎉 Kesimpulan

**Struktur frontend sudah terpisah dengan rapi:**

1. ✅ **Login page** sebagai homepage sistem
2. ✅ **Toko online** di folder `frontend/shop/`
3. ✅ **Backend** di folder `backend/`
4. ✅ **Routing** yang jelas dan terstruktur
5. ✅ **Data terpisah** per toko (aman!)

Setiap toko yang install aplikasi ini akan otomatis punya:
- Sistem POS (backend)
- Toko online (frontend shop)
- Data terpisah & aman

**Tidak ada cara data bisa tercampur!** 🔒
