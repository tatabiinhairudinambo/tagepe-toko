<!DOCTYPE html>
<html>
<head>
    <title>Nota - {{ $pemesanan->kode_pesan }}</title>
    <meta charset="UTF-8">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        @page { size: 58mm auto; margin: 0; }
        body {
            font-family: 'Courier New', monospace;
            font-size: 11px;
            line-height: 1.3;
            width: 58mm;
            max-width: 220px;
            margin: 0 auto;
            padding: 5px;
        }
        @media print {
            body { width:58mm; margin:0; padding:2mm; }
            .no-print { display:none !important; }
        }
        .text-center { text-align:center; }
        .bold { font-weight:bold; }
        .header { text-align:center; margin-bottom:8px; padding-bottom:5px; }
        .header h3 { font-size:14px; font-weight:bold; text-transform:uppercase; margin:2px 0; }
        .header p { font-size:9px; margin:1px 0; }
        .divider { border-top:1px dashed #000; margin:5px 0; }
        .divider-double { border-top:2px solid #000; margin:5px 0; }
        .info-row { display:flex; justify-content:space-between; margin:2px 0; font-size:10px; }
        .item { margin:3px 0; }
        .item-name { font-weight:bold; margin-bottom:1px; }
        .item-detail { display:flex; justify-content:space-between; font-size:10px; }
        .total-row { display:flex; justify-content:space-between; margin:2px 0; }
        .total-row.grand { font-weight:bold; font-size:12px; margin-top:3px; }
        .status-badge { text-align:center; font-size:10px; font-weight:bold; padding:3px; border:1px solid #000; margin:5px 0; }
        .footer { text-align:center; margin-top:8px; font-size:9px; }
        .btn-container { text-align:center; margin-top:15px; padding-top:10px; border-top:2px solid #ddd; }
        .btn { display:inline-block; padding:8px 15px; margin:3px; border:none; border-radius:4px; cursor:pointer; text-decoration:none; font-size:12px; font-family:Arial,sans-serif; }
        .btn-primary { background:#007bff; color:white; }
        .btn-secondary { background:#6c757d; color:white; }
        .btn-success { background:#28a745; color:white; }
    </style>
</head>
<body>
    <div class="header">
        <h3>{{ $toko->nama_toko ?? 'TAGEPE-DIGITAL UMKM' }}</h3>
        <p>{{ $toko->alamat ?? '' }}</p>
        <p>Telp: {{ $toko->telepon ?? '' }}</p>
        @if($pemesanan->cabang)
        <p><strong>{{ $pemesanan->cabang->nama_cabang }}</strong></p>
        @endif
    </div>

    <div class="divider"></div>

    <div class="status-badge">*** NOTA PESANAN ***</div>

    <div>
        <div class="info-row"><span>No Pesanan</span><span class="bold">{{ $pemesanan->kode_pesan }}</span></div>
        <div class="info-row"><span>Tanggal</span><span>{{ $pemesanan->created_at->format('d/m/Y H:i') }}</span></div>
        <div class="info-row"><span>Kasir</span><span>{{ $pemesanan->kasir }}</span></div>
        @if($pemesanan->nama_pelanggan)
        <div class="info-row"><span>Pelanggan</span><span>{{ $pemesanan->nama_pelanggan }}</span></div>
        @endif
        <div class="info-row">
            <span>Status</span>
            <span class="bold">{{ strtoupper($pemesanan->status) }}</span>
        </div>
    </div>

    <div class="divider"></div>

    <div>
        @foreach($pemesanan->details as $detail)
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

    <div class="total-row grand">
        <span>TOTAL</span>
        <span>Rp {{ number_format($pemesanan->total, 0, ',', '.') }}</span>
    </div>

    @if($pemesanan->status === 'pending')
    <div class="divider"></div>
    <div class="text-center" style="font-size:9px">Pesanan belum dibayar</div>
    @endif

    <div class="divider-double"></div>

    <div class="footer">
        <p><strong>TERIMA KASIH</strong></p>
        <p>{{ now()->format('d/m/Y H:i:s') }}</p>
    </div>

    <div class="btn-container no-print">
        <button onclick="window.print()" class="btn btn-primary">🖨️ Cetak Nota</button>
        <a href="{{ route('pemesanan.index') }}" class="btn btn-secondary">← Kembali</a>
        @if($pemesanan->status === 'pending')
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#bayarModal">💰 Bayar</button>
        @endif
    </div>

    @if($pemesanan->status === 'pending')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <div class="modal fade" id="bayarModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('pemesanan.bayar', $pemesanan->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <div class="modal-body">
                        <p>Total: <strong>Rp {{ number_format($pemesanan->total, 0, ',', '.') }}</strong></p>
                        <div class="mb-3">
                            <label class="form-label">Uang Bayar</label>
                            <input type="number" name="bayar" class="form-control" min="{{ $pemesanan->total }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Konfirmasi Bayar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endif
</body>
</html>
