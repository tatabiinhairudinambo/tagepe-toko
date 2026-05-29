# 📁 Struktur Folder Backend & Frontend

## 🎯 Overview

Project ini menggunakan **Laravel Monolith** dengan pemisahan jelas antara Backend (Admin) dan Frontend (Customer).

---

## 📂 Struktur Folder Lengkap

```
tagepe-toko/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Backend/           # ✅ Admin Controllers
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── ProdukController.php
│   │   │   │   ├── KategoriController.php
│   │   │   │   ├── TransaksiController.php
│   │   │   │   ├── UserController.php
│   │   │   │   ├── CabangController.php
│   │   │   │   ├── TokoController.php
│   │   │   │   └── PemesananController.php
│   │   │   │
│   │   │   ├── Frontend/          # ✅ Customer Controllers
│   │   │   │   ├── HomeController.php
│   │   │   │   ├── KatalogController.php
│   │   │   │   ├── ArtikelController.php
│   │   │   │   └── OrderPublikController.php
│   │   │   │
│   │   │   └── AuthController.php # ✅ Shared Authentication
│   │   │
│   │   └── Middleware/
│   │       ├── CheckLogin.php
│   │       └── CheckRole.php
│   │
│   └── Models/
│       ├── User.php
│       ├── Produk.php
│       ├── Kategori.php
│       ├── Transaksi.php
│       ├── Cabang.php
│       ├── Toko.php
│       ├── Banner.php
│       ├── Artikel.php
│       └── Testimoni.php
│
├── resources/
│   └── views/
│       │
│       ├── backend/               # 🔐 ADMIN DASHBOARD
│       │   ├── layout/
│       │   │   └── app.blade.php  # Layout admin dengan sidebar
│       │   │
│       │   ├── dashboard/
│       │   │   └── index.blade.php
│       │   │
│       │   ├── produk/
│       │   │   ├── index.blade.php
│       │   │   └── form.blade.php
│       │   │
│       │   ├── kategori/
│       │   │   ├── index.blade.php
│       │   │   └── form.blade.php
│       │   │
│       │   ├── transaksi/
│       │   │   ├── index.blade.php
│       │   │   ├── detail.blade.php
│       │   │   ├── struk.blade.php
│       │   │   └── laporan.blade.php
│       │   │
│       │   ├── user/
│       │   │   ├── index.blade.php
│       │   │   └── form.blade.php
│       │   │
│       │   ├── cabang/
│       │   │   ├── index.blade.php
│       │   │   ├── form.blade.php
│       │   │   └── stok.blade.php
│       │   │
│       │   ├── toko/
│       │   │   ├── index.blade.php
│       │   │   └── edit.blade.php
│       │   │
│       │   ├── pemesanan/
│       │   │   ├── index.blade.php
│       │   │   ├── create.blade.php
│       │   │   └── nota.blade.php
│       │   │
│       │   ├── order/
│       │   │   └── kasir.blade.php
│       │   │
│       │   └── profile/
│       │       └── edit.blade.php
│       │
│       ├── frontend/              # 🌐 CUSTOMER/PUBLIC
│       │   ├── layout/
│       │   │   └── app.blade.php  # Layout modern dengan navbar
│       │   │
│       │   ├── home.blade.php     # Homepage modern
│       │   │
│       │   ├── katalog/
│       │   │   └── index.blade.php
│       │   │
│       │   ├── artikel/
│       │   │   ├── index.blade.php
│       │   │   └── show.blade.php
│       │   │
│       │   └── order/
│       │       ├── index.blade.php
│       │       ├── sukses.blade.php
│       │       └── cek-status.blade.php
│       │
│       └── auth/                  # 🔑 AUTHENTICATION (Shared)
│           ├── login.blade.php
│           ├── register.blade.php
│           ├── forgot-password.blade.php
│           └── reset-password.blade.php
│
├── routes/
│   └── web.php                    # All routes (organized by section)
│
└── database/
    ├── migrations/
    └── seeders/
```

---

## 🔐 Backend (Admin Dashboard)

### **URL Pattern:**
```
/dashboard
/produk
/kategori
/transaksi
/user
/cabang
/toko
/pemesanan
/order-kasir
/profile
```

