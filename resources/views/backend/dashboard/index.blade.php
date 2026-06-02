@extends('backend.layout.app')
@section('title', 'Dashboard')

@push('styles')
<style>
    /* Quick Search Styling */
    #searchResults .search-item {
        padding: 12px;
        border-radius: 8px;
        transition: all 0.2s ease;
        cursor: pointer;
        border: 1px solid #e9ecef;
        margin-bottom: 8px;
    }
    #searchResults .search-item:hover {
        background: #f8f9fa;
        border-color: #3498db;
        transform: translateX(3px);
    }
    #searchResults .search-item img {
        width: 48px;
        height: 48px;
        object-fit: cover;
        border-radius: 8px;
    }
    #searchResults .search-item .no-image {
        width: 48px;
        height: 48px;
        background: #e8edf2;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .search-loading {
        text-align: center;
        padding: 20px;
        color: #6c757d;
    }
    
    /* Responsive Dashboard */
    @media (max-width: 992px) {
        .row.g-3 > [class*='col-md-'] {
            margin-bottom: 12px;
        }
    }
    
    @media (max-width: 768px) {
        .alert .row .col-md-4 {
            margin-bottom: 8px;
        }
        .alert .btn {
            margin-top: 8px;
            width: 100%;
        }
        .fs-3 {
            font-size: 1.8rem !important;
        }
        .card-body .small {
            font-size: .75rem !important;
        }
        /* Make cards stack nicely */
        .row.g-3 {
            gap: 12px !important;
        }
        .row.g-3 > div {
            padding: 0 !important;
        }
        #searchResults .search-item {
            padding: 10px;
        }
        #searchResults .search-item img,
        #searchResults .search-item .no-image {
            width: 40px;
            height: 40px;
        }
    }
    
    @media (max-width: 576px) {
        .alert {
            padding: 16px !important;
        }
        .alert .d-flex.align-items-center {
            flex-direction: column !important;
            text-align: center;
            gap: 12px !important;
        }
        .alert i {
            font-size: 1.5rem !important;
        }
        .alert .ms-auto {
            margin-left: 0 !important;
            margin-top: 8px;
        }
        .fs-3 {
            font-size: 1.5rem !important;
        }
        .fs-4 {
            font-size: 1.2rem !important;
        }
    }
</style>
@endpush

@section('content')

{{-- Alert stok menipis untuk admin --}}
@if(Auth::user()->role === 'admin')
@php
    $stokMenipisAlert = \App\Models\StokCabang::with(['produk','cabang'])
        ->whereHas('produk', fn($q) => $q->where('status','aktif'))
        ->whereColumn('stok_cabangs.stok', '<=', \Illuminate\Support\Facades\DB::raw('(SELECT stok_minimum FROM produks WHERE produks.id = stok_cabangs.produk_id)'))
        ->get();
@endphp
@if($stokMenipisAlert->count() > 0)
<div class="alert border-0 shadow-sm mb-4" style="background:linear-gradient(135deg,#e74c3c,#c0392b);color:white;border-radius:14px">
    <div class="d-flex align-items-center gap-3 mb-2">
        <i class="bi bi-exclamation-triangle-fill" style="font-size:2rem"></i>
        <div class="fw-bold">{{ $stokMenipisAlert->count() }} produk stok menipis/habis di cabang!</div>
        <a href="{{ route('produk.index') }}" class="btn btn-sm btn-light ms-auto">Cek Produk</a>
    </div>
    <div class="row g-2">
        @foreach($stokMenipisAlert->groupBy('cabang_id') as $cabangId => $items)
        <div class="col-md-4">
            <div class="p-2 rounded text-center" style="background:rgba(0,0,0,.2)">
                <div class="small fw-bold mb-1">{{ $items->first()->cabang->nama_cabang ?? 'Tanpa Cabang' }}</div>
                @foreach($items->take(3) as $item)
                <div class="d-flex justify-content-between small">
                    <span>{{ $item->produk->nama }}</span>
                    <span class="badge {{ $item->stok == 0 ? 'bg-danger' : 'bg-warning text-dark' }}">{{ $item->stok }}</span>
                </div>
                @endforeach
                @if($items->count() > 3)
                <div class="small opacity-75 text-center">+{{ $items->count()-3 }} lainnya</div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
@endif

