# 📱 Panduan Print ke Printer Thermu

## Tentang Printer Thermu
Thermu adalah printer thermal portable Bluetooth yang support ESC/POS commands.
Biasanya digunakan untuk cetak struk, label, dan nota.

---

## 🎯 Metode Print (Pilih Salah Satu)

### **METODE 1: Print via Browser (PALING MUDAH)**

#### Langkah-langkah:
1. **Pair Printer di Windows:**
   - Nyalakan printer Thermu
   - Windows Settings > Bluetooth & devices
   - Add device > Bluetooth
   - Pilih printer Thermu (biasanya muncul sebagai "Thermu" atau "MTP-II" atau "BlueTooth Printer")
   - Tunggu sampai status "Connected"

2. **Install Driver (Jika Belum):**
   - Download driver dari: https://www.thermu.com/support (atau CD yang disertakan)
   - Atau gunakan Generic Text Printer driver:
     - Control Panel > Devices and Printers
     - Add a printer > Add a local printer
     - Use an existing port > pilih port Bluetooth printer
     - Manufacturer: Generic, Printer: Generic / Text Only
     - Finish

3. **Test Print:**
   - Buka Notepad
   - Ketik beberapa baris text
   - File > Print > Pilih printer Thermu
   - Jika berhasil, printer akan cetak

4. **Print Struk dari Aplikasi:**
   - Setelah transaksi selesai, klik "🖨️ Print Browser"
   - Pilih printer Thermu
   - Klik Print

---

### **METODE 2: Download Struk + Print Manual**

#### Langkah-langkah:
1. Klik tombol "💾 Download Struk"
2. File .txt akan terdownload
3. Buka file dengan Notepad
4. File > Print > Pilih printer Thermu
5. Print

**Keuntungan:** Bisa edit atau simpan struk sebelum print

---

### **METODE 3: Print via Aplikasi Thermu (Jika Ada)**

#### Langkah-langkah:
1. Install aplikasi Thermu dari Play Store (untuk Android)
2. Connect printer via aplikasi
3. Gunakan fitur "Print from Browser" atau "Web Print"
4. Atau copy text struk dan paste ke aplikasi Thermu

---

### **METODE 4: Print Bluetooth (Web Bluetooth API)**

#### Langkah-langkah:
1. Pastikan printer sudah paired di Windows
2. Gunakan browser Chrome atau Edge
3. Klik "📱 Print Bluetooth"
4. Pilih printer Thermu dari daftar
5. Tunggu hingga selesai

**Catatan:** Metode ini masih experimental, mungkin tidak selalu berhasil.

---

## 🔧 Troubleshooting

### Printer Tidak Muncul di Dialog Print
**Solusi:**
1. Pastikan printer status "Connected" di Windows Bluetooth
2. Install driver printer (lihat Metode 1 langkah 2)
3. Restart browser setelah install driver
4. Coba print dari Notepad dulu untuk test

### Printer Connect tapi Tidak Print
**Solusi:**
1. Cek baterai printer (charge jika low)
2. Cek kertas thermal (pastikan ada dan terpasang benar)
3. Restart printer (matikan dan nyalakan lagi)
4. Unpair dan pair ulang di Windows Bluetooth

### Format Struk Tidak Rapi
**Solusi:**
1. Gunakan font Courier New atau Consolas (monospace)
2. Set paper size:
   - Untuk Thermu 58mm: pilih "58mm" atau "Custom 58mm"
   - Untuk Thermu 80mm: pilih "80mm" atau "Custom 80mm"
3. Set margin ke 0 atau minimal
4. Gunakan metode "Download Struk" untuk hasil terbaik

### Web Bluetooth Tidak Bisa Connect
**Solusi:**
1. Gunakan Metode 1 (Print Browser) atau Metode 2 (Download Struk)
2. Pastikan menggunakan Chrome/Edge (bukan Firefox/Safari)
3. Pastikan menggunakan HTTPS atau localhost
4. Coba restart printer dan browser

---

## 📋 Spesifikasi Printer Thermu

**Model Umum:**
- Thermu T1
- Thermu T2
- Thermu T3
- MTP-II / MTP-III

**Koneksi:**
- Bluetooth 4.0 atau lebih tinggi
- USB (untuk charging dan print via kabel)

**Kertas:**
- Thermal paper 58mm x 30mm (roll)
- Atau 80mm x 30mm (tergantung model)

**Baterai:**
- Lithium 1500-2000mAh
- Charging via USB Type-C atau Micro USB

**Support:**
- ESC/POS commands
- Text printing
- Barcode printing (beberapa model)
- QR code printing (beberapa model)

---

## 💡 Tips & Trik

1. **Hemat Baterai:**
   - Matikan printer jika tidak digunakan
   - Jangan biarkan printer dalam mode standby terlalu lama

2. **Kualitas Print:**
   - Gunakan kertas thermal berkualitas baik
   - Bersihkan print head secara berkala (gunakan alkohol 70%)

3. **Koneksi Stabil:**
   - Jarak maksimal 10 meter dari device
   - Hindari penghalang (dinding, logam)
   - Jangan gunakan printer sambil charging (bisa ganggu Bluetooth)

4. **Backup Struk:**
   - Gunakan "Download Struk" untuk simpan backup
   - Struk thermal bisa pudar dalam 6-12 bulan

---

## 📞 Support

**Website:** https://www.thermu.com
**Email:** support@thermu.com
**WhatsApp:** (cek di box printer atau website)

**Driver Download:**
- https://www.thermu.com/support/drivers
- Atau gunakan Generic Text Printer driver dari Windows

---

## ✅ Checklist Sebelum Print

- [ ] Printer sudah ON dan charged
- [ ] Printer sudah paired di Windows Bluetooth
- [ ] Status printer "Connected"
- [ ] Kertas thermal terpasang dengan benar
- [ ] Driver printer sudah terinstall (untuk Print Browser)
- [ ] Test print dari Notepad berhasil

Jika semua checklist sudah ✅, Anda siap print struk! 🎉
