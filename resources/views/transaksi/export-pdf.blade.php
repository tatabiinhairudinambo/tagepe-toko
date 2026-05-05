<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; }
        .header { text-align:center; padding: 20px 0 10px; border-bottom: 2px solid #333; margin-bottom: 15px; }
        .header h2 { font-size: 18px; margin-bottom: 4px; }
        .header p { font-size: 11px; color: #666; }
        .info-row { display:flex; justify-content:space-between; margin-bottom: 15px; font-size: 11px; }
        .total-box { background: #f0f4f8; padding: 10px 15px; border-radius: 6px; margin-bottom: 15px; }
        .total-box strong { font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background: #2c3e50; color: white; padding: 8px 6px; text-align: left; font-size: 11px; }
        td { padding: 7px 6px; border-bottom: 1px solid #e9ecef; font-size: 11px; }
        tr:nth-child(even) { background: #f8f9fa; }
        .footer { text-align: center; font-size: 10px; color: #999; margin-top: 20px; padding-top: 10px; border-top: 1px solid #ddd; }
        .no-print { text-align:center; padding: 15px; }
        .btn { display:inline-block; padding: 8px 20px; margin: 5px; border:none; border-radius:6px; cursor:pointer; font-size:13px; text-decoration:none; }
        .btn-primary { background:#3498db; color:white; }
        .btn-secondary { background:#6c757d; color:white; }
        @media print {
            .no-print { display:none; }
            body { font-size: 11px; }
        }
    </style>
</head>
<body>

<div class="no-print">
    <button onclick="window.print()" class="btn btn-primary">🖨️ Cetak / Save PDF</button>
    <a href="{{ route('transaksi.laporan') }}" class="btn btn-secondary">← Kembali</a>
</div>

<div class="header">
    <h2>{{ $toko->nama_toko ?? 'TAGEPE TOKO' }}</h2>
    <p>{{ $toko->alamat ?? '' }} | {{ $toko->telepon ?? '' }}</p>
    <h3 style="margin-top:8px;font-size:15px">LAPORAN TRANSAKSI</h3>
</div>

<div class="info-row">
    <span>
        Periode:
        <strong>
            {{ $request->tanggal_dari ? \Carbon\Carbon::parse($request->tanggal_dari)->format('d/m/Y') : 'Semua' }}
            —
            {{ $request->tanggal_sampai ? \Carbon\Carbon::parse($request->tanggal_sampai)->format('d/m/Y') : 'Semua' }}
        </strong>
    </span>
    <span>Dicetak: <strong>{{ now()->format('d/m/Y H:i') }}</strong></span>
</div>

<div class="total-box">
    Total Pendapatan: <strong>Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</strong>
    &nbsp;&nbsp;|&nbsp;&nbsp;
    Jumlah Transaksi: <strong>{{ $transaksis->count() }}</strong>
</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Transaksi</th>
            <th>Tanggal</th>
            <th>Cabang</th>
            <th>Kasir</th>
            <th>Total</th>
            <th>Bayar</th>
            <th>Kembalian</th>
        </tr>
    </thead>
    <tbody>
        @forelse($transaksis as $i => $t)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td><strong>{{ $t->kode_transaksi }}</strong></td>
            <td>{{ $t->tanggal->format('d/m/Y H:i') }}</td>
            <td>{{ $t->cabang->nama_cabang ?? '-' }}</td>
            <td>{{ $t->kasir }}</td>
            <td>Rp {{ number_format($t->total, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($t->bayar, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($t->kembalian, 0, ',', '.') }}</td>
        </tr>
        @empty
        <tr><td colspan="8" style="text-align:center;color:#999">Tidak ada data</td></tr>
        @endforelse
    </tbody>
</table>

<div class="footer">
    Laporan ini digenerate otomatis oleh sistem {{ $toko->nama_toko ?? 'Tagepe Toko' }} pada {{ now()->format('d/m/Y H:i:s') }}
</div>

</body>
</html>