{{-- Info Cabang untuk Kasir --}}
@if(Auth::user()->role === 'kasir')
<div class="row g-3 mb-4">
    <div class="col-lg-8">
        <div class="alert border-0 shadow-sm h-100 mb-0 d-flex align-items-center gap-3" 
             style="background:linear-gradient(135deg,#3498db,#2980b9);color:white;border-radius:14px">
            <i class="bi bi-building" style="font-size:2rem"></i>
            <div>
                <div class="fw-bold" style="font-size:1.1rem">{{ $cabang->nama_cabang ?? 'Belum ada cabang' }}</div>
                <div class="small opacity-75">Pendapatan hari ini: Rp {{ number_format($totalPendapatanHariIni ?? 0, 0, ',', '.') }}</div>
            </div>
            <div class="ms-auto text-end">
                <div class="small opacity-75">Total Transaksi</div>
                <div class="fw-bold fs-4">{{ $jumlahTransaksiHariIni ?? 0 }}</div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px;background:linear-gradient(135deg,#16a085,#138d75);color:white">
            <div class="card-body d-flex flex-column justify-content-center p-3">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-clock-fill" style="font-size:1.5rem"></i>
                    <div>
                        <div class="fw-bold" style="font-size:.9rem">Shift Info</div>
                        @if($loginLogToday)
                        <div class="small opacity-75">Login: {{ $loginLogToday->created_at->format('H:i') }} WIB</div>
                        @else
                        <div class="small opacity-75">Belum login hari ini</div>
                        @endif
                    </div>
                </div>
                @if($shiftDuration !== null)
                <div class="text-center mt-1">
                    <div class="small opacity-75">Durasi Shift</div>
                    <div class="fw-bold fs-5">
                        {{ floor($shiftDuration / 60) }} jam {{ $shiftDuration % 60 }} menit
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Quick Search Produk --}}
<div class="card border-0 shadow-sm mb-4" style="border-radius:14px">
    <div class="card-body p-3">
        <div class="d-flex align-items-center gap-2 mb-3">
            <i class="bi bi-search text-primary" style="font-size:1.3rem"></i>
            <h6 class="fw-bold mb-0" style="font-size:.95rem">Cari Produk Cepat</h6>
        </div>
        <div class="position-relative">
            <input type="text" 
                   id="quickSearch" 
                   class="form-control form-control-lg" 
                   placeholder="Ketik nama produk untuk cek stok & harga..." 
                   autocomplete="off"
                   style="border-radius:10px;padding-left:45px;border:2px solid #e9ecef">
            <i class="bi bi-search position-absolute" style="left:15px;top:50%;transform:translateY(-50%);color:#adb5bd;font-size:1.2rem"></i>
        </div>
        <div id="searchResults" class="mt-3" style="display:none">
            <!-- Results will be populated here -->
        </div>
    </div>
</div>

{{-- Quick Action Buttons untuk Kasir --}}
<div class="row g-3 mb-4">
    <div class="col-lg-3 col-md-6">
        <a href="{{ route('transaksi.index') }}" class="btn btn-lg w-100 text-start d-flex align-items-center gap-3 border-0 shadow-sm" 
           style="background:linear-gradient(135deg,#2ecc71,#27ae60);color:white;border-radius:12px;padding:1.25rem">
            <i class="bi bi-cart-plus" style="font-size:2.5rem"></i>
            <div>
                <div class="fw-bold" style="font-size:1.1rem">Transaksi Baru</div>
                <div class="small opacity-75">Buat transaksi</div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-6">
        <a href="{{ route('produk.index') }}" class="btn btn-lg w-100 text-start d-flex align-items-center gap-3 border-0 shadow-sm" 
           style="background:linear-gradient(135deg,#3498db,#2980b9);color:white;border-radius:12px;padding:1.25rem">
            <i class="bi bi-box-seam" style="font-size:2.5rem"></i>
            <div>
                <div class="fw-bold" style="font-size:1.1rem">Cek Stok</div>
                <div class="small opacity-75">Lihat produk</div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-6">
        <a href="{{ route('pemesanan.index') }}" class="btn btn-lg w-100 text-start d-flex align-items-center gap-3 border-0 shadow-sm" 
           style="background:linear-gradient(135deg,#f39c12,#e67e22);color:white;border-radius:12px;padding:1.25rem">
            <i class="bi bi-clipboard-check" style="font-size:2.5rem"></i>
            <div>
                <div class="fw-bold" style="font-size:1.1rem">Pemesanan</div>
                <div class="small opacity-75">Kelola order</div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-6">
        <a href="{{ route('order.kasir.index') }}" class="btn btn-lg w-100 text-start d-flex align-items-center gap-3 border-0 shadow-sm" 
           style="background:linear-gradient(135deg,#9b59b6,#8e44ad);color:white;border-radius:12px;padding:1.25rem">
            <i class="bi bi-globe" style="font-size:2.5rem"></i>
            <div>
                <div class="fw-bold" style="font-size:1.1rem">Order Online</div>
                <div class="small opacity-75">
                    @if(isset($pendingOrders) && $pendingOrders > 0)
                        <span class="badge bg-danger">{{ $pendingOrders }} baru</span>
                    @else
                        Tidak ada order
                    @endif
                </div>
            </div>
        </a>
    </div>