### **Features:**
- ✅ Dashboard dengan statistik
- ✅ Manajemen Produk & Kategori
- ✅ Transaksi & Laporan
- ✅ Manajemen User & Cabang
- ✅ Setting Toko
- ✅ Order dari Customer (Kasir)
- ✅ Profile & Ubah Password

### **Access:**
- Login required
- Role-based access (admin/kasir)
- Sidebar navigation
- Dark mode support

---

## 🌐 Frontend (Customer/Public)

### **URL Pattern:**
```
/                    # Homepage
/katalog             # Katalog Produk
/artikel             # Artikel & Blog
/order               # Order Online
/order/sukses/{kode} # Order Success
/order/cek           # Cek Status Order
```

### **Features:**
- ✅ Homepage modern dengan hero section
- ✅ Banner slider otomatis
- ✅ Produk unggulan
- ✅ Artikel terbaru
- ✅ Testimoni customer
- ✅ Order online untuk customer
- ✅ Cek status order

### **Access:**
- Public (no login required)
- Modern UI/UX
- Responsive design
- Dark/Light mode toggle

---

## 🔑 Authentication (Shared)

### **URL Pattern:**
```
/login
/register
/forgot-password
/reset-password/{token}
/logout
```

### **Features:**
- ✅ Login dengan rate limiting
- ✅ Register user baru
- ✅ Lupa password
- ✅ Reset password via token
- ✅ Remember me
- ✅ Login log tracking

---

## 📋 Routes Organization

### **File: `routes/web.php`**

```php
// ============================================
// FRONTEND ROUTES (Public)
// ============================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/order', [OrderPublikController::class, 'index'])->name('order.index');
// ... more frontend routes

// ============================================
// AUTHENTICATION ROUTES (Shared)
// ============================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
// ... more auth routes

// ============================================
// BACKEND ROUTES (Admin - Protected)
// ============================================
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('produk', ProdukController::class);
    Route::resource('kategori', KategoriController::class);
    // ... more backend routes
    
    // Admin only routes
    Route::middleware('role:admin')->group(function () {
        Route::resource('user', UserController::class);
        Route::resource('cabang', CabangController::class);
        // ... more admin routes
    });
});
```

---

## 🎨 Layout Templates

### **Backend Layout:**
```blade
@extends('backend.layout.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Admin content here -->
@endsection
```

**Features:**
- Sidebar navigation
- Top navbar with user menu
- Dark mode toggle
- Breadcrumbs
- Footer

---

### **Frontend Layout:**
```blade
@extends('frontend.layout.app')

@section('title', 'Home')

@section('content')
    <!-- Customer content here -->
@endsection
```

**Features:**
- Modern navbar
- Hero sections
- Footer with links
- Scroll to top
- Theme toggle

---

## 🚀 Migration Plan

### **Current Status:**
```
✅ Frontend structure ready
✅ Auth structure ready
✅ Backend reorganization COMPLETED
```

### **Completed Steps:**

1. **✅ Created Backend Folder Structure:**
   ```
   resources/views/backend/
   ├── layout/
   │   └── app.blade.php
   ├── dashboard/
   │   └── index.blade.php
   ├── produk/
   │   ├── index.blade.php
   │   └── form.blade.php
   ├── kategori/
   │   ├── index.blade.php
   │   └── form.blade.php
   ├── transaksi/
   │   ├── index.blade.php
   │   ├── detail.blade.php
   │   ├── struk.blade.php
   │   └── laporan.blade.php
   ├── user/
   │   ├── index.blade.php
   │   └── form.blade.php
   ├── cabang/
   │   ├── index.blade.php
   │   ├── form.blade.php
   │   └── stok.blade.php
   ├── toko/
   │   ├── index.blade.php
   │   └── edit.blade.php
   ├── pemesanan/
   │   ├── index.blade.php
   │   ├── create.blade.php
   │   └── nota.blade.php
   ├── order/
   │   └── kasir.blade.php
   └── profile/
       └── edit.blade.php
   ```

2. **✅ Created Frontend Folder Structure:**
   ```
   resources/views/frontend/
   ├── layout/
   │   └── app.blade.php
   ├── home.blade.php
   ├── katalog/
   │   └── index.blade.php
   ├── artikel/
   │   └── index.blade.php
   └── order/
       ├── index.blade.php
       ├── sukses.blade.php
       └── cek-status.blade.php
   ```

