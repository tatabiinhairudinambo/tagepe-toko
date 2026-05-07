<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Berhasil - Tagepe Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; }
        .card { border-radius: 24px; border: none; }
        .kode-box {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 16px;
            padding: 20px;
            color: white;
            text-align: center;
        }
        .kode-text { font-size: 1.8rem; font-weight: 700; letter-spacing: 3px; }
        .step { display: flex; align-items: flex-start; gap: 12px; margin-bottom: 12px; }
        .step-num {
            width: 28px; height: 28px; min-width: 28px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%; color: white;
            display: flex; align-items: center; justify-content: center;
            font-size: .8rem; font-weight: 700;
        }
    </style>
</head>
<body>
<div class="container py-4">
    <div class="card shadow-lg mx-auto" style="max-width:480px">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <div style="font-size:4rem">🎉</div>
                <h4 class="fw-bold mb-1">Order Berhasil!</h4>
                <p class="text-muted small">Hei <strong>{{ $order->nama_customer }}</strong>, pesananmu sudah masuk!</p>
            </div>

            <div class="kode-box mb-4">
                <div class="small opacity-75 mb-1">Kode Order Kamu</div>
                <div class="kode-text">{{ $order->kode_order }}</div>
                <div class="small opacity-75 mt-1">Simpan kode ini!</div>
            </div>

            <div class="mb-4">
                <div class="fw-semibold small text-muted text-uppercase mb-3" style="letter-spacing:1px">Langkah Selanjutnya</div>
                <div class="step">
                    <div class="step-num">1</div>
                    <div class="small">Tunjukkan kode order ke kasir di cabang <strong>{{ $order->cabang->nama_cabang ?? 'terdekat' }}</strong></div>
                </div>
                <div class="step">
                    <div class="step-num">2</div>
                    <div class="small">Kasir akan memproses pesananmu</div>
                </div>
                <div class="step">
                    <div class="step-num">3</div>
                    <div class="small">Lakukan pembayaran sebesar <strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong></div>
                </div>
            </div>

            <div class="bg-light rounded-3 p-3 mb-4">
                <div class="small fw-semibold mb-2">Ringkasan Pesanan</div>
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

            <div class="d-flex gap-2">
                <a href="{{ route('order.cek') }}?kode={{ $order->kode_order }}"
                   class="btn btn-outline-secondary flex-fill rounded-3">
                    <i class="bi bi-search me-1"></i> Cek Status
                </a>
                <a href="{{ route('order.index') }}"
                   class="btn flex-fill rounded-3 text-white"
                   style="background:linear-gradient(135deg,#667eea,#764ba2)">
                    <i class="bi bi-plus me-1"></i> Order Lagi
                </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