</div>

{{-- Shift Summary --}}
<div class="row g-3 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius:12px!important">
            <div class="card-body text-center p-3">
                <div class="text-muted small mb-2" style="font-size:.75rem">Transaksi Hari Ini</div>
                <div class="fs-2 fw-bold text-success">{{ $jumlahTransaksiHariIni ?? 0 }}</div>
                <div class="small text-muted">transaksi</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius:12px!important">
            <div class="card-body text-center p-3">
                <div class="text-muted small mb-2" style="font-size:.75rem">Total Pendapatan</div>
                <div class="fw-bold text-primary" style="font-size:1.3rem">Rp {{ number_format($totalPendapatanHariIni ?? 0, 0, ',', '.') }}</div>
                <div class="small text-muted">hari ini</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius:12px!important">
            <div class="card-body text-center p-3">
                <div class="text-muted small mb-2" style="font-size:.75rem">Item Terjual</div>
                <div class="fs-2 fw-bold text-warning">{{ $totalItemTerjualHariIni ?? 0 }}</div>
                <div class="small text-muted">produk</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius:12px!important">
            <div class="card-body text-center p-3">
                <div class="text-muted small mb-2" style="font-size:.75rem">Rata-rata per Transaksi</div>
                <div class="fw-bold text-info" style="font-size:1.2rem">Rp {{ number_format($rataRataPerTransaksi ?? 0, 0, ',', '.') }}</div>
                <div class="small text-muted">per transaksi</div>
            </div>
        </div>
    </div>
</div>

{{-- Top Products & Low Stock --}}
<div class="row g-3 mb-4">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius:12px">
            <div class="card-body">
                <h6 class="fw-bold mb-3"><i class="bi bi-fire text-danger me-2"></i>Produk Terlaris Hari Ini</h6>
                @if(isset($topProductsToday) && $topProductsToday->count() > 0)
                <div class="list-group list-group-flush">
                    @foreach($topProductsToday as $index => $product)
                    <div class="list-group-item border-0 px-0 py-2 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <div class="fw-bold text-muted" style="width:20px">#{{ $index + 1 }}</div>
                            <div>
                                <div class="fw-semibold" style="font-size:.9rem">{{ $product->nama }}</div>
                            </div>
                        </div>
                        <span class="badge bg-success" style="border-radius:50px">{{ $product->total_terjual }} terjual</span>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-muted text-center mb-0 py-3">Belum ada penjualan hari ini</p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius:12px;border-left:4px solid #e74c3c!important">
            <div class="card-body">
                <h6 class="fw-bold mb-3"><i class="bi bi-exclamation-triangle text-warning me-2"></i>Stok Menipis</h6>
                @if(isset($lowStockProducts) && $lowStockProducts->count() > 0)
                <div class="list-group list-group-flush">
                    @foreach($lowStockProducts->take(5) as $item)
                    <div class="list-group-item border-0 px-0 py-2 d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-semibold" style="font-size:.9rem">{{ $item->produk->nama }}</div>
                            <div class="small text-muted">Min: {{ $item->produk->stok_minimum }}</div>
                        </div>
                        <span class="badge {{ $item->stok == 0 ? 'bg-danger' : 'bg-warning text-dark' }}" style="border-radius:50px">
                            {{ $item->stok }} tersisa
                        </span>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-muted text-center mb-0 py-3">Semua stok aman</p>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Recent Transactions & Order Queue --}}
