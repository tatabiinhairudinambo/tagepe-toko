# Sidebar Menu Kasir - Dokumentasi

## 📋 Menu Sidebar untuk Role Kasir

### Struktur Menu Lengkap:

```
┌─────────────────────────────────────┐
│  🏠 Dashboard                       │
│  🌐 Lihat Website                   │
│                                     │
│  TRANSAKSI                          │
│  💰 Transaksi ▼                     │
│     ├─ Kasir                        │
│     ├─ Order Online (🔴 badge)      │
│     ├─ Pemesanan                    │
│     └─ Laporan                      │
│                                     │
│  PRODUK                             │
│  📦 Daftar Produk                   │
│  ➕ Tambah Produk                   │
│                                     │
│  LAINNYA                            │
│  🌐 Lihat Website                   │
│  🚪 Keluar                          │
└─────────────────────────────────────┘
```

---

## ✅ Menu yang Sudah Ditambahkan

### 1. **Dashboard** 
**Route:** `/dashboard`  
**Icon:** 🏠 `bi-house-door-fill`

**Fungsi:**
- Homepage setelah login
- Menampilkan ringkasan shift kasir
- Quick action buttons
- Top products, low stock alert, dll

---

### 2. **Lihat Website** (Top)
**Route:** `/shop` (new tab)  
**Icon:** 🌐 `bi-globe`  
**Style:** `text-info` (warna biru)

**Fungsi:**
- Akses cepat ke toko online
- Buka di tab baru
- Lihat tampilan customer

---

### 3. **Transaksi** (Submenu)
**Icon:** 💰 `bi-cash-coin`  
**Status:** Expandable menu

#### 3.1 Kasir
**Route:** `/transaksi`  
**Fungsi:** 
- Buat transaksi penjualan baru
- Scan barcode / pilih produk
- Cetak struk

#### 3.2 Order Online
**Route:** `/order-kasir`  
**Badge:** 🔴 Merah (jika ada pending order)  
**Fungsi:**
- Lihat order online dari customer
- Proses order (pending → diproses → selesai)
- Badge menampilkan jumlah order pending

**Logic Badge:**
```php
$orderPending = \App\Models\OrderPublik::where('cabang_id', Auth::user()->cabang_id)
    ->where('status','pending')
    ->count();
```

#### 3.3 Pemesanan
**Route:** `/pemesanan`  
**Fungsi:**
- Kelola pemesanan customer
- Bayar / batal pemesanan
- Cetak nota

#### 3.4 Laporan (BARU!)
**Route:** `/transaksi/laporan`  
**Fungsi:**
- Lihat laporan penjualan
- Filter per tanggal
- Grafik penjualan

---

### 4. **Daftar Produk**
**Route:** `/produk`  
**Icon:** 📦 `bi-box-seam-fill`

**Fungsi:**
- Lihat semua produk
- Cek stok produk
- Filter per kategori
- Search produk

---

### 5. **Tambah Produk** (BARU!)
**Route:** `/produk/create`  
**Icon:** ➕ `bi-plus-circle-fill`

**Fungsi:**
- Tambah produk baru (status: pending)
- Upload foto produk
- Set harga, stok, kategori
- Menunggu approval admin

---

### 6. **Lihat Website** (Bottom)
**Route:** `/shop` (new tab)  
**Icon:** 🌐 `bi-globe2`  
**Extra Icon:** `bi-box-arrow-up-right` (external link indicator)

**Fungsi:**
- Same as top menu
- Positioned di section "Lainnya"

---

### 7. **Keluar**
**Route:** `POST /logout`  
**Icon:** 🚪 `bi-box-arrow-right`  
**Style:** Border top separator

**Fungsi:**
- Logout dari sistem
- Clear session
- Redirect ke halaman login

---

## 🎨 Design & Styling

### Active State:
```css
.active {
    background: rgba(255,255,255,.18);
    color: #fff;
}
.active::before {
    transform: scaleY(1); /* Blue gradient bar */
}
```

### Hover Effect:
```css
a:hover {
    color: #fff;
    background: rgba(255,255,255,.12);
    transform: translateX(3px);
}
```

### Badge Styling:
- **Merah (Danger):** Order pending yang perlu action
- **Kuning (Warning):** Item count atau notification
- **Abu-abu (Secondary):** Product count di kategori

### Color Scheme:
- **Background:** Dark gradient (`#0f2027` → `#203a43` → `#2c5364`)
- **Text:** White with opacity
- **Active:** White with higher opacity
- **Hover:** Light overlay

---

## 🔔 Notification Badge

### Order Online Badge:

**Kondisi Tampil:**
```php
@if($orderPending > 0)
    <span class="badge bg-danger ms-2">{{ $orderPending }}</span>
@endif
```

**Update Real-time:**
- Badge update setiap page load
- Query berdasarkan `cabang_id` kasir
- Status: `pending`

**Warna:**
- 🔴 **Merah (bg-danger):** Urgent, perlu action
- Badge size: `.65rem` (compact)
- Padding: `2px 6px`