3. **✅ Updated All Backend Controllers:**
   - ✅ DashboardController → `backend.dashboard.index`
   - ✅ KategoriController → `backend.kategori.*`
   - ✅ ProdukController → `backend.produk.*`
   - ✅ UserController → `backend.user.*`
   - ✅ CabangController → `backend.cabang.*`
   - ✅ TokoController → `backend.toko.*`
   - ✅ TransaksiController → `backend.transaksi.*`
   - ✅ PemesananController → `backend.pemesanan.*`
   - ✅ OrderKasirController → `backend.order.kasir`
   - ✅ ProfileController → `backend.profile.edit`

4. **✅ Updated All Frontend Controllers:**
   - ✅ HomeController → `frontend.home`
   - ✅ KatalogController → `frontend.katalog.index`
   - ✅ ArtikelController → `frontend.artikel.index`
   - ✅ OrderPublikController → `frontend.order.*`

5. **✅ Updated All Backend Views:**
   - Changed `@extends('layout.app')` to `@extends('backend.layout.app')`
   - All 20+ backend blade files updated automatically

6. **✅ Moved Backend Layout:**
   - `resources/views/layout/app.blade.php` → `resources/views/backend/layout/app.blade.php`

### **Next Steps:**

1. **Test All Routes:**
   ```bash
   # Test backend routes
   php artisan route:list --path=dashboard
   php artisan route:list --path=produk
   php artisan route:list --path=kategori
   
   # Test frontend routes
   php artisan route:list --path=katalog
   php artisan route:list --path=order
   ```

2. **Clean Up Old Files (Optional):**
   ```bash
   # After confirming everything works, delete old files:
   rm resources/views/dashboard.blade.php
   rm -r resources/views/user
   rm -r resources/views/cabang
   rm -r resources/views/kategori
   rm -r resources/views/produk
   rm -r resources/views/transaksi
   rm -r resources/views/toko
   rm -r resources/views/pemesanan
   rm -r resources/views/profile
   rm resources/views/katalog.blade.php
   rm -r resources/views/artikel
   rm -r resources/views/order
   rm -r resources/views/layout
   ```

3. **Update Documentation:**
   - ✅ FOLDER_STRUCTURE.md updated
   - Update README.md with new structure
   - Update FRONTEND_DOCUMENTATION.md if needed

---

## 📝 Naming Conventions

### **Controllers:**
- Backend: `Backend\DashboardController`
- Frontend: `Frontend\HomeController`
- Auth: `AuthController`

### **Views:**
- Backend: `backend.dashboard.index`
- Frontend: `frontend.home`
- Auth: `auth.login`

### **Routes:**
- Backend: `/dashboard`, `/produk`, etc.
- Frontend: `/`, `/katalog`, `/artikel`
- Auth: `/login`, `/register`

---

## 🔒 Security

### **Backend:**
- ✅ Authentication required
- ✅ Role-based access control
- ✅ CSRF protection
- ✅ Rate limiting

### **Frontend:**
- ✅ Public access
- ✅ CSRF for forms
- ✅ Input validation
- ✅ XSS protection

---

## 📱 Responsive Design

### **Backend:**
- Desktop-first
- Sidebar collapse on mobile
- Touch-friendly buttons

### **Frontend:**
- Mobile-first
- Responsive grid
- Touch gestures
- Progressive enhancement

---

## 🎯 Best Practices

1. **Separation of Concerns:**
   - Backend = Admin management
   - Frontend = Customer experience
   - Auth = Shared authentication

2. **Code Organization:**
   - Group by feature
   - Clear naming
   - Consistent structure

3. **Maintainability:**
   - Easy to find files
   - Clear dependencies
   - Documented code

4. **Scalability:**
   - Easy to add features
   - Modular structure
   - Reusable components

---

## 📚 Documentation

- `README.md` - Project overview
- `FRONTEND_DOCUMENTATION.md` - Frontend features
- `FOLDER_STRUCTURE.md` - This file
- Inline comments in code

---

**Last Updated:** 2026-05-29
**Version:** 1.0
