# 🚀 Website Toko Online Modern - Frontend Documentation

## 📋 Overview

Website toko online modern dengan desain futuristik, clean, responsive, dan profesional menggunakan Laravel + MySQL.

## ✨ Fitur yang Sudah Dibuat

### 1. **Homepage Modern** ✅
- ✅ Hero section fullscreen dengan animasi
- ✅ Banner promosi otomatis (slider carousel)
- ✅ Produk unggulan (8 produk terbaru)
- ✅ Artikel terbaru (3 artikel)
- ✅ Promo diskon berjalan
- ✅ Testimoni customer (6 testimoni)
- ✅ Footer lengkap dengan sosial media
- ✅ Stats section (Produk, Customer, Rating, Support)
- ✅ CTA (Call to Action) section

### 2. **Layout Template Modern** ✅
- ✅ Dark mode + Light mode toggle
- ✅ Glassmorphism effect
- ✅ Navbar modern dengan scroll effect
- ✅ Responsive mobile & desktop
- ✅ Animasi halus (smooth animations)
- ✅ Scroll to top button
- ✅ Theme persistence (localStorage)

### 3. **Database & Models** ✅
- ✅ Tabel `banners` - Banner slider homepage
- ✅ Tabel `artikels` - Artikel/blog
- ✅ Tabel `testimonis` - Testimoni customer
- ✅ Model Banner dengan scope aktif
- ✅ Model Artikel dengan auto slug
- ✅ Model Testimoni dengan rating

### 4. **Controllers** ✅
- ✅ HomeController - Homepage dengan data lengkap
- ✅ ArtikelController - Halaman artikel & promo

### 5. **Seeders** ✅
- ✅ FrontendSeeder - Data dummy lengkap:
  - 3 Banner slider
  - 3 Artikel
  - 6 Testimoni

## 🎨 Design System

### Warna
```css
--primary: #6366f1 (Indigo)
--secondary: #8b5cf6 (Purple)
--accent: #ec4899 (Pink)
--success: #10b981 (Green)
--warning: #f59e0b (Orange)
--danger: #ef4444 (Red)
```

### Typography
- Font: Inter (Google Fonts)
- Weights: 300, 400, 500, 600, 700, 800, 900

### Effects
- Glassmorphism: `backdrop-filter: blur(20px)`
- Gradient: Linear gradient 135deg
- Border radius: 12px - 24px
- Shadows: Soft shadows dengan opacity

## 📁 Struktur File

```
app/
├── Http/Controllers/
│   ├── HomeController.php          # Homepage controller
│   └── ArtikelController.php       # Artikel controller
├── Models/
│   ├── Banner.php                  # Model banner
│   ├── Artikel.php                 # Model artikel
│   └── Testimoni.php               # Model testimoni

database/
├── migrations/
│   ├── 2026_05_29_000001_create_banners_table.php
│   ├── 2026_05_29_000002_create_artikels_table.php
│   └── 2026_05_29_000003_create_testimonis_table.php
└── seeders/
    └── FrontendSeeder.php          # Seeder data dummy

resources/views/
├── frontend/
│   ├── layout/
│   │   └── app.blade.php           # Layout template modern
│   └── home.blade.php              # Homepage
└── artikel/
    └── index.blade.php             # Halaman artikel

routes/
└── web.php                         # Routes
```

## 🚀 Cara Menggunakan

### 1. Akses Homepage
```
http://127.0.0.1:8000/
```

### 2. Fitur yang Tersedia
- **Dark/Light Mode**: Klik icon bulan/matahari di navbar
- **Banner Slider**: Auto play setiap 5 detik
- **Produk Unggulan**: Menampilkan 8 produk terbaru
- **Artikel**: Menampilkan 3 artikel terbaru
- **Testimoni**: Menampilkan 6 testimoni customer
- **Scroll to Top**: Muncul saat scroll > 300px

### 3. Navigasi
- Home: `/`
- Produk: `/katalog`
- Artikel: `/artikel`
- Order: `/order`
- Login: `/login`

## 🎯 Fitur yang Belum Dibuat (Next Steps)

### 1. Halaman Produk Detail
- [ ] Detail produk lengkap
- [ ] Gambar multiple (gallery)
- [ ] Badge diskon
- [ ] Related products
- [ ] Review produk

### 2. Halaman Artikel Detail
- [ ] Konten artikel lengkap
- [ ] Related articles
- [ ] Komentar user
- [ ] Share social media

### 3. Halaman Promo
- [ ] Banner promo besar
- [ ] Flash sale
- [ ] Countdown diskon
- [ ] Voucher promo

### 4. Halaman Tentang Toko
- [ ] Profil toko
- [ ] Visi misi
- [ ] Keunggulan toko
- [ ] Team member

### 5. Halaman Kontak
- [ ] Form contact
- [ ] WhatsApp button floating
- [ ] Google Maps embed
- [ ] Sosial media links

### 6. Authentication
- [ ] Register page
- [ ] Forgot password
- [ ] Login Google (optional)

### 7. Fitur Tambahan
- [ ] Search produk global
- [ ] Filter produk advanced
- [ ] Wishlist
- [ ] Compare products
- [ ] Newsletter subscription

## 💡 Tips Pengembangan

### Menambah Banner Baru
```php
Banner::create([
    'judul' => 'Judul Banner',
    'deskripsi' => 'Deskripsi banner',
    'gambar' => 'path/to/image.jpg',
    'link' => '/katalog',
    'urutan' => 1,
    'aktif' => true
]);
```

### Menambah Artikel Baru
```php
Artikel::create([
    'judul' => 'Judul Artikel',
    'slug' => 'judul-artikel', // auto generate jika kosong
    'excerpt' => 'Ringkasan artikel',
    'konten' => '<p>Konten lengkap...</p>',
    'gambar' => 'path/to/image.jpg',
    'kategori_artikel' => 'Tips',
    'published' => true
]);
```

### Menambah Testimoni Baru
```php
Testimoni::create([
    'nama' => 'Nama Customer',
    'foto' => 'path/to/photo.jpg', // optional
    'testimoni' => 'Testimoni customer...',
    'rating' => 5,
    'aktif' => true
]);
```

## 🎨 Customisasi Theme

### Mengubah Warna Primary
Edit di `resources/views/frontend/layout/app.blade.php`:
```css
:root {
    --primary: #6366f1; /* Ganti dengan warna pilihan */
}
```

### Mengubah Font
Edit di `<head>`:
```html
<link href="https://fonts.googleapis.com/css2?family=NamaFont:wght@...&display=swap" rel="stylesheet">
```

Lalu update CSS:
```css
body {
    font-family: 'NamaFont', sans-serif;
}
```

## 📱 Responsive Breakpoints

- Mobile: < 768px
- Tablet: 768px - 991px
- Desktop: ≥ 992px

## 🔧 Troubleshooting

### Banner tidak muncul
- Pastikan sudah run seeder: `php artisan db:seed --class=FrontendSeeder`
- Cek tabel banners ada data dengan `aktif = true`

### Produk tidak muncul
- Pastikan ada produk dengan `status = 'approved'` dan `stok > 0`
- Cek di tabel `produks`

### Theme tidak tersimpan
- Cek browser support localStorage
- Clear browser cache

## 📞 Support

Jika ada pertanyaan atau butuh bantuan, silakan hubungi developer.

---

**Dibuat dengan ❤️ dan bismillah**
