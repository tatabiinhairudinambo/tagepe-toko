<!DOCTYPE html>
<html>
<head>
    <title>Struk - {{ $transaksi->kode_transaksi }}</title>
    <style>
        @media print {
            .no-print { display: none; }
        }
        body { font-family: 'Courier New', monospace; max-width: 300px; margin: 20px auto; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        table { width: 100%; border-collapse: collapse; }
        .border-top { border-top: 1px dashed #000; padding-top: 10px; margin-top: 10px; }
        .border-bottom { border-bottom: 1px dashed #000; padding-bottom: 10px; margin-bottom: 10px; }
        h3 { margin: 5px 0; }
        p { margin: 3px 0; }
    </style>
</head>
<body>
    <div class="text-center">
        <h3>{{ $toko->nama_toko ?? 'TAGEPE TOKO' }}</h3>
        <p>{{ $toko->alamat ?? '' }}</p>
        <p>Telp: {{ $toko->telepon ?? '' }}</p>
    </div>
    
    <div class="border-top border-bottom">
        <p>No: {{ $transaksi->kode_transaksi }}</p>
        <p>Tanggal: {{ $transaksi->tanggal->format('d/m/Y H:i') }}</p>
        <p>Kasir: {{ $transaksi->kasir }}</p>
    </div>
    
    <table>
        @foreach($transaksi->details as $detail)
        <tr>
            <td colspan="3">{{ $detail->produk->nama }}</td>
        </tr>
        <tr>
            <td>{{ $detail->jumlah }} x</td>
            <td class="text-right">{{ number_format($detail->harga, 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>
    
    <div class="border-top">
        <table>
            <tr>
                <td><strong>TOTAL</strong></td>
                <td class="text-right"><strong>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</strong></td>
            </tr>
            <tr>
                <td>Bayar</td>
                <td class="text-right">Rp {{ number_format($transaksi->bayar, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Kembalian</td>
                <td class="text-right">Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>
    
    <div class="text-center border-top">
        <p>Terima Kasih</p>
        <p>Barang yang sudah dibeli tidak dapat ditukar/dikembalikan</p>
    </div>
    
    <div class="text-center no-print" style="margin-top:20px">
        <button onclick="window.print()" class="btn btn-primary">Print Struk</button>
        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Transaksi Baru</a>
        <a href="{{ route('transaksi.laporan') }}" class="btn btn-info">Lihat Laporan</a>
    </div>
    
    <script>
        // Auto print saat halaman load
        window.onload = function() {
            // window.print(); // Uncomment untuk auto print
        }
    </script>
</body>
</html>