<div class="row g-3 mb-4">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm" style="border-radius:12px">
            <div class="card-body">
                <h6 class="fw-bold mb-3"><i class="bi bi-clock-history text-primary me-2"></i>Transaksi Terakhir</h6>
                @if(isset($recentTransactions) && $recentTransactions->count() > 0)
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="small">Kode</th>
                                <th class="small">Waktu</th>
                                <th class="small text-end">Total</th>
                                <th class="small text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentTransactions as $tr)
                            <tr>
                                <td class="small fw-semibold">#{{ $tr->id }}</td>
                                <td class="small">{{ $tr->tanggal->format('H:i') }}</td>
                                <td class="small text-end fw-bold">Rp {{ number_format($tr->total, 0, ',', '.') }}</td>
                                <td class="small text-center">
                                    <a href="{{ route('transaksi.struk', $tr->id) }}" target="_blank" class="btn btn-sm btn-outline-primary" style="border-radius:6px;padding:2px 8px">
                                        <i class="bi bi-printer"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-muted text-center mb-0 py-3">Belum ada transaksi</p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm" style="border-radius:12px">
            <div class="card-body">
                <h6 class="fw-bold mb-3"><i class="bi bi-basket text-success me-2"></i>Antrian Order Online</h6>
                <div class="d-flex flex-column gap-2">
                    <div class="p-3 rounded d-flex justify-content-between align-items-center" style="background:#fee;border-left:3px solid #dc3545">
                        <div>
                            <div class="small text-muted">Menunggu Diproses</div>
                            <div class="fw-bold fs-4 text-danger">{{ $pendingOrders ?? 0 }}</div>
                        </div>
                        <i class="bi bi-hourglass-split text-danger" style="font-size:2rem;opacity:0.3"></i>
                    </div>
                    <div class="p-3 rounded d-flex justify-content-between align-items-center" style="background:#fff3cd;border-left:3px solid #ffc107">
                        <div>
                            <div class="small text-muted">Sedang Disiapkan</div>
                            <div class="fw-bold fs-4 text-warning">{{ $processingOrders ?? 0 }}</div>
                        </div>
                        <i class="bi bi-gear-fill text-warning" style="font-size:2rem;opacity:0.3"></i>
                    </div>
                    <div class="p-3 rounded d-flex justify-content-between align-items-center" style="background:#d1f2eb;border-left:3px solid #28a745">
                        <div>
                            <div class="small text-muted">Selesai Hari Ini</div>
                            <div class="fw-bold fs-4 text-success">{{ $completedOrdersToday ?? 0 }}</div>
                        </div>
                        <i class="bi bi-check-circle-fill text-success" style="font-size:2rem;opacity:0.3"></i>
                    </div>
                </div>
                @if(isset($pendingOrders) && $pendingOrders > 0)
                <a href="{{ route('order.kasir.index') }}" class="btn btn-primary w-100 mt-3" style="border-radius:8px">
                    Proses Order Sekarang <i class="bi bi-arrow-right ms-2"></i>
                </a>
                @endif
            </div>
        </div>
    </div>
</div>

