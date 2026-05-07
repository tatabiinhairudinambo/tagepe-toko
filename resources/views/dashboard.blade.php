@extends('layout.app')
@section('title', 'Dashboard')
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
<div class="alert border-0 shadow-sm mb-4 d-flex align-items-center gap-3" 
     style="background:linear-gradient(135deg,#3498db,#2980b9);color:white;border-radius:14px">
    <i class="bi bi-building" style="font-size:2rem"></i>
    <div>
        <div class="fw-bold" style="font-size:1.1rem">{{ $cabang->nama_cabang ?? 'Belum ada cabang' }}</div>
        <div class="small opacity-75">Pendapatan hari ini: Rp {{ number_format(\App\Models\Transaksi::where('cabang_id', Auth::user()->cabang_id)->whereDate('tanggal', today())->sum('total'), 0, ',', '.') }}</div>
    </div>
    <div class="ms-auto text-end">
        <div class="small opacity-75">Total Transaksi</div>
        <div class="fw-bold fs-4">{{ $totalTransaksi }}</div>
    </div>
</div>
@endif

{{-- Stat Cards --}}
<div class="row g-4 mb-4">
    @if(Auth::user()->role === 'admin')
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px!important;overflow:hidden">
            <div class="card-body p-0">
                <div class="d-flex">
                    <div class="flex-grow-1 p-4">
                        <div class="text-muted small fw-semibold text-uppercase mb-1" style="letter-spacing:.5px">Total Kategori</div>
                        <div class="display-6 fw-bold text-dark">{{ $totalKategori }}</div>
                        <a href="{{ route('kategori.index') }}" class="text-decoration-none small text-primary mt-2 d-inline-block">
                            Lihat semua <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                    <div class="d-flex align-items-center justify-content-center px-4"
                         style="background:linear-gradient(135deg,#3498db,#2980b9);min-width:90px">
                        <i class="bi bi-tags text-white" style="font-size:2.2rem"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px!important;overflow:hidden">
            <div class="card-body p-0">
                <div class="d-flex">
                    <div class="flex-grow-1 p-4">
                        <div class="text-muted small fw-semibold text-uppercase mb-1" style="letter-spacing:.5px">Total Produk</div>
                        <div class="display-6 fw-bold text-dark">{{ $totalProduk }}</div>
                        <a href="{{ route('produk.index') }}" class="text-decoration-none small text-success mt-2 d-inline-block">
                            Lihat semua <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                    <div class="d-flex align-items-center justify-content-center px-4"
                         style="background:linear-gradient(135deg,#2ecc71,#27ae60);min-width:90px">
                        <i class="bi bi-box-seam text-white" style="font-size:2.2rem"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px!important;overflow:hidden">
            <div class="card-body p-0">
                <div class="d-flex">
                    <div class="flex-grow-1 p-4">
                        <div class="text-muted small fw-semibold text-uppercase mb-1" style="letter-spacing:.5px">Total Nilai Stok</div>
                        <div class="fw-bold text-dark" style="font-size:1.5rem">
                            Rp {{ number_format($totalNilai, 0, ',', '.') }}
                        </div>
                        <span class="text-muted small mt-2 d-inline-block">harga × stok semua produk</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-center px-4"
                         style="background:linear-gradient(135deg,#f39c12,#e67e22);min-width:90px">
                        <i class="bi bi-cash-stack text-white" style="font-size:2.2rem"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px!important;overflow:hidden">
            <div class="card-body p-0">
                <div class="d-flex">
                    <div class="flex-grow-1 p-4">
                        <div class="text-muted small fw-semibold text-uppercase mb-1" style="letter-spacing:.5px">Total Pendapatan</div>
                        <div class="fw-bold text-dark" style="font-size:1.3rem">
                            Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                        </div>
                        <span class="text-muted small mt-2 d-inline-block">semua transaksi</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-center px-4"
                         style="background:linear-gradient(135deg,#9b59b6,#8e44ad);min-width:90px">
                        <i class="bi bi-graph-up-arrow text-white" style="font-size:2.2rem"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

{{-- Grafik Pendapatan Per Bulan --}}
@if(Auth::user()->role === 'admin')
<div class="card border-0 shadow-sm mb-4" style="border-radius:14px">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h6 class="fw-bold mb-0">Pendapatan Per Bulan</h6>
                <p class="text-muted small mb-0">12 bulan terakhir</p>
            </div>
            <a href="{{ route('transaksi.laporan') }}" class="btn btn-sm btn-outline-primary" style="border-radius:8px">
                Lihat Laporan
            </a>
        </div>
        <canvas id="grafikDashboard" height="80"></canvas>
    </div>
</div>
@endif

{{-- Produk Terbaru --}}
<div class="card border-0 shadow-sm mb-4" style="border-radius:14px!important">
    <div class="card-header bg-white border-0 pt-4 px-4 pb-0 d-flex justify-content-between align-items-center">
        <div>
            <h6 class="fw-bold mb-0">Produk Terbaru</h6>
            <p class="text-muted small mb-0">5 produk yang baru ditambahkan</p>
        </div>
        <a href="{{ route('produk.index') }}" class="btn btn-sm btn-outline-primary" style="border-radius:8px">Lihat Semua</a>
    </div>
    <div class="card-body p-0 mt-3">
        <table class="table table-hover mb-0">
            <thead style="background:#f8fafc">
                <tr>
                    <th class="ps-4 py-3 text-muted small fw-semibold border-0">PRODUK</th>
                    <th class="py-3 text-muted small fw-semibold border-0">KATEGORI</th>
                    <th class="py-3 text-muted small fw-semibold border-0">HARGA</th>
                    <th class="py-3 text-muted small fw-semibold border-0">STOK</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produkTerbaru as $p)
                <tr>
                    <td class="ps-4 py-3 align-middle">
                        <div class="d-flex align-items-center gap-3">
                            @if($p->foto)
                                <img src="{{ asset('storage/' . $p->foto) }}" alt="" style="width:40px;height:40px;object-fit:cover;border-radius:8px">
                            @else
                                <div style="width:40px;height:40px;background:#e8edf2;border-radius:8px;display:flex;align-items:center;justify-content:center">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                            @endif
                            <span class="fw-semibold">{{ $p->nama }}</span>
                        </div>
                    </td>
                    <td class="py-3 align-middle">
                        <span style="background:#e8f4fd;color:#2980b9;font-size:.78rem;font-weight:600;padding:4px 10px;border-radius:50px">
                            {{ $p->kategori->nama ?? '-' }}
                        </span>
                    </td>
                    <td class="py-3 align-middle fw-semibold">Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                    <td class="py-3 align-middle">
                        @if($p->stok > 0)
                            <span class="badge bg-success" style="border-radius:50px;padding:4px 10px">{{ $p->stok }}</span>
                        @else
                            <span class="badge bg-secondary" style="border-radius:50px;padding:4px 10px">Habis</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted py-5">Belum ada produk</td></tr>
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
</script>
@endpush
