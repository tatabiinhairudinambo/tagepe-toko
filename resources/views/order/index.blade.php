<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Online - Tagepe Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6c63ff;
            --secondary: #ff6584;
            --dark: #1a1a2e;
            --card-radius: 20px;
        }
        * { font-family: 'Poppins', sans-serif; box-sizing: border-box; }
        body { background: #0f0f1a; color: #fff; min-height: 100vh; }

        /* Navbar */
        .navbar-custom {
            background: rgba(255,255,255,.05);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,.08);
            padding: 12px 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .brand-logo { font-weight: 800; font-size: 1.3rem; color: #fff; }
        .brand-logo span { color: var(--primary); }
        .search-nav {
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 50px;
            display: flex;
            align-items: center;
            padding: 6px 16px;
            gap: 8px;
            flex: 1;
            max-width: 380px;
            transition: all .2s;
        }
        .search-nav:focus-within {
            background: rgba(255,255,255,.12);
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(108,99,255,.2);
        }
        .search-nav input {
            background: none;
            border: none;
            outline: none;
            color: #fff;
            font-size: .85rem;
            flex: 1;
        }
        .search-nav input::placeholder { color: rgba(255,255,255,.4); }
        .btn-search {
            background: var(--primary);
            border: none;
            border-radius: 50px;
            padding: 4px 14px;
            color: #fff;
            font-size: .8rem;
            font-weight: 600;
        }

        /* Hero */
        .hero {
            padding: 60px 0 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: -100px; left: 50%;
            transform: translateX(-50%);
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(108,99,255,.3) 0%, transparent 70%);
            pointer-events: none;
        }
        .hero h1 {
            font-size: 2.8rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 12px;
        }
        .hero h1 .highlight {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero p { color: rgba(255,255,255,.6); font-size: 1rem; }
        .hero-badges { display: flex; justify-content: center; gap: 10px; flex-wrap: wrap; margin-top: 20px; }
        .hero-badge {
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 50px;
            padding: 6px 16px;
            font-size: .8rem;
            color: rgba(255,255,255,.8);
        }
        .hero-badge i { color: var(--primary); }

        /* Filter kategori */
        .filter-bar {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            padding: 4px 0 12px;
            scrollbar-width: none;
        }
        .filter-bar::-webkit-scrollbar { display: none; }
        .filter-btn {
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.1);
            border-radius: 50px;
            padding: 6px 18px;
            color: rgba(255,255,255,.7);
            font-size: .82rem;
            white-space: nowrap;
            cursor: pointer;
            transition: all .2s;
        }
        .filter-btn.active, .filter-btn:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
        }

        /* Produk card */
        .produk-card {
            background: rgba(255,255,255,.05);
            border: 1px solid rgba(255,255,255,.08);
            border-radius: var(--card-radius);
            overflow: hidden;
            cursor: pointer;
            transition: all .25s;
            position: relative;
        }
        .produk-card:hover {
            transform: translateY(-6px);
            border-color: var(--primary);
            box-shadow: 0 20px 40px rgba(108,99,255,.25);
        }
        .produk-card.selected {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(108,99,255,.3);
        }
        .produk-card.selected::after {
            content: '✓';
            position: absolute;
            top: 10px; right: 10px;
            width: 28px; height: 28px;
            background: var(--primary);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: .8rem; font-weight: 700;
            color: #fff;
        }
        .produk-foto {
            height: 170px;
            overflow: hidden;
            background: linear-gradient(135deg, #1a1a3e, #2d2d5e);
            position: relative;
        }
        .produk-foto img { width:100%; height:100%; object-fit:cover; transition: transform .3s; }
        .produk-card:hover .produk-foto img { transform: scale(1.05); }
        .produk-foto .no-foto {
            display: flex; align-items: center; justify-content: center;
            height: 100%; font-size: 3rem;
            color: rgba(255,255,255,.2);
        }
        .produk-info { padding: 14px; }
        .produk-nama { font-weight: 600; font-size: .88rem; margin-bottom: 6px; color: #fff; }
        .produk-harga { font-weight: 700; font-size: .95rem; color: var(--primary); }
        .produk-stok {
            font-size: .7rem;
            padding: 3px 10px;
            border-radius: 50px;
            font-weight: 600;
        }
        .stok-ok { background: rgba(46,213,115,.15); color: #2ed573; border: 1px solid rgba(46,213,115,.3); }
        .stok-low { background: rgba(255,165,2,.15); color: #ffa502; border: 1px solid rgba(255,165,2,.3); }

        /* Cart panel */
        .cart-panel {
            background: rgba(255,255,255,.04);
            border: 1px solid rgba(255,255,255,.08);
            border-radius: var(--card-radius);
            position: sticky;
            top: 80px;
            overflow: hidden;
        }
        .cart-header {
            background: linear-gradient(135deg, var(--primary), #9c88ff);
            padding: 18px 20px;
        }
        .cart-body { padding: 16px; }
        .cart-item {
            background: rgba(255,255,255,.05);
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 12px;
            padding: 10px 12px;
            margin-bottom: 8px;
        }
        .cart-item-nama { font-size: .82rem; font-weight: 600; color: #fff; }
        .cart-item-harga { font-size: .75rem; color: rgba(255,255,255,.5); }
        .qty-btn {
            width: 26px; height: 26px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,.2);
            background: rgba(255,255,255,.08);
            color: #fff;
            font-size: .8rem;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            transition: all .15s;
        }
        .qty-btn:hover { background: var(--primary); border-color: var(--primary); }

        /* Form */
        .form-label-custom { font-size: .75rem; font-weight: 600; color: rgba(255,255,255,.5); text-transform: uppercase; letter-spacing: .5px; margin-bottom: 6px; }
        .input-custom {
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.1);
            border-radius: 12px;
            padding: 10px 14px;
            color: #fff;
            font-size: .88rem;
            width: 100%;
            transition: all .2s;
        }
        .input-custom:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(108,99,255,.1);
            box-shadow: 0 0 0 3px rgba(108,99,255,.15);
        }
        .input-custom::placeholder { color: rgba(255,255,255,.3); }
        .input-custom option { background: #1a1a2e; color: #fff; }

        /* Total */
        .total-box {
            background: linear-gradient(135deg, rgba(108,99,255,.2), rgba(156,136,255,.1));
            border: 1px solid rgba(108,99,255,.3);
            border-radius: 14px;
            padding: 14px 16px;
        }
        .total-label { font-size: .78rem; color: rgba(255,255,255,.5); }
        .total-amount { font-size: 1.3rem; font-weight: 800; color: var(--primary); }

        /* Button order */
        .btn-order {
            background: linear-gradient(135deg, var(--primary), #9c88ff);
            border: none;
            border-radius: 14px;
            padding: 14px;
            color: #fff;
            font-weight: 700;
            font-size: .95rem;
            width: 100%;
            transition: all .2s;
            position: relative;
            overflow: hidden;
        }
        .btn-order:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(108,99,255,.4);
        }
        .btn-order:disabled { opacity: .4; cursor: not-allowed; }

        /* Empty cart */
        .empty-cart { text-align: center; padding: 24px 0; color: rgba(255,255,255,.3); }
        .empty-cart i { font-size: 2.5rem; display: block; margin-bottom: 8px; }

        /* Search result badge */
        .search-result {
            background: rgba(108,99,255,.15);
            border: 1px solid rgba(108,99,255,.3);
            border-radius: 50px;
            padding: 6px 16px;
            font-size: .82rem;
            color: rgba(255,255,255,.8);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        @media (max-width: 768px) {
            .hero h1 { font-size: 1.8rem; }
            .hero { padding: 30px 0 20px; }
            .search-nav { max-width: 200px; }
        }
    </style>
</head>
<body>

{{-- Navbar --}}
<nav class="navbar-custom">
    <div class="container d-flex align-items-center gap-3">
        <div class="brand-logo me-2">Tagepe<span>Toko</span></div>

        <form action="{{ route('order.cari') }}" method="GET" class="search-nav flex-grow-1">
            <i class="bi bi-search" style="color:rgba(255,255,255,.4);font-size:.85rem"></i>
            <input type="text" name="search" placeholder="Cari produk..." value="{{ $search ?? '' }}" autocomplete="off">
            <button type="submit" class="btn-search">Cari</button>
        </form>

        <div class="d-flex gap-2 ms-auto">
            <a href="{{ route('order.cek') }}" class="btn btn-sm rounded-pill px-3"
               style="background:rgba(255,255,255,.08);color:#fff;border:1px solid rgba(255,255,255,.15);font-size:.8rem">
                <i class="bi bi-receipt me-1"></i> Cek Order
            </a>
        </div>
    </div>
</nav>

{{-- Hero --}}
<div class="hero">
    <div class="container">
        <h1>Pesan <span class="highlight">Produk Favoritmu</span><br>Bayar via QRIS / Kasir</h1>
        <p>Pilih produk, isi data, dan tunjukkan kode order ke kasir kami</p>
        <div class="hero-badges">
            <span class="hero-badge"><i class="bi bi-lightning-fill me-1"></i> Order Cepat</span>
            <span class="hero-badge"><i class="bi bi-shield-check me-1"></i> Aman & Terpercaya</span>
            <span class="hero-badge"><i class="bi bi-qr-code me-1"></i> Bayar QRIS</span>
        </div>

        @if(isset($search) && $search)
        <div class="mt-3">
            <span class="search-result">
                <i class="bi bi-search"></i>
                "{{ $search }}" — {{ $produks->count() }} produk ditemukan
                <a href="{{ route('order.index') }}" style="color:rgba(255,255,255,.5)">
                    <i class="bi bi-x-circle"></i>
                </a>
            </span>
        </div>
        @endif
    </div>
</div>

{{-- Content --}}
<div class="container pb-5">
    @if(session('error'))
        <div class="alert alert-danger rounded-3 mb-4">{{ session('error') }}</div>
    @endif

    <div class="row g-4">
        {{-- Produk --}}
        <div class="col-lg-8">
            {{-- Filter kategori --}}
            <div class="filter-bar mb-3">
                <button class="filter-btn active" onclick="filterKategori('semua', this)">Semua</button>
                @foreach($produks->groupBy('kategori.nama') as $kat => $items)
                <button class="filter-btn" onclick="filterKategori('{{ $kat }}', this)">{{ $kat ?: 'Lainnya' }}</button>
                @endforeach
            </div>

            <div class="row g-3" id="produkList">
                @forelse($produks as $produk)
                @php
                    $foto = $produk->foto
                        ? (str_starts_with($produk->foto,'http') ? $produk->foto : asset('storage/'.$produk->foto))
                        : null;
                    $kategoriNama = $produk->kategori->nama ?? 'Lainnya';
                @endphp
                <div class="col-6 col-md-4 produk-col" data-kategori="{{ $kategoriNama }}">
                    <div class="produk-card"
                         data-id="{{ $produk->id }}"
                         data-nama="{{ $produk->nama }}"
                         data-harga="{{ $produk->harga }}"
                         data-stok="{{ $produk->stok }}"
                         onclick="tambahKeranjang(this)">
                        <div class="produk-foto">
                            @if($foto)
                                <img src="{{ $foto }}" alt="{{ $produk->nama }}">
                            @else
                                <div class="no-foto"><i class="bi bi-bag"></i></div>
                            @endif
                        </div>
                        <div class="produk-info">
                            <div class="produk-nama">{{ $produk->nama }}</div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="produk-harga">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                <span class="produk-stok {{ $produk->stok > 5 ? 'stok-ok' : 'stok-low' }}">
                                    {{ $produk->stok > 5 ? 'Tersedia' : 'Sisa '.$produk->stok }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5" style="color:rgba(255,255,255,.3)">
                    <i class="bi bi-bag-x d-block mb-2" style="font-size:3rem"></i>
                    <p>Tidak ada produk ditemukan</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- Cart --}}
        <div class="col-lg-4">
            <div class="cart-panel">
                <div class="cart-header d-flex justify-content-between align-items-center">
                    <span class="fw-bold"><i class="bi bi-cart3 me-2"></i>Keranjang</span>
                    <span class="badge bg-white text-primary fw-bold" id="cartCount">0</span>
                </div>
                <div class="cart-body">
                    <form action="{{ route('order.store') }}" method="POST" id="formOrder">
                        @csrf

                        <div class="mb-3">
                            <div class="form-label-custom">Pilih Cabang</div>
                            <select name="cabang_id" class="input-custom">
                                <option value="">Semua Cabang</option>
                                @foreach($cabangs as $c)
                                    <option value="{{ $c->id }}" {{ ($cabang_id ?? '') == $c->id ? 'selected' : '' }}>
                                        {{ $c->nama_cabang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div id="cartItems" class="mb-3">
                            <div class="empty-cart">
                                <i class="bi bi-cart"></i>
                                <small>Klik produk untuk menambahkan</small>
                            </div>
                        </div>

                        <div class="total-box mb-3">
                            <div class="total-label">Total Pembayaran</div>
                            <div class="total-amount" id="totalHarga">Rp 0</div>
                        </div>

                        <hr style="border-color:rgba(255,255,255,.08);margin:16px 0">

                        <div class="mb-3">
                            <div class="form-label-custom">Nama Kamu <span style="color:var(--secondary)">*</span></div>
                            <input type="text" name="nama_customer" class="input-custom" placeholder="Masukkan nama lengkap" required>
                        </div>
                        <div class="mb-3">
                            <div class="form-label-custom">No. Telepon</div>
                            <input type="text" name="telepon" class="input-custom" placeholder="08xxxxxxxxxx">
                        </div>
                        <div class="mb-4">
                            <div class="form-label-custom">Catatan</div>
                            <textarea name="catatan" class="input-custom" rows="2" placeholder="Catatan untuk kasir..."></textarea>
                        </div>

                        <button type="submit" class="btn-order" id="btnOrder" disabled>
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
    const total = cart.reduce((s, i) => s + i.harga * i.jumlah, 0);
    document.getElementById('cartCount').textContent = cart.reduce((s,i) => s+i.jumlah, 0);

    if (cart.length === 0) {
        div.innerHTML = `<div class="empty-cart"><i class="bi bi-cart"></i><small>Klik produk untuk menambahkan</small></div>`;
        document.getElementById('btnOrder').disabled = true;
        document.getElementById('totalHarga').textContent = 'Rp 0';
        document.querySelectorAll('.produk-card').forEach(c => c.classList.remove('selected'));
        return;
    }

    let html = '';
    cart.forEach((item, i) => {
        html += `<div class="cart-item d-flex justify-content-between align-items-center">
            <div class="flex-grow-1">
                <div class="cart-item-nama">${item.nama}</div>
                <div class="cart-item-harga">Rp ${item.harga.toLocaleString('id-ID')} × ${item.jumlah}</div>
                <input type="hidden" name="items[${i}][produk_id]" value="${item.id}">
                <input type="hidden" name="items[${i}][jumlah]" value="${item.jumlah}">
            </div>
            <div class="d-flex align-items-center gap-1 ms-2">
                <div class="qty-btn" onclick="ubahJumlah(${i},-1)">-</div>
                <span class="fw-bold small mx-1">${item.jumlah}</span>
                <div class="qty-btn" onclick="ubahJumlah(${i},1)">+</div>
                <div class="qty-btn ms-1" onclick="hapusItem(${i})" style="color:#ff6584;border-color:rgba(255,101,132,.3)">×</div>
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

function filterKategori(kat, btn) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.produk-col').forEach(col => {
        col.style.display = (kat === 'semua' || col.dataset.kategori === kat) ? '' : 'none';
    });
}
</script>
</body>
</html>
