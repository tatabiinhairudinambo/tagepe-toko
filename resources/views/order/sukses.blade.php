<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Berhasil - Tagepe Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #6c63ff; --secondary: #ff6584; }
        * { font-family: 'Poppins', sans-serif; }
        body {
            background: #0f0f1a;
            color: #fff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .success-wrap { max-width: 480px; width: 100%; }

        /* Animasi confetti lingkaran */
        .confetti-wrap {
            position: relative;
            text-align: center;
            margin-bottom: 24px;
        }
        .success-icon {
            width: 100px; height: 100px;
            background: linear-gradient(135deg, var(--primary), #9c88ff);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 2.8rem;
            margin: 0 auto;
            box-shadow: 0 0 60px rgba(108,99,255,.5);
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { box-shadow: 0 0 40px rgba(108,99,255,.4); }
            50% { box-shadow: 0 0 80px rgba(108,99,255,.7); }
        }

        /* Card utama */
        .card-main {
            background: rgba(255,255,255,.04);
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 24px;
            overflow: hidden;
        }

        /* Kode order */
        .kode-box {
            background: linear-gradient(135deg, var(--primary), #9c88ff);
            padding: 24px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .kode-box::before {
            content: '';
            position: absolute;
            top: -30px; right: -30px;
            width: 120px; height: 120px;
            background: rgba(255,255,255,.08);
            border-radius: 50%;
        }
        .kode-box::after {
            content: '';
            position: absolute;
            bottom: -20px; left: -20px;
            width: 80px; height: 80px;
            background: rgba(255,255,255,.06);
            border-radius: 50%;
        }
        .kode-label { font-size: .75rem; color: rgba(255,255,255,.7); text-transform: uppercase; letter-spacing: 1px; }
        .kode-text {
            font-size: 1.8rem;
            font-weight: 800;
            letter-spacing: 4px;
            color: #fff;
            margin: 6px 0;
        }
        .kode-copy {
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.2);
            border-radius: 50px;
            padding: 4px 14px;
            font-size: .75rem;
            color: #fff;
            cursor: pointer;
            transition: all .2s;
        }
        .kode-copy:hover { background: rgba(255,255,255,.25); }

        /* Body card */
        .card-body-custom { padding: 24px; }

        /* Steps */
        .steps { margin-bottom: 20px; }
        .step-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            margin-bottom: 14px;
        }
        .step-num {
            width: 32px; height: 32px; min-width: 32px;
            background: linear-gradient(135deg, var(--primary), #9c88ff);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: .8rem; font-weight: 700;
        }
        .step-text { font-size: .85rem; color: rgba(255,255,255,.8); padding-top: 6px; }

        /* Detail order */
        .detail-box {
            background: rgba(255,255,255,.04);
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 14px;
            padding: 16px;
            margin-bottom: 20px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            font-size: .83rem;
            margin-bottom: 8px;
            color: rgba(255,255,255,.7);
        }
        .detail-row span:last-child { color: #fff; font-weight: 500; }
        .detail-total {
            border-top: 1px solid rgba(255,255,255,.08);
            padding-top: 10px;
            margin-top: 4px;
            display: flex;
            justify-content: space-between;
            font-weight: 700;
        }
        .detail-total span:last-child { color: var(--primary); font-size: 1.1rem; }

        /* Buttons */
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary), #9c88ff);
            border: none;
            border-radius: 14px;
            padding: 12px;
            color: #fff;
            font-weight: 600;
            font-size: .9rem;
            width: 100%;
            transition: all .2s;
        }
        .btn-primary-custom:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(108,99,255,.4); color: #fff; }
        .btn-outline-custom {
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 14px;
            padding: 12px;
            color: rgba(255,255,255,.8);
            font-weight: 500;
            font-size: .9rem;
            width: 100%;
            transition: all .2s;
        }
        .btn-outline-custom:hover { background: rgba(255,255,255,.1); color: #fff; }

        /* Alert info */
        .info-box {
            background: rgba(108,99,255,.1);
            border: 1px solid rgba(108,99,255,.3);
            border-radius: 12px;
            padding: 12px 16px;
            font-size: .82rem;
            color: rgba(255,255,255,.7);
            margin-bottom: 20px;
        }
        .info-box i { color: var(--primary); }
    </style>
</head>
<body>
<div class="success-wrap">

    {{-- Animasi sukses --}}
    <div class="confetti-wrap">
        <div class="success-icon">🎉</div>
        <h4 class="fw-bold mt-3 mb-1">Order Berhasil!</h4>
        <p style="color:rgba(255,255,255,.5);font-size:.9rem">
            Hei <strong style="color:#fff">{{ $order->nama_customer }}</strong>, pesananmu sudah masuk!
        </p>
    </div>

    <div class="card-main">
        {{-- Kode order --}}
        <div class="kode-box">
            <div class="kode-label">Kode Order Kamu</div>
            <div class="kode-text" id="kodeOrder">{{ $order->kode_order }}</div>
            <button class="kode-copy" onclick="copyKode()">
                <i class="bi bi-clipboard me-1"></i> Salin Kode
            </button>
        </div>

        <div class="card-body-custom">

            {{-- Info --}}
            <div class="info-box">
                <i class="bi bi-info-circle me-2"></i>
                Simpan kode ini dan tunjukkan ke kasir saat pembayaran.
            </div>

            {{-- Langkah --}}
            <div class="steps">
                <div class="step-item">
                    <div class="step-num">1</div>
                    <div class="step-text">Datang ke cabang <strong style="color:#fff">{{ $order->cabang->nama_cabang ?? 'terdekat' }}</strong></div>
                </div>
                <div class="step-item">
                    <div class="step-num">2</div>
                    <div class="step-text">Tunjukkan kode order ke kasir</div>
                </div>
                <div class="step-item">
                    <div class="step-num">3</div>
                    <div class="step-text">Bayar <strong style="color:#fff">Rp {{ number_format($order->total, 0, ',', '.') }}</strong> via QRIS atau tunai</div>
                </div>
            </div>

            {{-- Detail produk --}}
            <div class="detail-box">
                @foreach($order->details as $d)
                <div class="detail-row">
                    <span>{{ $d->produk->nama }} ×{{ $d->jumlah }}</span>
                    <span>Rp {{ number_format($d->subtotal, 0, ',', '.') }}</span>
                </div>
                @endforeach
                <div class="detail-total">
                    <span>Total</span>
                    <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- Buttons --}}
            <div class="d-flex flex-column gap-2">
                <a href="{{ route('order.cek') }}?kode={{ $order->kode_order }}" class="btn-outline-custom text-center text-decoration-none">
                    <i class="bi bi-search me-2"></i>Cek Status Order
                </a>
                <a href="{{ route('order.index') }}" class="btn-primary-custom text-center text-decoration-none">
                    <i class="bi bi-plus-circle me-2"></i>Order Lagi
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function copyKode() {
    const kode = document.getElementById('kodeOrder').textContent;
    navigator.clipboard.writeText(kode).then(() => {
        const btn = document.querySelector('.kode-copy');
        btn.innerHTML = '<i class="bi bi-check me-1"></i> Tersalin!';
        setTimeout(() => btn.innerHTML = '<i class="bi bi-clipboard me-1"></i> Salin Kode', 2000);
    });
}
</script>
</body>
</html>
