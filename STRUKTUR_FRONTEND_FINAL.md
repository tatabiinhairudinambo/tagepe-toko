# Struktur Frontend - TAGEPE UMKM POS

## Overview
Sistem memiliki 3 bagian frontend yang terpisah dengan fungsi berbeda:

---

## 1. Landing Page (Marketing/Sales)
**Route:** `/landing`  
**File:** `resources/views/frontend/landing.blade.php`  
**Layout:** `resources/views/frontend/layout/app.blade.php`

### Tujuan:
- Halaman marketing untuk mempromosikan sistem POS
- Menjelaskan fitur-fitur sistem
- Meyakinkan calon pengguna untuk mendaftar/login
- Desain mengikuti style Accurate.id POS

### Fitur:
- Hero section dengan CTA kuat
- Trust section (logo client)
- Benefits section (3 kartu keunggulan)
- Feature sections (alternating layout)
- Stats section (angka pencapaian)
- CTA section (ajakan login/hubungi)

### Target Audience:
- Calon pengguna yang ingin tahu tentang sistem
- Pengunjung baru yang mencari solusi POS
- UMKM yang ingin upgrade sistem kasir

---

## 2. Login Page (Homepage)
**Route:** `/` (root)  
**File:** `resources/views/auth/login.blade.php`

### Tujuan:
- Halaman utama untuk admin dan kasir login
- Gateway ke sistem backend (dashboard)
- Desain modern dan profesional

### Fitur:
- Split layout (content + form)
- Feature highlights
- Trust badges
- Link ke landing page
- Link ke toko online

### Target Audience:
- Admin toko
- Kasir
- Staff yang sudah terdaftar

---

## 3. Shop (Toko Online)
**Route:** `/shop`  
**File:** `resources/views/frontend/shop/home.blade.php`  
**Layout:** `resources/views/frontend/layout/app.blade.php`

### Tujuan:
- Toko online untuk customer
- Katalog produk per toko
- Order online untuk customer

### Fitur:
- Hero section
- Product grid (8 produk terbaru)
- Banner section
- Artikel section
- Testimoni section
- Dark theme dengan glassmorphism

### Target Audience:
- Customer/pembeli
- Pengunjung toko online
- User yang ingin order produk

---

## 4. Order System
**Route:** `/order`  
**File:** `resources/views/frontend/order/`

### Tujuan:
- Customer bisa order produk
- Cek status order
- Tracking pesanan

### Target Audience:
- Customer yang ingin order
- Customer yang ingin cek status order

---

## Navigasi Antar Halaman

```
Landing Page (/landing)
    ├─> Login (/) - untuk admin/kasir
    ├─> Shop (/shop) - untuk customer
    └─> Order (/order) - untuk customer order

Login Page (/)
    ├─> Dashboard (/dashboard) - setelah login
    ├─> Landing (/landing) - info sistem
    └─> Shop (/shop) - toko online

Shop (/shop)
    ├─> Order (/order) - buat pesanan
    └─> Login (/) - untuk admin
```

---

## File yang Dihapus (Cleanup)

### Dihapus:
- ❌ `resources/views/frontend/artikel/` - Tidak digunakan
- ❌ Route `/katalog` - Redirect tidak perlu
- ❌ Route `/artikel` - Tidak digunakan

### Alasan:
- Artikel sudah ada di shop home
- Katalog sudah ada di shop
- Mengurangi duplikasi
- Struktur lebih clean

---

## CSS & Assets

### Global:
- `public/css/responsive.css` - Responsive untuk semua device
- `public/css/shop-responsive.css` - Responsive khusus shop

### Layout:
- `resources/views/frontend/layout/app.blade.php` - Layout untuk landing & shop
- `resources/views/auth/login.blade.php` - Standalone (tidak pakai layout)
- `resources/views/backend/layout/app.blade.php` - Layout untuk dashboard

---

## Best Practices

### 1. Separation of Concerns
- Landing = Marketing
- Login = Authentication
- Shop = E-commerce
- Backend = Management

### 2. User Journey
```
Visitor → Landing Page → Login → Dashboard (Admin/Kasir)
Visitor → Shop → Order → Checkout (Customer)
```

### 3. Responsive Design
- Mobile-first approach
- Breakpoints: 320px, 768px, 1024px, 1280px, 1920px
- Touch-optimized untuk mobile

### 4. Performance
- Lazy loading untuk gambar
- Minimal external dependencies
- Optimized CSS

---

## Maintenance

### Menambah Fitur Baru:
1. Tentukan target audience (admin/kasir/customer)
2. Pilih section yang tepat (landing/shop/backend)
3. Update route di `routes/web.php`
4. Update navigation di layout yang sesuai

### Update Konten:
- Landing page: Edit `resources/views/frontend/landing.blade.php`
- Shop: Edit `resources/views/frontend/shop/home.blade.php`
- Login: Edit `resources/views/auth/login.blade.php`

---

## Kontak & Support
Untuk pertanyaan atau bantuan, hubungi tim development.

**Last Updated:** 2026-06-02