---

## 📱 Responsive Behavior

### Mobile (< 992px):
- Sidebar hidden by default
- Show via hamburger button
- Overlay background
- Slide animation

### Desktop (>= 992px):
- Sidebar always visible
- Fixed position
- Scrollable content
- Auto-collapse submenu

---

## 🔄 Submenu Behavior

### Toggle Logic:
```javascript
function toggleSubmenu(element) {
    element.classList.toggle('active');
    const submenu = element.nextElementSibling;
    submenu.classList.toggle('show');
}
```

### Auto-expand:
- Submenu auto-expand jika route match
- State maintained via Blade condition
- CSS class: `.show`

---

## 🎯 User Flow untuk Kasir

### Scenario 1: Mulai Shift
```
Login → Dashboard → Cek Order Customer (badge) → Proses Order
```

### Scenario 2: Transaksi
```
Dashboard → Transaksi → Kasir → Pilih Produk → Bayar → Cetak Struk
```

### Scenario 3: Cek Stok
```
Dashboard → Daftar Produk → Cari Produk → Lihat Detail Stok
```

### Scenario 4: Tambah Produk
```
Dashboard → Tambah Produk → Input Data → Submit → Tunggu Approval
```

### Scenario 5: Lihat Laporan
```
Dashboard → Transaksi → Laporan → Filter Tanggal → Export
```

---

## ⚡ Quick Actions

### Dari Dashboard:
1. **Quick Action Button "Transaksi Baru"** → Langsung ke `/transaksi`
2. **Quick Action Button "Cek Stok"** → Langsung ke `/produk`
3. **Quick Action Button "Pemesanan"** → Langsung ke `/pemesanan`
4. **Quick Action Button "Order Online"** → Langsung ke `/order-kasir`

### Dari Sidebar:
- 1 klik untuk page utama
- Expand submenu untuk sub-pages
- Badge notification untuk alert

---

## 🔐 Permission

### Kasir BISA:
- ✅ Lihat dashboard (shift summary)
- ✅ Buat transaksi kasir
- ✅ Proses order customer
- ✅ Kelola pemesanan
- ✅ Lihat laporan (hanya cabangnya)
- ✅ Lihat daftar produk
- ✅ Tambah produk baru (pending)
- ✅ Lihat website toko

### Kasir TIDAK BISA:
- ❌ Approve produk (admin only)
- ❌ Edit produk yang sudah approved (admin only)
- ❌ Kelola kategori (admin only)
- ❌ Kelola cabang (admin only)
- ❌ Kelola user (admin only)
- ❌ Edit info toko (admin only)
- ❌ Export laporan PDF/CSV (admin only)

---

## 📊 Comparison: Admin vs Kasir Menu

| Menu Item | Admin | Kasir |
|-----------|-------|-------|
| Dashboard | ✅ Full data | ✅ Cabang only |
| Transaksi Kasir | ✅ | ✅ |
| Order Customer | ✅ | ✅ |
| Pemesanan | ✅ | ✅ |
| Laporan | ✅ Full | ✅ View only |
| Daftar Produk | ✅ Edit | ✅ View |
| Tambah Produk | ✅ Auto-approve | ✅ Pending |
| Kategori | ✅ | ❌ |
| Cabang | ✅ | ❌ |
| User | ✅ | ❌ |
| Pengaturan | ✅ | ✅ Profile only |

---

## 🐛 Known Issues & Limitations

1. **Badge order customer:**
   - Hanya tampil jika ada order pending
   - Perlu refresh page untuk update

2. **Submenu state:**
   - State tidak persist setelah page reload
   - Hanya auto-expand jika route match

3. **Mobile sidebar:**
   - Perlu close manual setelah klik menu
   - Overlay blocking content

---

## 🚀 Future Improvements

### Possible Enhancements:
1. **Real-time badge** - WebSocket untuk live update
2. **Keyboard shortcuts** - F1, F2, F3 untuk quick access
3. **Recent pages** - History menu yang sering diakses
4. **Favorites** - Pin menu favorit ke top
5. **Search menu** - Quick search untuk menu
6. **Collapse state** - Remember collapsed/expanded state
7. **Dark/Light theme** - Toggle untuk sidebar theme

---

## ✅ Testing Checklist

- [ ] Login sebagai kasir
- [ ] Dashboard load dengan benar
- [ ] Semua menu visible
- [ ] Submenu expand/collapse berfungsi
- [ ] Badge order customer tampil (jika ada order)
- [ ] Active state highlight benar
- [ ] Hover effect smooth
- [ ] Link routing ke halaman yang benar
- [ ] Tambah produk submit ke pending
- [ ] Laporan hanya tampil data cabang kasir
- [ ] Logout berfungsi
- [ ] Mobile hamburger menu berfungsi
- [ ] Sidebar overlay close saat klik outside

---

## 📞 Support

Jika ada bug atau request menu tambahan, silakan hubungi developer.

**Last Updated:** 2026-06-02  
**Version:** 1.0.0  
**Status:** ✅ Production Ready