@endif

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    @if(Auth::user()->role === 'admin')
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:12px!important;overflow:hidden">
            <div class="card-body p-0">
                <div class="d-flex">
                    <div class="flex-grow-1 p-3">
                        <div class="text-muted small fw-semibold text-uppercase mb-1" style="letter-spacing:.5px;font-size:.7rem">Total Kategori</div>
                        <div class="fs-3 fw-bold text-dark">{{ $totalKategori }}</div>
                        <a href="{{ route('kategori.index') }}" class="text-decoration-none small text-primary mt-1 d-inline-block" style="font-size:.75rem">
                            Lihat semua <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                    <div class="d-flex align-items-center justify-content-center px-3"
                         style="background:linear-gradient(135deg,#3498db,#2980b9);min-width:70px">
                        <i class="bi bi-tags text-white" style="font-size:1.8rem"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:12px!important;overflow:hidden">
            <div class="card-body p-0">
                <div class="d-flex">
                    <div class="flex-grow-1 p-3">
                        <div class="text-muted small fw-semibold text-uppercase mb-1" style="letter-spacing:.5px;font-size:.7rem">Total Produk</div>
                        <div class="fs-3 fw-bold text-dark">{{ $totalProduk }}</div>
                        <a href="{{ route('produk.index') }}" class="text-decoration-none small text-success mt-1 d-inline-block" style="font-size:.75rem">
                            Lihat semua <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                    <div class="d-flex align-items-center justify-content-center px-3"
                         style="background:linear-gradient(135deg,#2ecc71,#27ae60);min-width:70px">
                        <i class="bi bi-box-seam text-white" style="font-size:1.8rem"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:12px!important;overflow:hidden">
            <div class="card-body p-0">
                <div class="d-flex">
                    <div class="flex-grow-1 p-3">
                        <div class="text-muted small fw-semibold text-uppercase mb-1" style="letter-spacing:.5px;font-size:.7rem">Total Nilai Stok</div>
                        <div class="fw-bold text-dark" style="font-size:1.2rem">
                            Rp {{ number_format($totalNilai, 0, ',', '.') }}
                        </div>
                        <span class="text-muted small mt-1 d-inline-block" style="font-size:.7rem">total harga produk</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-center px-3"
                         style="background:linear-gradient(135deg,#f39c12,#e67e22);min-width:70px">
                        <i class="bi bi-cash-stack text-white" style="font-size:1.8rem"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:12px!important;overflow:hidden">
            <div class="card-body p-0">
                <div class="d-flex">
                    <div class="flex-grow-1 p-3" style="background:linear-gradient(135deg,#9b59b6,#8e44ad);">
                        <div class="text-white small fw-semibold text-uppercase mb-1" style="letter-spacing:.5px;font-size:.7rem;opacity:0.9">Total Pendapatan</div>
                        <div class="fw-bold text-white" style="font-size:1.1rem">
                            Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                        </div>
                        <span class="text-white small mt-1 d-inline-block" style="font-size:.7rem;opacity:0.8">semua transaksi</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-center px-3"
                         style="background:linear-gradient(135deg,#8e44ad,#71368a);min-width:70px">
                        <i class="bi bi-graph-up-arrow text-white" style="font-size:1.8rem"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

{{-- Grafik Pendapatan Per Bulan --}}
@if(Auth::user()->role === 'admin')
<div class="card border-0 shadow-sm mb-4" style="border-radius:12px">
    <div class="card-body p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h6 class="fw-bold mb-0" style="font-size:.95rem">Pendapatan Per Bulan</h6>
                <p class="text-muted small mb-0" style="font-size:.75rem">12 bulan terakhir</p>
            </div>
            <a href="{{ route('transaksi.laporan') }}" class="btn btn-sm btn-outline-primary" style="border-radius:8px;font-size:.8rem;padding:4px 12px">
                Lihat Laporan
            </a>
        </div>
        <canvas id="grafikDashboard" height="60"></canvas>
    </div>
</div>
@endif

{{-- Produk Terbaru --}}
<div class="card border-0 shadow-sm mb-4" style="border-radius:12px!important">
    <div class="card-header bg-white border-0 pt-3 px-3 pb-0 d-flex justify-content-between align-items-center">
        <div>
            <h6 class="fw-bold mb-0" style="font-size:.95rem">Produk Terbaru</h6>
            <p class="text-muted small mb-0" style="font-size:.75rem">5 produk yang baru ditambahkan</p>
        </div>
        <a href="{{ route('produk.index') }}" class="btn btn-sm btn-outline-primary" style="border-radius:8px;font-size:.8rem;padding:4px 12px">Lihat Semua</a>
    </div>
    <div class="card-body p-0 mt-2">
        <table class="table table-hover mb-0">
            <thead style="background:#f8fafc">
                <tr>
                    <th class="ps-3 py-2 text-muted small fw-semibold border-0" style="font-size:.75rem">PRODUK</th>
                    <th class="py-2 text-muted small fw-semibold border-0" style="font-size:.75rem">KATEGORI</th>
                    <th class="py-2 text-muted small fw-semibold border-0" style="font-size:.75rem">HARGA</th>
                    <th class="py-2 text-muted small fw-semibold border-0" style="font-size:.75rem">STOK</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produkTerbaru as $p)
                <tr>
                    <td class="ps-3 py-2 align-middle">
                        <div class="d-flex align-items-center gap-2">
                            @if($p->foto)
                                <img src="{{ asset('storage/' . $p->foto) }}" alt="" style="width:32px;height:32px;object-fit:cover;border-radius:6px">
                            @else
                                <div style="width:32px;height:32px;background:#e8edf2;border-radius:6px;display:flex;align-items:center;justify-content:center">
                                    <i class="bi bi-image text-muted" style="font-size:.8rem"></i>
                                </div>
                            @endif
                            <span class="fw-semibold" style="font-size:.85rem">{{ $p->nama }}</span>
                        </div>
                    </td>
                    <td class="py-2 align-middle">
                        <span class="badge-kategori" style="font-size:.7rem;padding:3px 8px">
                            {{ $p->kategori->nama ?? '-' }}
                        </span>
                    </td>
                    <td class="py-2 align-middle fw-semibold" style="font-size:.85rem">Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                    <td class="py-2 align-middle">
                        @if($p->stok > 0)
                            <span class="badge bg-success" style="border-radius:50px;padding:3px 8px;font-size:.7rem">{{ $p->stok }}</span>
                        @else
                            <span class="badge bg-secondary" style="border-radius:50px;padding:3px 8px;font-size:.7rem">Habis</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted py-4" style="font-size:.85rem">Belum ada produk</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if(Auth::user()->role === 'admin')

