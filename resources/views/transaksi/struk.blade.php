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
        <h3>{{ $toko->nama_toko ?? 'TAGEPE TOKO' }}</h3>
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
        <button onclick="printBluetooth()" class="btn btn-primary" style="background:#6f42c1">📱 Print Bluetooth</button>
        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">🛒 Transaksi Baru</a>
        <a href="{{ route('transaksi.laporan') }}" class="btn btn-info">📊 Laporan</a>
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
            receipt += '{{ $toko->nama_toko ?? "TAGEPE TOKO" }}\n';
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
        
        // Print via Bluetooth
        async function printBluetooth() {
            try {
                // Check if Web Bluetooth is supported
                if (!navigator.bluetooth) {
                    alert('❌ Browser ini tidak support Bluetooth.\n\nGunakan Chrome, Edge, atau Opera di Android/Windows.');
                    return;
                }
                
                // Request Bluetooth device - use acceptAllDevices for better compatibility
                const device = await navigator.bluetooth.requestDevice({
                    acceptAllDevices: true,
                    optionalServices: [
                        '000018f0-0000-1000-8000-00805f9b34fb', // Printer service
                        '49535343-fe7d-4ae5-8fa9-9fafd205e455', // Alternative printer service
                    ]
                });
                
                console.log('Device selected:', device.name);
                
                // Add disconnect handler
                device.addEventListener('gattserverdisconnected', () => {
                    console.log('Device disconnected');
                });
                
                // Connect to GATT server
                console.log('Connecting to GATT server...');
                const server = await device.gatt.connect();
                console.log('Connected to GATT server');
                
                // Wait for connection to stabilize
                await new Promise(resolve => setTimeout(resolve, 500));
                
                // Check if still connected
                if (!server.connected) {
                    throw new Error('Connection lost immediately after connecting');
                }
                
                // Try to find printer service
                let service, characteristic;
                
                // Try first service UUID
                try {
                    service = await server.getPrimaryService('000018f0-0000-1000-8000-00805f9b34fb');
                    characteristic = await service.getCharacteristic('00002af1-0000-1000-8000-00805f9b34fb');
                    console.log('Using standard printer service');
                } catch (e) {
                    console.log('Standard service not found, trying alternative...');
                    // Try alternative service
                    try {
                        service = await server.getPrimaryService('49535343-fe7d-4ae5-8fa9-9fafd205e455');
                        characteristic = await service.getCharacteristic('49535343-8841-43f4-a8d4-ecbe34729bb3');
                        console.log('Using alternative printer service');
                    } catch (e2) {
                        throw new Error('Printer service not found. Pastikan ini printer thermal yang support ESC/POS.');
                    }
                }
                
                // Generate receipt
                const receipt = generateReceipt();
                
                // Convert to bytes
                const encoder = new TextEncoder();
                const data = encoder.encode(receipt);
                
                console.log('Sending', data.length, 'bytes...');
                
                // Send data in chunks (max 512 bytes per write)
                const chunkSize = 512;
                for (let i = 0; i < data.length; i += chunkSize) {
                    const chunk = data.slice(i, i + chunkSize);
                    await characteristic.writeValue(chunk);
                    await new Promise(resolve => setTimeout(resolve, 100)); // Delay between chunks
                    console.log('Sent chunk', Math.floor(i/chunkSize) + 1);
                }
                
                console.log('Print sent successfully');
                alert('✅ Struk berhasil dicetak via Bluetooth!');
                
                // Disconnect after a delay
                setTimeout(() => {
                    device.gatt.disconnect();
                }, 1000);
                
            } catch (error) {
                console.error('Bluetooth print error:', error);
                
                if (error.name === 'NotFoundError') {
                    alert('❌ Printer Bluetooth tidak ditemukan.\n\nPastikan printer sudah ON dan dalam mode pairing.');
                } else if (error.name === 'SecurityError') {
                    alert('❌ Akses Bluetooth ditolak.\n\nPastikan menggunakan HTTPS atau localhost.');
                } else if (error.name === 'NetworkError') {
                    alert('❌ Koneksi Bluetooth gagal.\n\nSolusi:\n1. Pastikan printer sudah ON\n2. Pastikan jarak dekat (< 10m)\n3. Coba restart printer\n4. Coba unpair dan pair ulang di Windows');
                } else {
                    alert('❌ Gagal cetak via Bluetooth:\n' + error.message + '\n\nCoba pakai Print Browser atau pastikan printer support ESC/POS.');
                }
            }
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
