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
            <div class="item-name">{{ $detail->produk->nama_produk }}</div>
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
        <button onclick="window.print()" class="btn btn-primary">🖨️ Print Struk</button>
        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">🛒 Transaksi Baru</a>
        <a href="{{ route('transaksi.laporan') }}" class="btn btn-info">📊 Laporan</a>
    </div>
    
    <script>
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