{{-- Produk Pending Approval --}}
@if($produkPending->count() > 0)
<div class="card border-0 shadow-sm mb-4" style="border-radius:14px;border-left:4px solid #f39c12!important">
    <div class="card-body">
        <h6 class="fw-bold mb-3"><i class="bi bi-clock-history text-warning me-2"></i>Produk Menunggu Persetujuan ({{ $produkPending->count() }})</h6>
        <table class="table table-sm mb-0">
            <thead class="table-light">
                <tr><th>Nama Produk</th><th>Kategori</th><th>Harga</th><th>Diajukan Oleh</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @foreach($produkPending as $p)
                <tr>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->kategori->nama ?? '-' }}</td>
                    <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                    <td>{{ $p->dibuatOleh->name ?? '-' }}</td>
                    <td>
                        <form action="{{ route('produk.approve', $p) }}" method="POST" class="d-inline">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm btn-success">✓ Setujui</button>
                        </form>
                        <form action="{{ route('produk.destroy', $p) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Tolak produk ini?')">✗ Tolak</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

{{-- Riwayat Aktivitas Kasir Hari Ini --}}
<div class="card border-0 shadow-sm mb-4" style="border-radius:14px">
    <div class="card-body">
        <h6 class="fw-bold mb-3"><i class="bi bi-activity text-primary me-2"></i>Aktivitas Kasir Hari Ini</h6>
        @if($aktivitasHariIni->count() > 0)
        <table class="table table-sm mb-0">
            <thead class="table-light">
                <tr><th>Waktu</th><th>Kasir</th><th>Aksi</th><th>Keterangan</th><th>Nominal</th></tr>
            </thead>
            <tbody>
                @foreach($aktivitasHariIni as $a)
                <tr>
                    <td class="small">{{ $a->created_at->format('H:i') }}</td>
                    <td>{{ $a->user->name ?? '-' }}</td>
                    <td>
                        @if($a->aksi === 'transaksi')
                            <span class="badge bg-success">Transaksi</span>
                        @elseif($a->aksi === 'pemesanan')
                            <span class="badge bg-info">Pemesanan</span>
                        @else
                            <span class="badge bg-warning text-dark">Tambah Produk</span>
                        @endif
                    </td>
                    <td class="small">{{ $a->keterangan }}</td>
                    <td class="small">{{ $a->nominal > 0 ? 'Rp '.number_format($a->nominal,0,',','.') : '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p class="text-muted text-center mb-0">Belum ada aktivitas kasir hari ini</p>
        @endif
    </div>
</div>

{{-- Riwayat Login/Logout Hari Ini --}}
<div class="card border-0 shadow-sm mb-4" style="border-radius:14px">
    <div class="card-body">
        <h6 class="fw-bold mb-3"><i class="bi bi-person-check text-success me-2"></i>Riwayat Login/Logout Hari Ini</h6>
        @if($loginLogs->count() > 0)
        <table class="table table-sm mb-0">
            <thead class="table-light">
                <tr><th>Waktu</th><th>User</th><th>Role</th><th>Aksi</th><th>IP</th></tr>
            </thead>
            <tbody>
                @foreach($loginLogs as $log)
                <tr>
                    <td class="small">{{ $log->created_at->format('H:i') }}</td>
                    <td>{{ $log->user->name ?? '-' }}</td>
                    <td><span class="badge {{ $log->user->role === 'admin' ? 'bg-danger' : 'bg-info' }}">{{ $log->user->role ?? '-' }}</span></td>
                    <td>
                        @if($log->aksi === 'login')
                            <span class="badge bg-success">Login</span>
                        @else
                            <span class="badge bg-secondary">Logout</span>
                        @endif
                    </td>
                    <td class="small text-muted">{{ $log->ip_address }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p class="text-muted text-center mb-0">Belum ada aktivitas login hari ini</p>
        @endif
    </div>
</div>

@endif

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
@php
    $bulanLabels = $grafikBulan->map(fn($b) => \Carbon\Carbon::parse($b->bulan . '-01')->translatedFormat('M Y'))->toArray();
    $bulanPendapatan = $grafikBulan->pluck('total_pendapatan')->toArray();
@endphp
const dashLabels = @json($bulanLabels);
const dashData = @json($bulanPendapatan);

new Chart(document.getElementById('grafikDashboard'), {
    type: 'line',
    data: {
        labels: dashLabels,
        datasets: [{
            label: 'Pendapatan',
            data: dashData,
            borderColor: '#3498db',
            backgroundColor: 'rgba(52,152,219,0.1)',
            borderWidth: 2.5,
            pointBackgroundColor: '#3498db',
            pointRadius: 4,
            tension: 0.4,
            fill: true,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { callback: v => 'Rp ' + Number(v).toLocaleString('id-ID') }
            }
        }
    }
});

// Quick Search Functionality
@if(Auth::user()->role === 'kasir')
const quickSearchInput = document.getElementById('quickSearch');
const searchResults = document.getElementById('searchResults');
let searchTimeout = null;

quickSearchInput.addEventListener('input', function() {
    clearTimeout(searchTimeout);
    const query = this.value.trim();
    
    if (query.length < 2) {
        searchResults.style.display = 'none';
        searchResults.innerHTML = '';
        return;
    }
    
    // Show loading
    searchResults.style.display = 'block';
    searchResults.innerHTML = '<div class="search-loading"><i class="bi bi-hourglass-split"></i> Mencari produk...</div>';
    
    // Debounce search
    searchTimeout = setTimeout(() => {
        fetch("{{ route('produk.quickSearch') }}?q=" + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    searchResults.innerHTML = '<div class="text-center text-muted py-3"><i class="bi bi-inbox"></i><br>Produk tidak ditemukan</div>';
                    return;
                }
                
                let html = '';
                data.forEach(produk => {
                    const stokBadge = produk.stok > 0 
                        ? `<span class="badge bg-success" style="border-radius:50px">${produk.stok} tersedia</span>`
                        : `<span class="badge bg-danger" style="border-radius:50px">Habis</span>`;
                    
                    const imageHtml = produk.foto 
                        ? `<img src="${produk.foto}" alt="${produk.nama}">`
                        : `<div class="no-image"><i class="bi bi-image text-muted"></i></div>`;
                    
                    html += `
                        <div class="search-item d-flex align-items-center gap-3">
                            ${imageHtml}
                            <div class="flex-grow-1">
                                <div class="fw-semibold mb-1">${produk.nama}</div>
                                <div class="small text-muted">
                                    <span class="badge bg-light text-dark me-2" style="border-radius:50px">${produk.kategori}</span>
                                    <span class="text-primary fw-semibold">Rp ${produk.harga}</span>
                                </div>
                            </div>
                            ${stokBadge}
                        </div>
                    `;
                });
                
                searchResults.innerHTML = html;
            })
            .catch(error => {
                console.error('Search error:', error);
                searchResults.innerHTML = '<div class="text-center text-danger py-3"><i class="bi bi-exclamation-triangle"></i><br>Terjadi kesalahan</div>';
            });
    }, 300);
});

// Close search results when clicking outside
document.addEventListener('click', function(e) {
    if (!quickSearchInput.contains(e.target) && !searchResults.contains(e.target)) {
        searchResults.style.display = 'none';
    }
});

// Re-open search results when focusing input
quickSearchInput.addEventListener('focus', function() {
    if (this.value.trim().length >= 2 && searchResults.innerHTML !== '') {
        searchResults.style.display = 'block';
    }
});
@endif
</script>
@endpush
