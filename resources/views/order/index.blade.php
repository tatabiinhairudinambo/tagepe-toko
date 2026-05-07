<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Online - Tagepe Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        body { background: #f8f9ff; }

        /* Hero */
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 50px 0 80px;
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: -50%; left: -50%;
            width: 200%; height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,.05) 0%, transparent 60%);
        }
        .hero h1 { font-size: 2.2rem; font-weight: 700; color: white; }
        .hero p { color: rgba(255,255,255,.8); font-size: 1rem; }

        /* Navbar */
        .top-nav {
            background: rgba(255,255,255,.15);
            backdrop-filter: blur(10px);
            padding: 12px 0;
        }
        .top-nav .brand { color: white; font-weight: 700; font-size: 1.2rem; }

        /* Cards produk */
        .produk-card {
            border-radius: 16px;
            border: 2px solid transparent;
            cursor: pointer;
            transition: all .2s;
            overflow: hidden;
        }
        .produk-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(102,126,234,.2);
            border-color: #667eea;
        }
        .produk-card.selected {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102,126,234,.2);
        }
        .produk-card .foto {
            height: 160px;
            overflow: hidden;
            background: linear-gradient(135deg, #f0f4ff, #e8ecff);
        }
        .produk-card .foto img { width:100%; height:100%; object-fit:cover; }
        .produk-card .foto .no-foto {
            display: flex; align-items: center; justify-content: center;
            height: 100%; font-size: 3rem; color: #c5cae9;
        }
        .harga { color: #667eea; font-weight: 700; }
        .badge-stok { font-size: .7rem; }

        /* Cart */
        .cart-panel {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(102,126,234,.15);
            position: sticky;
            top: 20px;
        }
        .cart-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 20px 20px 0 0;
            padding: 16px 20px;
            color: white;
        }
        .cart-item {
            background: #f8f9ff;
            border-radius: 10px;
            padding: 10px 12px;
            margin-bottom: 8px;
        }
        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: opacity .2s;
        }
        .btn-primary-custom:hover { opacity: .9; color: white; }
        .btn-primary-custom:disabled { opacity: .5; }

        /* Search */
        .search-box {
            background: white;
            border-radius: 50px;
            padding: 10px 20px;
            border: 2px solid #e8ecff;
            display: flex;
            align-items: center;
            gap: 10px;
            max-width: 400px;
        }
        .search-box input {
            border: none;
            outline: none;
            flex: 1;
            font-size: .9rem;
        }

        /* Section */
        .section-wrap {
            margin-top: -40px;
            position: relative;
            z-index: 10;
        }

        /* Form */
        .form-control-custom {
            border-radius: 10px;
            border: 2px solid #e8ecff;
            padding: 10px 14px;
            font-size: .9rem;
            transition: border-color .2s;
        }
        .form-control-custom:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102,126,234,.1);
        }

        /* Total */
        .total-box {
            background: linear-gradient(135deg, #f0f4ff, #e8ecff);
            border-radius: 12px;
            padding: 12px 16px;
        }

        @media (max-width: 768px) {
            .hero h1 { font-size: 1.5rem; }
            .hero { padding: 30px 0 60px; }
        }
    </style>
</head>
<body>

{{-- Navbar --}}
<div class="top-nav" style="background:linear-gradient(135deg,#667eea,#764ba2)">
    <div class="container d-flex justify-content-between align-items-center">
        <span class="brand"><i class="bi bi-bag-heart-fill me-2"></i>Tagepe Toko</span>
        <div class="d-flex gap-2">
            <a href="{{ route('order.cek') }}" class="btn btn-sm btn-light rounded-pill">
                <i class="bi bi-search me-1"></i> Cek Order
            </a>
            <a href="{{ route('katalog') }}" class="btn btn-sm btn-outline-light rounded-pill">
                <i class="bi bi-grid me-1"></i> Katalog
            </a>
        </div>
    </div>
</div>

{{-- Hero --}}
<div class="hero">
    <div class="container text-center">
        <h1>🛍️ Pesan Sekarang, Bayar via QRIS / di Kasir!</h1>
        <p>Pilih produk favoritmu, isi data, dan tunjukkan kode order ke kasir.</p>
        <div class="d-flex justify-content-center mt-3">
            <form action="{{ route('order.cari') }}" method="GET" class="search-box">
                <i class="bi bi-search text-muted"></i>
                <input type="text" name="search" placeholder="Cari produk..." value="{{ $search ?? '' }}" autocomplete="off">
                <button type="submit" class="btn btn-sm px-3 rounded-pill text-white" style="background:linear-gradient(135deg,#667eea,#764ba2);border:none">Cari</button>
            </form>
        </div>
        @if(isset($search) && $search)
        <div class="mt-2">
            <span class="badge bg-white text-primary px-3 py-2">
                Hasil: "{{ $search }}" — {{ $produks->count() }} produk
                <a href="{{ route('order.index') }}" class="ms-2 text-muted">✕</a>
            </span>
        </div>
        @endif
    </div>
</div>

{{-- Content --}}
<div class="container section-wrap pb-5">
    @if(session('error'))
        <div class="alert alert-danger rounded-3 mb-4">{{ session('error') }}</div>
    @endif

    <div class="row g-4">
        {{-- Produk --}}
        <div class="col-lg-8">
            <div class="bg-white rounded-4 shadow-sm p-4">
                <h6 class="fw-bold mb-3 text-muted text-uppercase" style="letter-spacing:1px;font-size:.75rem">
                    Pilih Produk
                </h6>
                <div class="row g-3" id="produkList">
                    @forelse($produks as $produk)
                    @php
                        $foto = $produk->foto
                            ? (str_starts_with($produk->foto,'http') ? $produk->foto : asset('storage/'.$produk->foto))
                            : null;
                    @endphp
                    <div class="col-6 col-md-4 produk-col">
                        <div class="card border-0 produk-card h-100"
                             data-id="{{ $produk->id }}"
                             data-nama="{{ $produk->nama }}"
                             data-harga="{{ $produk->harga }}"
                             data-stok="{{ $produk->stok }}"
                             onclick="tambahKeranjang(this)">
                            <div class="foto">
                                @if($foto)
                                    <img src="{{ $foto }}" alt="{{ $produk->nama }}">
                                @else
                                    <div class="no-foto"><i class="bi bi-bag"></i></div>
                                @endif
                            </div>
                            <div class="card-body p-3">
                                <div class="fw-semibold mb-1" style="font-size:.85rem;line-height:1.3">{{ $produk->nama }}</div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="harga" style="font-size:.85rem">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                    <span class="badge {{ $produk->stok > 5 ? 'bg-success' : 'bg-warning text-dark' }} badge-stok">
                                        Stok {{ $produk->stok }}
                                    </span>
                                </div>
                                <div class="text-muted small mt-1">{{ $produk->kategori->nama ?? '' }}</div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center text-muted py-5">
                        <i class="bi bi-bag-x d-block mb-2" style="font-size:3rem"></i>
                        Belum ada produk tersedia
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Cart & Form --}}
        <div class="col-lg-4">
            <div class="cart-panel">
                <div class="cart-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold"><i class="bi bi-cart3 me-2"></i>Keranjang</span>
                        <span class="badge bg-white text-primary" id="cartCount">0 item</span>
                    </div>
                </div>
                <div class="p-3">
                    <form action="{{ route('order.store') }}" method="POST" id="formOrder">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">PILIH CABANG</label>
                            <select name="cabang_id" class="form-select form-control-custom">
                                <option value="">Semua Cabang</option>
                                @foreach($cabangs as $c)
                                    <option value="{{ $c->id }}" {{ $cabang_id == $c->id ? 'selected' : '' }}>
                                        {{ $c->nama_cabang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div id="cartItems" class="mb-3">
                            <div class="text-center text-muted py-3">
                                <i class="bi bi-cart d-block mb-1" style="font-size:2rem;opacity:.3"></i>
                                <small>Klik produk untuk menambahkan</small>
                            </div>
                        </div>

                        <div class="total-box mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-semibold">Total Pembayaran</span>
                                <span class="fw-bold" id="totalHarga" style="color:#667eea;font-size:1.1rem">Rp 0</span>
                            </div>
                        </div>

                        <hr class="my-3">

                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">NAMA KAMU <span class="text-danger">*</span></label>
                            <input type="text" name="nama_customer" class="form-control form-control-custom"
                                   placeholder="Masukkan nama lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">NO. TELEPON</label>
                            <input type="text" name="telepon" class="form-control form-control-custom"
                                   placeholder="08xxxxxxxxxx">
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-semibold text-muted">CATATAN</label>
                            <textarea name="catatan" class="form-control form-control-custom" rows="2"
                                      placeholder="Catatan untuk kasir..."></textarea>
                        </div>

                        <button type="submit" class="btn-primary-custom" id="btnOrder" disabled>
                            <i class="bi bi-bag-check me-2"></i>Buat Order Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
let cart = [];

function tambahKeranjang(el) {
    const id = el.dataset.id, nama = el.dataset.nama;
    const harga = parseFloat(el.dataset.harga), stok = parseInt(el.dataset.stok);
    const existing = cart.find(i => i.id == id);
    if (existing) {
        if (existing.jumlah < stok) existing.jumlah++;
        else { alert('Stok tidak cukup!'); return; }
    } else {
        cart.push({ id, nama, harga, jumlah: 1, stok });
    }
    updateCart();
}

function updateCart() {
    const div = document.getElementById('cartItems');
    document.getElementById('cartCount').textContent = cart.reduce((s,i) => s+i.jumlah, 0) + ' item';

    if (cart.length === 0) {
        div.innerHTML = `<div class="text-center text-muted py-3">
            <i class="bi bi-cart d-block mb-1" style="font-size:2rem;opacity:.3"></i>
            <small>Klik produk untuk menambahkan</small></div>`;
        document.getElementById('btnOrder').disabled = true;
        document.getElementById('totalHarga').textContent = 'Rp 0';
        document.querySelectorAll('.produk-card').forEach(c => c.classList.remove('selected'));
        return;
    }

    let html = '', total = 0;
    cart.forEach((item, i) => {
        total += item.harga * item.jumlah;
        html += `<div class="cart-item d-flex justify-content-between align-items-center">
            <div class="flex-grow-1">
                <div class="fw-semibold" style="font-size:.82rem">${item.nama}</div>
                <div class="text-muted" style="font-size:.75rem">Rp ${item.harga.toLocaleString('id-ID')} × ${item.jumlah}</div>
                <input type="hidden" name="items[${i}][produk_id]" value="${item.id}">
                <input type="hidden" name="items[${i}][jumlah]" value="${item.jumlah}">
            </div>
            <div class="d-flex align-items-center gap-1 ms-2">
                <button type="button" class="btn btn-sm btn-outline-secondary rounded-circle p-0" style="width:24px;height:24px;line-height:1" onclick="ubahJumlah(${i},-1)">-</button>
                <span class="fw-bold small">${item.jumlah}</span>
                <button type="button" class="btn btn-sm btn-outline-secondary rounded-circle p-0" style="width:24px;height:24px;line-height:1" onclick="ubahJumlah(${i},1)">+</button>
                <button type="button" class="btn btn-sm btn-outline-danger rounded-circle p-0 ms-1" style="width:24px;height:24px;line-height:1" onclick="hapusItem(${i})">×</button>
            </div>
        </div>`;
    });

    div.innerHTML = html;
    document.getElementById('totalHarga').textContent = 'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('btnOrder').disabled = false;
    document.querySelectorAll('.produk-card').forEach(c => {
        c.classList.toggle('selected', cart.some(i => i.id == c.dataset.id));
    });
}

function ubahJumlah(index, delta) {
    const item = cart[index];
    const newJumlah = item.jumlah + delta;
    if (newJumlah <= 0) hapusItem(index);
    else if (newJumlah <= item.stok) { item.jumlah = newJumlah; updateCart(); }
    else alert('Stok tidak cukup!');
}

function hapusItem(index) { cart.splice(index, 1); updateCart(); }

document.getElementById('searchProduk').addEventListener('input', function() {
    const keyword = this.value.toLowerCase();
    document.querySelectorAll('.produk-col').forEach(col => {
        const nama = col.querySelector('.fw-semibold')?.textContent.toLowerCase() || '';
        col.style.display = nama.includes(keyword) ? '' : 'none';
    });
});
</script>
</body>
</html>
