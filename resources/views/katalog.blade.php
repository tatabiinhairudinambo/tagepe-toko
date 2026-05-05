<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk - Data Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2c3e50;
            --accent: #3498db;
        }
        body { background: #f0f4f8; font-family: 'Segoe UI', sans-serif; }

        /* Navbar */
        .navbar-brand { font-weight: 700; font-size: 1.4rem; letter-spacing: .5px; }

        /* Hero */
        .hero {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            color: white;
            padding: 72px 0 56px;
            text-align: center;
        }
        .hero h1 { font-size: 2.6rem; font-weight: 800; margin-bottom: 12px; }
        .hero p  { font-size: 1.1rem; opacity: .85; }

        /* Filter pills */
        .filter-pill {
            cursor: pointer;
            border-radius: 50px;
            padding: 6px 18px;
            font-size: .875rem;
            border: 2px solid #dee2e6;
            background: white;
            transition: all .2s;
        }
        .filter-pill:hover, .filter-pill.active {
            background: var(--accent);
            border-color: var(--accent);
            color: white;
        }

        /* Kartu produk */
        .produk-card {
            border: none;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,.08);
            transition: transform .2s, box-shadow .2s;
            height: 100%;
        }
        .produk-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0,0,0,.14);
        }
        .produk-card .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .produk-card .no-foto {
            height: 200px;
            background: linear-gradient(135deg, #e8edf2, #d0dae4);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: #94a3b8;
        }
        .badge-kategori {
            background: #e8f4fd;
            color: var(--accent);
            font-size: .75rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 50px;
        }
        .harga {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary);
        }
        .stok-badge {
            font-size: .75rem;
            padding: 3px 10px;
            border-radius: 50px;
        }

        /* Footer */
        footer { background: var(--primary); color: #94a3b8; padding: 32px 0; margin-top: 64px; }
    </style>
</head>
<body>

{{-- Navbar --}}
@php $toko = \App\Models\Toko::first(); @endphp
<nav class="navbar navbar-dark sticky-top" style="background:var(--primary)">
    <div class="container">
        <span class="navbar-brand">
            <i class="bi bi-shop me-2"></i>{{ $toko->nama_toko ?? 'Data Toko' }}
        </span>
        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">
            <i class="bi bi-box-arrow-in-right me-1"></i>Login Admin
        </a>
    </div>
</nav>

{{-- Hero --}}
<div class="hero">
    <div class="container">
        <h1><i class="bi bi-bag-heart me-2"></i>Katalog Produk</h1>
        <p>Temukan semua produk pilihan kami dengan harga terbaik</p>
        <div class="mt-3 d-flex justify-content-center gap-4 flex-wrap">
            <div class="text-center">
                <div style="font-size:1.8rem;font-weight:800">{{ $totalProduk }}</div>
                <div style="font-size:.85rem;opacity:.8">Total Produk</div>
            </div>
            <div class="text-center">
                <div style="font-size:1.8rem;font-weight:800">{{ $totalKategori }}</div>
                <div style="font-size:.85rem;opacity:.8">Kategori</div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">

    {{-- Filter Kategori --}}
    <div class="d-flex flex-wrap gap-2 mb-4 align-items-center">
        <span class="text-muted small me-1">Filter:</span>
        <button class="filter-pill active" onclick="filterKategori('semua', this)">Semua</button>
        @foreach($kategoris as $k)
            <button class="filter-pill" onclick="filterKategori('{{ $k->id }}', this)">
                {{ $k->nama }}
            </button>
        @endforeach
    </div>

    {{-- Grid Produk --}}
    @if($produks->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="bi bi-box-seam" style="font-size:3rem"></i>
            <p class="mt-3">Belum ada produk tersedia.</p>
        </div>
    @else
        <div class="row g-4" id="produk-grid">
            @foreach($produks as $p)
            <div class="col-sm-6 col-md-4 col-lg-3 produk-item" data-kategori="{{ $p->kategori_id }}">
                <div class="produk-card card">
                    {{-- Foto --}}
                    @if($p->foto)
                        @if(str_starts_with($p->foto, 'http'))
                            <img src="{{ $p->foto }}" class="card-img-top" alt="{{ $p->nama }}">
                        @else
                            <img src="{{ asset('storage/' . $p->foto) }}" class="card-img-top" alt="{{ $p->nama }}">
                        @endif
                    @else
                        <div class="no-foto"><i class="bi bi-image"></i></div>
                    @endif

                    <div class="card-body d-flex flex-column gap-2">
                        {{-- Kategori --}}
                        <span class="badge-kategori align-self-start">{{ $p->kategori->nama ?? '-' }}</span>

                        {{-- Nama --}}
                        <h6 class="mb-0 fw-semibold" style="line-height:1.4">{{ $p->nama }}</h6>

                        {{-- Deskripsi --}}
                        @if($p->deskripsi)
                            <p class="text-muted small mb-0" style="line-height:1.5">
                                {{ Str::limit($p->deskripsi, 60) }}
                            </p>
                        @endif

                        <div class="mt-auto pt-2 d-flex justify-content-between align-items-center">
                            {{-- Harga --}}
                            <span class="harga">Rp {{ number_format($p->harga, 0, ',', '.') }}</span>

                            {{-- Stok --}}
                            @if($p->stok > 0)
                                <span class="badge bg-success stok-badge">Stok {{ $p->stok }}</span>
                            @else
                                <span class="badge bg-secondary stok-badge">Habis</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

{{-- Footer --}}
<footer>
    <div class="container text-center">
        @php $toko = \App\Models\Toko::first(); @endphp
        @if($toko)
            <p class="mb-1"><i class="bi bi-shop me-1"></i> <strong style="color:white">{{ $toko->nama_toko }}</strong></p>
            <p class="small mb-1">{{ $toko->alamat }}</p>
            <p class="small mb-1">
                <i class="bi bi-telephone me-1"></i>{{ $toko->telepon }}
                @if($toko->email)
                    <span class="mx-2">|</span>
                    <i class="bi bi-envelope me-1"></i>{{ $toko->email }}
                @endif
            </p>
        @else
            <p class="mb-1"><i class="bi bi-shop me-1"></i> <strong style="color:white">Data Toko</strong></p>
        @endif
        <p class="small mb-0 mt-2 opacity-75">Sistem Manajemen Toko &mdash; Dibuat dengan Laravel</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function filterKategori(id, el) {
    // Update tombol aktif
    document.querySelectorAll('.filter-pill').forEach(b => b.classList.remove('active'));
    el.classList.add('active');

    // Tampilkan/sembunyikan kartu
    document.querySelectorAll('.produk-item').forEach(item => {
        if (id === 'semua' || item.dataset.kategori === id) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
}
</script>
</body>
</html>
