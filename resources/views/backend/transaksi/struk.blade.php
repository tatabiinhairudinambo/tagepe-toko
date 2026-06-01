<!DOCTYPE html>
<html>
<head>
    <title>Struk - {{ $transaksi->kode_transaksi }}</title>
    <meta charset="UTF-8">
    <style>
        /* Reset & Base */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        /* Thermal Printer Optimization - 58mm width (220px) */
        @page {
            size: 58mm auto;
            margin: 0;
        }
        
        body {
            font-family: 'Courier New', 'Consolas', monospace;
            font-size: 11px;
            line-height: 1.3;
            width: 58mm;
            max-width: 220px;
            margin: 0 auto;
            padding: 5px;
            background: white;
        }
        
        /* Print Styles */
        @media print {
            body { 
                width: 58mm;
                margin: 0;
                padding: 2mm;
            }
            .no-print { display: none !important; }
            .page-break { page-break-after: always; }
        }
        
        /* Typography */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .bold { font-weight: bold; }
        .small { font-size: 9px; }
        
        /* Header */
        .header {
            text-align: center;
            margin-bottom: 8px;
            padding-bottom: 5px;
        }
        .header h3 {
            font-size: 14px;
            font-weight: bold;
            margin: 2px 0;
            text-transform: uppercase;
        }
        .header p {
            font-size: 9px;
            margin: 1px 0;
        }
        
        /* Divider */
        .divider {
            border-top: 1px dashed #000;
            margin: 5px 0;
        }
        .divider-double {
            border-top: 2px solid #000;
            margin: 5px 0;
        }
        
        /* Info Section */
        .info-row {
            display: flex;
            justify-content: space-between;
            margin: 2px 0;
            font-size: 10px;
        }
        
        /* Items Table */
        .items {
            margin: 5px 0;
        }
        .item {
            margin: 3px 0;
        }
        .item-name {
            font-weight: bold;
            margin-bottom: 1px;
        }
        .item-detail {
            display: flex;
            justify-content: space-between;
            font-size: 10px;
        }
        
        /* Total Section */
        .total-section {
            margin-top: 5px;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            margin: 2px 0;
        }
        .total-row.grand {
            font-weight: bold;
            font-size: 12px;
            margin-top: 3px;
        }
        
        /* Footer */
        .footer {
            text-align: center;
            margin-top: 8px;
            font-size: 9px;
        }
        
        /* Buttons (No Print) */
        .btn-container {
            text-align: center;
            margin-top: 15px;
            padding-top: 10px;
            border-top: 2px solid #ddd;
        }
        .btn {
            display: inline-block;
            padding: 8px 15px;
            margin: 3px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 12px;
            font-family: Arial, sans-serif;
        }
        .btn-primary { background: #007bff; color: white; }
        .btn-secondary { background: #6c757d; color: white; }
        .btn-info { background: #17a2b8; color: white; }
        .btn:hover { opacity: 0.8; }
    </style>
</head>
<body>
    <!-- Header Toko -->
    <div class="header">
        <h3>{{ $toko->nama_toko ?? 'TAGEPE-DIGITAL UMKM' }}</h3>
        <p>{{ $toko->alamat ?? '' }}</p>
        <p>Telp: {{ $toko->telepon ?? '' }}</p>
        @if($toko->email)
        <p>{{ $toko->email }}</p>
        @endif
        @if($transaksi->cabang)
        <p style="margin-top:3px"><strong>{{ $transaksi->cabang->nama_cabang }}</strong></p>
        <p class="small">{{ $transaksi->cabang->alamat }}</p>
        @endif
    </div>
    
    <div class="divider"></div>
    
    <!-- Info Transaksi -->
    <div>
        <div class="info-row">
            <span>No</span>
            <span class="bold">{{ $transaksi->kode_transaksi }}</span>
        </div>
        <div class="info-row">
            <span>Tanggal</span>
            <span>{{ $transaksi->tanggal->format('d/m/Y H:i') }}</span>
        </div>
        @if($transaksi->cabang)
        <div class="info-row">
            <span>Cabang</span>
            <span>{{ $transaksi->cabang->kode_cabang }}</span>
        </div>
        @endif
    </div>
    
    <div class="divider"></div>
    
    <!-- Items -->
    <div class="items">
        @foreach($transaksi->details as $detail)
        <div class="item">
            <div class="item-name">{{ $detail->produk->nama }}</div>
            <div class="item-detail">
                <span>{{ $detail->jumlah }} x {{ number_format($detail->harga, 0, ',', '.') }}</span>
                <span class="bold">{{ number_format($detail->subtotal, 0, ',', '.') }}</span>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="divider"></div>
    
    <!-- Total -->
    <div class="total-section">
        <div class="total-row grand">
            <span>TOTAL</span>
            <span>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</span>
        </div>
        <div class="total-row">
            <span>Bayar</span>
            <span>Rp {{ number_format($transaksi->bayar, 0, ',', '.') }}</span>
        </div>
        <div class="total-row">
            <span>Kembalian</span>
            <span>Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}</span>
        </div>
    </div>
    
    <div class="divider-double"></div>
    
    <!-- Footer -->
    <div class="footer">
        <p style="margin:5px 0"><strong>TERIMA KASIH</strong></p>
        <p>Barang yang sudah dibeli</p>
        <p>tidak dapat ditukar/dikembalikan</p>
        <p style="margin-top:5px">{{ now()->format('d/m/Y H:i:s') }}</p>
    </div>
    
    <!-- Buttons (No Print) -->
    <div class="btn-container no-print">
        <button onclick="window.print()" class="btn btn-primary">🖨️ Print Browser</button>
        <button onclick="printBluetooth()" class="btn btn-primary" style="background:#6f42c1" id="btnBluetooth">📱 Print Bluetooth</button>
        <button onclick="downloadStruk()" class="btn btn-info" style="background:#28a745">💾 Download Struk</button>
        <button onclick="copyStruk()" class="btn btn-info" style="background:#17a2b8">📋 Copy Text</button>
        <button onclick="testConnection()" class="btn btn-info" style="background:#ffc107; color:#000">🔍 Test Printer</button>
        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">🛒 Transaksi Baru</a>
    </div>
    
    <div class="no-print" style="margin-top:10px; padding:10px; background:#d1ecf1; border:1px solid #0c5460; border-radius:5px; font-family:Arial; font-size:11px;">
        <strong>📱 Printer Thermu Detected!</strong>
        <p style="margin:5px 0">Untuk printer Thermu, gunakan metode ini (pilih salah satu):</p>
        <ol style="margin:5px 0; padding-left:20px;">
            <li><strong>Print Browser</strong> - Pastikan printer sudah paired & driver terinstall</li>
            <li><strong>Download Struk</strong> - Download .txt lalu print dari Notepad</li>
            <li><strong>Aplikasi Thermu</strong> - Jika punya aplikasi Thermu, gunakan fitur "Print from Browser"</li>
        </ol>
        <p style="margin:5px 0; color:#0c5460"><strong>💡 Tips:</strong> Jika Print Browser tidak muncul printer, install driver Generic Text Printer atau download driver dari thermu.com</p>
        <a href="/PANDUAN_PRINT_THERMU.md" target="_blank" style="color:#0c5460; text-decoration:underline">📖 Baca Panduan Lengkap Print Thermu</a>
    </div>
    
    <div class="no-print" style="margin-top:10px; padding:10px; background:#fff3cd; border:1px solid #ffc107; border-radius:5px; font-family:Arial; font-size:11px;">
        <strong>⚠️ Bluetooth Tidak Bisa Connect?</strong>
        <p style="margin:5px 0">Gunakan salah satu metode alternatif:</p>
        <ol style="margin:5px 0; padding-left:20px;">
            <li><strong>Print Browser</strong> - Pilih printer Bluetooth dari dialog print Windows</li>
            <li><strong>Download Struk</strong> - Download file .txt lalu print manual</li>
            <li><strong>Copy Text</strong> - Copy text struk lalu paste ke Notepad dan print</li>
        </ol>
    </div>
    
    <script>
        // ESC/POS Commands
        const ESC = '\x1B';
        const GS = '\x1D';
        
        // ESC/POS Helper Functions
        function initPrinter() {
            return ESC + '@'; // Initialize printer
        }
        
        function alignCenter() {
            return ESC + 'a' + '\x01';
        }
        
        function alignLeft() {
            return ESC + 'a' + '\x00';
        }
        
        function alignRight() {
            return ESC + 'a' + '\x02';
        }
        
        function bold(enable = true) {
            return ESC + 'E' + (enable ? '\x01' : '\x00');
        }
        
        function fontSize(size = 0) {
            // size: 0=normal, 1=2x height, 16=2x width, 17=2x both
            return GS + '!' + String.fromCharCode(size);
        }
        
        function feedLine(lines = 1) {
            return ESC + 'd' + String.fromCharCode(lines);
        }
        
        function cutPaper() {
            return GS + 'V' + '\x41' + '\x00'; // Partial cut
        }
        
        function printLine(text, width = 32) {
            return text.padEnd(width, ' ') + '\n';
        }
        
        function printDivider(char = '-', width = 32) {
            return char.repeat(width) + '\n';
        }
        
        function printRow(left, right, width = 32) {
            const spaces = width - left.length - right.length;
            return left + ' '.repeat(Math.max(0, spaces)) + right + '\n';
        }
        
        // Generate ESC/POS receipt
        function generateReceipt() {
            let receipt = '';
            
            // Initialize
            receipt += initPrinter();
            
            // Header
            receipt += alignCenter();
            receipt += fontSize(17); // 2x size
            receipt += bold(true);
            receipt += '{{ $toko->nama_toko ?? "TAGEPE-DIGITAL UMKM" }}\n';
            receipt += fontSize(0);
            receipt += bold(false);
            receipt += '{{ $toko->alamat ?? "" }}\n';
            receipt += 'Telp: {{ $toko->telepon ?? "" }}\n';
            @if($toko->email)
            receipt += '{{ $toko->email }}\n';
            @endif
            @if($transaksi->cabang)
            receipt += bold(true);
            receipt += '{{ $transaksi->cabang->nama_cabang }}\n';
            receipt += bold(false);
            receipt += '{{ $transaksi->cabang->alamat }}\n';
            @endif
            
            receipt += printDivider('=');
            
            // Transaction Info
            receipt += alignLeft();
            receipt += printRow('No', '{{ $transaksi->kode_transaksi }}');
            receipt += printRow('Tanggal', '{{ $transaksi->tanggal->format("d/m/Y H:i") }}');
            @if($transaksi->cabang)
            receipt += printRow('Cabang', '{{ $transaksi->cabang->kode_cabang }}');
            @endif
            receipt += printRow('Kasir', '{{ $transaksi->kasir }}');
            
            receipt += printDivider('-');
            
            // Items
            @foreach($transaksi->details as $detail)
            receipt += bold(true);
            receipt += '{{ $detail->produk->nama }}\n';
            receipt += bold(false);
            receipt += printRow(
                '{{ $detail->jumlah }} x {{ number_format($detail->harga, 0, ",", ".") }}',
                '{{ number_format($detail->subtotal, 0, ",", ".") }}'
            );
            @endforeach
            
            receipt += printDivider('-');
            
            // Total
            receipt += bold(true);
            receipt += fontSize(1); // 2x height
            receipt += printRow('TOTAL', 'Rp {{ number_format($transaksi->total, 0, ",", ".") }}');
            receipt += fontSize(0);
            receipt += bold(false);
            receipt += printRow('Bayar', 'Rp {{ number_format($transaksi->bayar, 0, ",", ".") }}');
            receipt += printRow('Kembalian', 'Rp {{ number_format($transaksi->kembalian, 0, ",", ".") }}');
            
            receipt += printDivider('=');
            
            // Footer
            receipt += alignCenter();
            receipt += bold(true);
            receipt += 'TERIMA KASIH\n';
            receipt += bold(false);
            receipt += 'Barang yang sudah dibeli\n';
            receipt += 'tidak dapat ditukar/dikembalikan\n';
            receipt += feedLine(1);
            receipt += '{{ now()->format("d/m/Y H:i:s") }}\n';
            
            receipt += feedLine(3);
            receipt += cutPaper();
            
            return receipt;
        }
        
        // Common Bluetooth Service UUIDs for thermal printers
        const PRINTER_SERVICES = [
            '000018f0-0000-1000-8000-00805f9b34fb', // Standard printer service
            '49535343-fe7d-4ae5-8fa9-9fafd205e455', // Alternative service (common in Chinese printers)
            'e7810a71-73ae-499d-8c15-faa9aef0c3f2', // Another common service
            '0000fff0-0000-1000-8000-00805f9b34fb', // Generic service
        ];
        
        const PRINTER_CHARACTERISTICS = [
            '00002af1-0000-1000-8000-00805f9b34fb', // Standard characteristic
            '49535343-8841-43f4-a8d4-ecbe34729bb3', // Alternative characteristic
            'bef8d6c9-9c21-4c9e-b632-bd58c1009f9f', // Another common characteristic
            '0000fff2-0000-1000-8000-00805f9b34fb', // Generic write characteristic
        ];
        
        // Print via Bluetooth - Improved version
        async function printBluetooth() {
            const btnBluetooth = document.getElementById('btnBluetooth');
            const originalText = btnBluetooth.innerHTML;
            
            try {
                // Check if Web Bluetooth is supported
                if (!navigator.bluetooth) {
                    alert('❌ Browser ini tidak support Bluetooth.\n\n' +
                          'Solusi:\n' +
                          '1. Gunakan Chrome/Edge (bukan Firefox/Safari)\n' +
                          '2. Atau gunakan Print Browser untuk printer USB');
                    return;
                }
                
                btnBluetooth.innerHTML = '🔍 Mencari printer...';
                btnBluetooth.disabled = true;
                
                console.log('Requesting Bluetooth device...');
                
                // Request device with filters for better compatibility
                const device = await navigator.bluetooth.requestDevice({
                    filters: [
                        { services: PRINTER_SERVICES },
                        { namePrefix: 'MTP' },
                        { namePrefix: 'BlueTooth Printer' },
                        { namePrefix: 'Printer' },
                        { namePrefix: 'POS' },
                        { namePrefix: 'RPP' },
                        { namePrefix: 'InnerPrinter' },
                    ],
                    optionalServices: PRINTER_SERVICES
                });
                
                console.log('✓ Device selected:', device.name);
                btnBluetooth.innerHTML = '🔗 Menghubungkan...';
                
                // Connect to GATT server
                const server = await device.gatt.connect();
                console.log('✓ Connected to GATT server');
                
                btnBluetooth.innerHTML = '🔍 Mencari service...';
                
                // Try to find working service and characteristic
                let characteristic = null;
                
                for (const serviceUuid of PRINTER_SERVICES) {
                    try {
                        console.log('Trying service:', serviceUuid);
                        const service = await server.getPrimaryService(serviceUuid);
                        console.log('✓ Service found:', serviceUuid);
                        
                        // Try to find working characteristic
                        for (const charUuid of PRINTER_CHARACTERISTICS) {
                            try {
                                characteristic = await service.getCharacteristic(charUuid);
                                console.log('✓ Characteristic found:', charUuid);
                                break;
                            } catch (e) {
                                console.log('✗ Characteristic not found:', charUuid);
                            }
                        }
                        
                        if (characteristic) break;
                        
                    } catch (e) {
                        console.log('✗ Service not found:', serviceUuid);
                    }
                }
                
                if (!characteristic) {
                    throw new Error('Tidak dapat menemukan service printer yang kompatibel.\n\n' +
                                  'Pastikan ini printer thermal yang support ESC/POS.');
                }
                
                btnBluetooth.innerHTML = '📄 Mengirim data...';
                
                // Generate receipt
                const receipt = generateReceipt();
                
                // Convert to bytes
                const encoder = new TextEncoder();
                const data = encoder.encode(receipt);
                
                console.log('Sending', data.length, 'bytes to printer...');
                
                // Send data in chunks (20 bytes for better compatibility)
                const chunkSize = 20;
                let sentBytes = 0;
                
                for (let i = 0; i < data.length; i += chunkSize) {
                    const chunk = data.slice(i, Math.min(i + chunkSize, data.length));
                    await characteristic.writeValueWithoutResponse(chunk);
                    sentBytes += chunk.length;
                    
                    // Update progress
                    const progress = Math.round((sentBytes / data.length) * 100);
                    btnBluetooth.innerHTML = `📄 Mengirim ${progress}%...`;
                    
                    // Small delay between chunks
                    await new Promise(resolve => setTimeout(resolve, 50));
                }
                
                console.log('✓ Print completed successfully');
                
                btnBluetooth.innerHTML = '✅ Berhasil!';
                setTimeout(() => {
                    btnBluetooth.innerHTML = originalText;
                    btnBluetooth.disabled = false;
                }, 2000);
                
                alert('✅ Struk berhasil dicetak via Bluetooth!');
                
                // Disconnect after delay
                setTimeout(() => {
                    device.gatt.disconnect();
                    console.log('Disconnected from printer');
                }, 1000);
                
            } catch (error) {
                console.error('Bluetooth print error:', error);
                
                btnBluetooth.innerHTML = originalText;
                btnBluetooth.disabled = false;
                
                let errorMsg = '❌ Gagal cetak via Bluetooth\n\n';
                
                if (error.name === 'NotFoundError') {
                    errorMsg += 'Printer tidak ditemukan atau tidak dipilih.\n\n' +
                               'Solusi:\n' +
                               '1. Pastikan printer sudah ON\n' +
                               '2. Pastikan printer sudah paired di Windows\n' +
                               '3. Coba "Test Printer" dulu';
                } else if (error.name === 'SecurityError') {
                    errorMsg += 'Akses Bluetooth ditolak.\n\n' +
                               'Solusi:\n' +
                               '1. Gunakan HTTPS atau localhost\n' +
                               '2. Izinkan akses Bluetooth di browser';
                } else if (error.name === 'NetworkError') {
                    errorMsg += 'Koneksi gagal.\n\n' +
                               'Solusi:\n' +
                               '1. Restart printer\n' +
                               '2. Unpair dan pair ulang di Windows\n' +
                               '3. Pastikan jarak < 10 meter\n' +
                               '4. Coba tutup aplikasi lain yang pakai printer';
                } else if (error.message.includes('service')) {
                    errorMsg += 'Printer tidak kompatibel.\n\n' +
                               'Solusi:\n' +
                               '1. Pastikan ini printer thermal ESC/POS\n' +
                               '2. Coba gunakan Print Browser\n' +
                               '3. Update firmware printer jika ada';
                } else {
                    errorMsg += 'Error: ' + error.message + '\n\n' +
                               'Solusi:\n' +
                               '1. Coba "Test Printer" dulu\n' +
                               '2. Restart printer dan browser\n' +
                               '3. Gunakan Print Browser sebagai alternatif';
                }
                
                alert(errorMsg);
            }
        }
        
        // Test printer connection
        async function testConnection() {
            try {
                if (!navigator.bluetooth) {
                    alert('❌ Browser ini tidak support Bluetooth.\n\n' +
                          'Gunakan Chrome atau Edge (bukan Firefox/Safari).');
                    return;
                }
                
                console.log('Testing Bluetooth connection...');
                
                const device = await navigator.bluetooth.requestDevice({
                    filters: [
                        { services: PRINTER_SERVICES },
                        { namePrefix: 'MTP' },
                        { namePrefix: 'BlueTooth Printer' },
                        { namePrefix: 'Printer' },
                        { namePrefix: 'POS' },
                        { namePrefix: 'RPP' },
                        { namePrefix: 'InnerPrinter' },
                    ],
                    optionalServices: PRINTER_SERVICES
                });
                
                console.log('Device selected:', device.name);
                
                const server = await device.gatt.connect();
                console.log('Connected to GATT server');
                
                // Try to find services
                const services = await server.getPrimaryServices();
                console.log('Available services:', services.length);
                
                let foundPrinterService = false;
                for (const service of services) {
                    console.log('Service UUID:', service.uuid);
                    if (PRINTER_SERVICES.includes(service.uuid)) {
                        foundPrinterService = true;
                        
                        // Try to get characteristics
                        const characteristics = await service.getCharacteristics();
                        console.log('Characteristics:', characteristics.length);
                        for (const char of characteristics) {
                            console.log('- Characteristic UUID:', char.uuid);
                        }
                    }
                }
                
                device.gatt.disconnect();
                
                if (foundPrinterService) {
                    alert('✅ Test Berhasil!\n\n' +
                          'Printer: ' + device.name + '\n' +
                          'Status: Kompatibel\n\n' +
                          'Sekarang coba Print Bluetooth!');
                } else {
                    alert('⚠️ Printer Ditemukan\n\n' +
                          'Printer: ' + device.name + '\n' +
                          'Status: Mungkin tidak kompatibel\n\n' +
                          'Coba Print Bluetooth atau gunakan Print Browser.');
                }
                
            } catch (error) {
                console.error('Test error:', error);
                
                if (error.name === 'NotFoundError') {
                    alert('❌ Tidak ada printer dipilih.\n\n' +
                          'Pastikan printer sudah ON dan paired.');
                } else {
                    alert('❌ Test gagal: ' + error.message + '\n\n' +
                          'Coba restart printer dan browser.');
                }
            }
        }
        
        // Generate plain text receipt (for download/copy)
        function generatePlainTextReceipt() {
            let text = '';
            const width = 32;
            const divider = '='.repeat(width);
            const dividerDash = '-'.repeat(width);
            
            // Header
            text += '{{ $toko->nama_toko ?? "TAGEPE-DIGITAL UMKM" }}'.padStart((width + '{{ $toko->nama_toko ?? "TAGEPE-DIGITAL UMKM" }}'.length) / 2).padEnd(width) + '\n';
            text += '{{ $toko->alamat ?? "" }}'.padStart((width + '{{ $toko->alamat ?? "" }}'.length) / 2).padEnd(width) + '\n';
            text += 'Telp: {{ $toko->telepon ?? "" }}'.padStart((width + 'Telp: {{ $toko->telepon ?? "" }}'.length) / 2).padEnd(width) + '\n';
            @if($toko->email)
            text += '{{ $toko->email }}'.padStart((width + '{{ $toko->email }}'.length) / 2).padEnd(width) + '\n';
            @endif
            @if($transaksi->cabang)
            text += '{{ $transaksi->cabang->nama_cabang }}'.padStart((width + '{{ $transaksi->cabang->nama_cabang }}'.length) / 2).padEnd(width) + '\n';
            @endif
            text += divider + '\n';
            
            // Transaction info
            text += printRow('No', '{{ $transaksi->kode_transaksi }}', width);
            text += printRow('Tanggal', '{{ $transaksi->tanggal->format("d/m/Y H:i") }}', width);
            @if($transaksi->cabang)
            text += printRow('Cabang', '{{ $transaksi->cabang->kode_cabang }}', width);
            @endif
            text += printRow('Kasir', '{{ $transaksi->kasir }}', width);
            text += dividerDash + '\n';
            
            // Items
            @foreach($transaksi->details as $detail)
            text += '{{ $detail->produk->nama }}\n';
            text += printRow(
                '{{ $detail->jumlah }} x {{ number_format($detail->harga, 0, ",", ".") }}',
                '{{ number_format($detail->subtotal, 0, ",", ".") }}',
                width
            );
            @endforeach
            text += dividerDash + '\n';
            
            // Total
            text += printRow('TOTAL', 'Rp {{ number_format($transaksi->total, 0, ",", ".") }}', width);
            text += printRow('Bayar', 'Rp {{ number_format($transaksi->bayar, 0, ",", ".") }}', width);
            text += printRow('Kembalian', 'Rp {{ number_format($transaksi->kembalian, 0, ",", ".") }}', width);
            text += divider + '\n';
            
            // Footer
            text += 'TERIMA KASIH'.padStart((width + 'TERIMA KASIH'.length) / 2).padEnd(width) + '\n';
            text += 'Barang yang sudah dibeli'.padStart((width + 'Barang yang sudah dibeli'.length) / 2).padEnd(width) + '\n';
            text += 'tidak dapat ditukar/dikembalikan'.padStart((width + 'tidak dapat ditukar/dikembalikan'.length) / 2).padEnd(width) + '\n';
            text += '\n';
            text += '{{ now()->format("d/m/Y H:i:s") }}'.padStart((width + '{{ now()->format("d/m/Y H:i:s") }}'.length) / 2).padEnd(width) + '\n';
            
            return text;
        }
        
        // Download struk as text file
        function downloadStruk() {
            const text = generatePlainTextReceipt();
            const blob = new Blob([text], { type: 'text/plain;charset=utf-8' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'Struk-{{ $transaksi->kode_transaksi }}.txt';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
            
            alert('✅ Struk berhasil didownload!\n\nBuka file .txt dan print ke printer Bluetooth Anda.');
        }
        
        // Copy struk to clipboard
        async function copyStruk() {
            try {
                const text = generatePlainTextReceipt();
                await navigator.clipboard.writeText(text);
                alert('✅ Struk berhasil dicopy!\n\nPaste ke Notepad atau aplikasi lain, lalu print ke printer Bluetooth.');
            } catch (error) {
                alert('❌ Gagal copy: ' + error.message);
            }
        }
        
        // Helper function for plain text
        function printRow(left, right, width = 32) {
            const spaces = width - left.length - right.length;
            return left + ' '.repeat(Math.max(0, spaces)) + right + '\n';
        }
        
        // Auto print saat halaman load (uncomment jika ingin auto print)
        // window.onload = function() {
        //     setTimeout(function() {
        //         window.print();
        //     }, 500);
        // }
        
        // Redirect setelah print (optional)
        window.onafterprint = function() {
            // window.location.href = "{{ route('transaksi.index') }}";
        }
    </script>
</body>
</html>
