<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Order - Tagepe Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; }
        .card { border-radius: 24px; border: none; }
        .search-input {
            border-radius: 12px 0 0 12px;
            border: 2px solid #e8ecff;
            border-right: none;
            padding: 12px 16px;
            font-size: .9rem;
        }
        .search-input:focus { border-color: #667eea; box-shadow: none; }
        .search-btn {
            border-radius: 0 12px 12px 0;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            padding: 12px 20px;
            color: white;
            font-weight: 600;
        }
        .status-timeline { position: relative; padding-left: 30px; }
        .status-timeline::before {
            content: '';
            position: absolute;
            left: 10px; top: 0; bottom: 0;
            width: 2px;
            background: #e8ecff;
        }
        .timeline-item { position: relative; margin-bottom: 16px; }
        .timeline-dot {
            position: absolute;
            left: -24px; top: 2px;
            width: 16px; height: 16px;
            border-radius: 50%;
            background: #e8ecff;
            border: 2px solid white;
        }
        .timeline-dot.active { background: linear-gradient(135deg, #667eea, #764ba2); }
    </style>
</head>
<body>
<div class="container py-4">
    <div class="card shadow-lg mx-auto" style="max-width:500px">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <div style="font-size:2.5rem">🔍</div>
                <h5 class="fw-bold mb-1">Cek Status Order</h5>
                <p class="text-muted small">Masukkan kode order yang kamu terima</p>
            </div>

            <form method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="kode" class="form-control search-input"
                           placeholder="Contoh: ORD-20260507-0001"
                           value="{{ request('kode') }}">
                    <button class="search-btn" type="submit">Cek</button>
                </div>
            </form>

            @if(request('kode') && !$order)
                <div class="alert alert-warning rounded-3 text-center">
                    <i class="bi bi-exclamation-circle me-2"></i>Kode order tidak ditemukan.
                </div>
            @endif

            @if($order)
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <div class="fw-bold">{{ $order->kode_order }}</div>
                        <div class="text-muted small">{{ $order->nama_customer }}</div>
                    </div>
                    @if($order->status === 'menunggu')
                        <span class="badge bg-warning text-dark px-3 py-2">⏳ Menunggu</span>
                    @elseif($order->status === 'diproses')
                        <span class="badge bg-info px-3 py-2">⚙️ Diproses</span>
                    @elseif($order->status === 'selesai')
                        <span class="badge bg-success px-3 py-2">✅ Selesai</span>
                    @else
                        <span class="badge bg-secondary px-3 py-2">❌ Batal</span>
                    @endif
                </div>

                {{-- Timeline status --}}
                <div class="status-timeline mb-4">
                    <div class="timeline-item">
                        <div class="timeline-dot active"></div>
                        <div class="small fw-semibold">Order Diterima</div>
                        <div class="text-muted" style="font-size:.75rem">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot {{ in_array($order->status, ['diproses','selesai']) ? 'active' : '' }}"></div>
                        <div class="small fw-semibold {{ !in_array($order->status, ['diproses','selesai']) ? 'text-muted' : '' }}">Sedang Diproses</div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot {{ $order->status === 'selesai' ? 'active' : '' }}"></div>
                        <div class="small fw-semibold {{ $order->status !== 'selesai' ? 'text-muted' : '' }}">Selesai & Dibayar</div>
                    </div>
                </div>

                <div class="bg-light rounded-3 p-3 mb-3">
                    @if($order->cabang)
                    <div class="d-flex justify-content-between small mb-2">
                        <span class="text-muted">Cabang</span>
                        <span class="fw-semibold">{{ $order->cabang->nama_cabang }}</span>
                    </div>
                    @endif
                    @foreach($order->details as $d)
                    <div class="d-flex justify-content-between small mb-1">
                        <span>{{ $d->produk->nama }} ×{{ $d->jumlah }}</span>
                        <span>Rp {{ number_format($d->subtotal, 0, ',', '.') }}</span>
                    </div>
                    @endforeach
                    <hr class="my-2">
                    <div class="d-flex justify-content-between small fw-bold">
                        <span>Total</span>
                        <span style="color:#667eea">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            @endif

            <div class="text-center">
                <a href="{{ route('order.index') }}" class="btn btn-sm rounded-pill px-4"
                   style="background:linear-gradient(135deg,#667eea,#764ba2);color:white">
                    <i class="bi bi-bag me-1"></i> Order Sekarang
                </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
