# Panduan Frontend - TAGEPE UMKM POS

## 🎯 Ringkasan Cepat

Sistem memiliki 4 halaman utama:

| Halaman | URL | Untuk Siapa | Fungsi |
|---------|-----|-------------|--------|
| **Landing Page** | `/landing` | Calon pengguna | Marketing & informasi sistem |
| **Login** | `/` | Admin & Kasir | Login ke sistem backend |
| **Shop** | `/shop` | Customer | Toko online & katalog produk |
| **Order** | `/order` | Customer | Buat pesanan online |

---

## 📱 1. Landing Page

### URL: `/landing`

### Tujuan:
Halaman marketing yang menjelaskan keunggulan sistem POS, mirip dengan Accurate.id POS.

### Konten:
1. **Hero Section**
   - Headline: "Kasir Pintar, Lancar Proses Orderan"
   - CTA: Login Sekarang & Lihat Fitur

2. **Trust Section**
   - "Dipercaya oleh 1000+ UMKM di Indonesia"
   - Logo client (icon placeholder)

3. **Benefits Section**
   - Operasional Bisnis Optimal
   - Fleksibel untuk Berbagai Jenis Usaha
   - Mudah Digunakan & Fitur Lengkap

4. **Feature Sections**
   - Transaksi Cepat & Akurat
   - Kelola Stok Real-Time
   - Laporan Lengkap & Real-Time

5. **Stats Section**
   - 1000+ UMKM Terdaftar
   - 50K+ Transaksi per Hari
   - 99.9% Uptime
   - 4.9/5 Rating Pengguna

6. **CTA Section**
   - "Siap Upgrade Sistem Kasir Anda?"
   - Button: Login Sekarang & Hubungi Kami

### Navigasi:
- Beranda → `/landing`
- Fitur → `#fitur` (scroll)
- Toko Online → `/shop`
- Tentang → `#tentang` (scroll)
- Kontak → `#kontak` (scroll)
- **Login** (button) → `/`

### Responsive:
✅ Mobile (320px+)  
✅ Tablet (768px+)  
✅ iPad (1024px+)  
✅ Laptop (1280px+)  
✅ Desktop (1920px+)

---

## 🔐 2. Login Page (Homepage)

### URL: `/` (root)

### Tujuan:
Halaman utama untuk admin dan kasir masuk ke sistem backend.

### Konten:
**Left Side (Content):**
- Headline: "Kelola Toko Anda dengan Lebih Mudah"
- 4 Feature highlights dengan checkmark
- Trust badges (Aman, 1000+ UMKM, Rating 4.9/5)

**Right Side (Form):**
- Email input
- Password input (dengan toggle visibility)
- Remember me checkbox
- Forgot password link
- Login button
- Register link

### Navigasi:
- Tentang Sistem → `/landing`
- Toko Online → `/shop`
- Daftar Gratis → `/register`

### Setelah Login:
- Admin → `/dashboard`
- Kasir → `/dashboard`

### Responsive:
✅ Mobile: Form di bawah content  
✅ Tablet: Form di bawah content  
✅ Desktop: Split screen (content | form)

---

## 🛒 3. Shop (Toko Online)

### URL: `/shop`

### Tujuan:
Toko online untuk customer melihat produk dan membuat pesanan.

### Konten:
1. **Hero Section**
   - Welcome message
   - CTA: Lihat Produk

2. **Stats Cards**
   - Total Produk
   - Kategori
   - Happy Customers
   - Rating

3. **Product Grid**
   - 8 produk terbaru
   - Responsive grid (2-4 kolom)
   - Harga, stok, kategori
   - Button: Pesan Sekarang

4. **Banner Section**
   - Promo/banner slider

5. **Artikel Section**
   - 3 artikel terbaru

6. **Testimoni Section**
   - Customer reviews

### Navigasi:
- Beranda → `/landing`
- Toko Online → `/shop`
- Login → `/`
- Order → `/order`

### Theme:
- Dark theme dengan glassmorphism
- Animated background
- Theme toggle (dark/light)

### Responsive:
✅ Mobile: 2 kolom produk  
✅ Tablet: 2 kolom produk  
✅ iPad: 3 kolom produk  
✅ Laptop+: 4 kolom produk

---

## 📦 4. Order System

### URL: `/order`

### Tujuan:
Customer membuat pesanan online.

### Fitur:
- Form order produk
- Pilih produk & jumlah
- Input data customer
- Submit order
- Cek status order (`/order/cek`)

### Flow:
```
/order → Form → Submit → /order/sukses/{kode} → Konfirmasi
```

---

## 🎨 Design System

### Color Palette:
```css
--primary-blue: #0066FF
--primary-dark: #0052CC
--secondary-blue: #4D94FF
--accent-green: #00C853
--text-dark: #1A1A1A
--text-gray: #6B7280
```

### Typography:
- Font: Inter, -apple-system, BlinkMacSystemFont, Segoe UI
- Heading: 700-800 weight
- Body: 400-500 weight

### Spacing:
- Section padding: 5rem (desktop), 3rem (mobile)
- Card padding: 2rem (desktop), 1.5rem (mobile)
- Gap: 1-4rem

---

## 🔄 User Journey

### Calon Pengguna (Visitor):
```
Landing Page → Lihat Fitur → Login → Dashboard
```

### Customer:
```
Shop → Lihat Produk → Order → Checkout → Konfirmasi
```

### Admin/Kasir:
```
Login → Dashboard → Kelola Transaksi/Produk/Stok
```

---

## 🛠️ Maintenance & Update

### Update Konten Landing:
1. Edit `resources/views/frontend/landing.blade.php`
2. Update stats, features, atau CTA
3. Clear cache: `php artisan view:clear`

### Update Shop:
1. Edit `resources/views/frontend/shop/home.blade.php`
2. Update product display atau sections
3. Clear cache: `php artisan view:clear`

### Update Login:
1. Edit `resources/views/auth/login.blade.php`
2. Update content atau form
3. Clear cache: `php artisan view:clear`

### Update Navigation:
1. Edit `resources/views/frontend/layout/app.blade.php`
2. Update navbar atau footer
3. Clear cache: `php artisan view:clear`

---

## 🚀 Testing

### Test Landing Page:
```
http://localhost:8000/landing
```

### Test Login:
```
http://localhost:8000/
```

### Test Shop:
```
http://localhost:8000/shop
```

### Test Order:
```
http://localhost:8000/order
```

### Clear All Cache:
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## 📱 Responsive Testing

### Breakpoints:
- **Mobile:** 320px - 767px
- **Tablet:** 768px - 1023px
- **iPad:** 1024px - 1279px
- **Laptop:** 1280px - 1919px
- **Desktop:** 1920px+

### Test Devices:
- iPhone SE (375px)
- iPhone 12 Pro (390px)
- iPad (768px)
- iPad Pro (1024px)
- Laptop (1440px)
- Desktop (1920px)

---

## ✅ Checklist Deployment

- [ ] Test semua route berfungsi
- [ ] Test responsive di semua device
- [ ] Test form validation
- [ ] Test navigation links
- [ ] Update konten sesuai bisnis
- [ ] Ganti placeholder images
- [ ] Update contact info (WA, email)
- [ ] Test theme toggle
- [ ] Test scroll animations
- [ ] Clear all cache

---

## 📞 Support

Jika ada pertanyaan atau butuh bantuan:
- Baca dokumentasi ini
- Check `STRUKTUR_FRONTEND_FINAL.md`
- Check `routes/web.php` untuk route list

**Last Updated:** 2026-06-02
