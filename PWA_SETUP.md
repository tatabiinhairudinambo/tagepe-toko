# 📱 TAGEPE PWA Setup Guide

## ✅ Yang Sudah Dibuat

### 1. PWA Manifest (`public/manifest.json`)
- App name: TAGEPE
- Theme color: #667eea (Purple gradient)
- Display mode: Standalone (fullscreen app)
- Icons: 72px sampai 512px
- Shortcuts: Dashboard, Transaksi

### 2. Service Worker (`public/sw.js`)
- Caching strategy: Network first, fallback to cache
- Offline support
- Background sync (optional)
- Push notifications (optional)

### 3. PWA Registration (`public/pwa-register.js`)
- Auto-register service worker
- Install prompt
- Online/offline detection
- Update notification

### 4. PWA Meta Component (`resources/views/components/pwa-meta.blade.php`)
- Mobile web app capable
- Apple touch icons
- Theme color
- Manifest link
- Install button

### 5. Splash Screen (`resources/views/components/splash-screen.blade.php`)
- Gradient background
- Logo animation
- Loading spinner
- Auto-hide after load

### 6. App Mode CSS (`public/css/app-mode.css`)
- Safe area support (notch/cutout)
- Bottom navigation
- Native-like buttons
- Card shadows
- FAB (Floating Action Button)
- Toast notifications
- Dark mode support

---

## 🎨 Generate Icons

### Cara 1: Otomatis (HTML Generator)
1. Buka browser: `http://127.0.0.1:8000/icons/generate-icons.html`
2. Icons akan auto-download
3. Pindahkan ke folder `public/icons/`

### Cara 2: Manual (Design Tools)
Gunakan Figma/Photoshop/Canva untuk buat icon:
- Background: Gradient #667eea → #764ba2
- Icon: Shop/Store icon putih
- Export ukuran: 72, 96, 128, 144, 152, 192, 384, 512 px

### Cara 3: Online Generator
1. Buka: https://www.pwabuilder.com/imageGenerator
2. Upload logo TAGEPE
3. Download semua ukuran
4. Extract ke `public/icons/`

---

## 🧪 Testing PWA

### Di Desktop (Chrome/Edge):
1. Buka: `http://127.0.0.1:8000`
2. Klik icon "Install" di address bar (kanan atas)
3. Atau: Menu → More tools → Create shortcut → ✓ Open as window

### Di Android Emulator:
1. Buka Chrome: `http://10.0.2.2:8000`
2. Menu (⋮) → Add to Home screen
3. Icon muncul di launcher
4. Buka dari launcher (fullscreen, tanpa browser bar)

### Di Real Android Device:
1. Connect ke WiFi yang sama dengan komputer
2. Cari IP komputer: `ipconfig` (misal: 192.168.1.100)
3. Buka Chrome: `http://192.168.1.100:8000`
4. Menu → Add to Home screen

---

## 🚀 Build APK dengan Capacitor

### Install Capacitor:
```bash
npm install @capacitor/core @capacitor/cli
npm install @capacitor/android
npx cap init
```

### Konfigurasi:
```bash
npx cap add android
npx cap sync
```

### Build APK:
```bash
npx cap open android
```
(Akan buka Android Studio → Build → Build Bundle(s) / APK(s) → Build APK(s))

---

## 🔧 Build APK dengan TWA (Trusted Web Activity)

### Cara Lebih Simple (Tanpa Android Studio):

1. **Install Bubblewrap:**
```bash
npm install -g @bubblewrap/cli
```

2. **Init Project:**
```bash
bubblewrap init --manifest=http://127.0.0.1:8000/manifest.json
```

3. **Build APK:**
```bash
bubblewrap build
```

4. **Install ke Device:**
```bash
bubblewrap install
```

**Keuntungan TWA:**
- ✅ Lebih simple (no Android Studio required)
- ✅ APK lebih kecil (~50KB)
- ✅ Auto-update dari web
- ✅ Google Play Store compatible

---

## 📱 Fitur PWA yang Sudah Ada

### ✅ Basic PWA:
- [x] Manifest.json
- [x] Service Worker
- [x] Offline support
- [x] Add to Home Screen
- [x] Splash screen
- [x] Theme color

### ✅ App-like Features:
- [x] Fullscreen mode
- [x] Native-like UI (buttons, cards, inputs)
- [x] Bottom navigation
- [x] Safe area support (notch)
- [x] Smooth animations
- [x] Loading states

### ⏳ Optional Features (Bisa Ditambah):
- [ ] Push notifications
- [ ] Background sync
- [ ] Offline data storage (IndexedDB)
- [ ] Camera/GPS access
- [ ] Biometric auth

---

## 🎯 Next Steps

### Untuk Make APK:

**Pilihan A: Capacitor (Full Native Features)**
```bash
npm install @capacitor/core @capacitor/cli @capacitor/android
npx cap init TAGEPE com.tagepe.umkm
npx cap add android
npx cap sync
npx cap open android
```

**Pilihan B: TWA (Simple & Fast)**
```bash
npm install -g @bubblewrap/cli
bubblewrap init --manifest=http://DOMAIN/manifest.json
bubblewrap build
```

---

## 📚 Resources

- PWA Builder: https://www.pwabuilder.com/
- Capacitor Docs: https://capacitorjs.com/docs
- Bubblewrap (TWA): https://github.com/GoogleChromeLabs/bubblewrap
- Web.dev PWA: https://web.dev/progressive-web-apps/

---

## ✅ Checklist Before Build APK

- [ ] Icons generated (semua ukuran)
- [ ] Manifest.json updated (URL production)
- [ ] Service worker tested
- [ ] PWA installable di Chrome
- [ ] Responsive di mobile
- [ ] HTTPS enabled (production)
- [ ] App tested di emulator

---

**Status:** ✅ PWA Ready!  
**Next:** Generate icons → Test di emulator → Build APK

**Last Updated:** 2026-06-04
