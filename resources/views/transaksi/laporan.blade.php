@extends('layout.app')
@section('title', 'Laporan Transaksi')
@section('content')

<div class="card border-0 shadow-sm" style="border-radius:14px">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">Laporan Transaksi</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('transaksi.export.pdf', request()->query()) }}" class="btn btn-danger btn-sm" target="_blank">
                    <i class="bi bi-file-pdf me-1"></i> Export PDF
                </a>
                <a href="{{ route('transaksi.export.csv', request()->query()) }}" class="btn btn-success btn-sm">
                    <i class="bi bi-file-excel me-1"></i> Export Excel
                </a>
                <a href="{{ route('transaksi.index') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg me-1"></i> Transaksi Baru
                </a>
            </div>
        </div>

        <!-- Filter -->
        <form method="GET" class="row g-3 mb-4">
            <div class="col-md-3">
                <label class="form-label">Cari</label>
                <input type="text" name="search" class="form-control" placeholder="Kode / kasir / cabang..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Dari Tanggal</label>
                <input type="date" name="tanggal_dari" class="form-control" value="{{ request('tanggal_dari') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Sampai Tanggal</label>
                <input type="date" name="tanggal_sampai" class="form-control" value="{{ request('tanggal_sampai') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">&nbsp;</label>
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </form>

        <!-- Total Pendapatan -->
        <div class="alert alert-success">
            <strong>Total Pendapatan:</strong> Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
        </div>

        <!-- Grafik -->
        @if(count($grafikLabels) > 0)
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="mb-3">Grafik Pendapatan</h6>
                        <canvas id="grafikPendapatan" height="100"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="mb-3">Jumlah Transaksi</h6>
                        <canvas id="grafikJumlah" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Tabel Transaksi -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Tanggal</th>
                        <th>Cabang</th>
                        <th>Total</th>
                        <th>Kasir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $transaksi)
                    <tr>
                        <td>{{ $loop->iteration + ($transaksis->currentPage() - 1) * $transaksis->perPage() }}</td>
                        <td><strong>{{ $transaksi->kode_transaksi }}</strong></td>
                        <td>{{ $transaksi->tanggal->format('d/m/Y H:i') }}</td>
                        <td>
                            @if($transaksi->cabang)
                                <span class="badge bg-info">{{ $transaksi->cabang->kode_cabang }}</span>
                            @else
                                <span class="badge bg-secondary">-</span>
                            @endif
                        </td>
                        <td>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
                        <td>{{ $transaksi->kasir }}</td>
                        <td>
                            <a href="{{ route('transaksi.show', $transaksi->id) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                            <a href="{{ route('transaksi.struk', $transaksi->id) }}" class="btn btn-sm btn-secondary" target="_blank">
                                <i class="bi bi-printer"></i> Struk
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada transaksi</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $transaksis->links() }}
    </div>
</div>

@if(count($grafikLabels) > 0)
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const labels = @json($grafikLabels);
const pendapatan = @json($grafikPendapatan);
const jumlah = @json($grafikJumlah);

new Chart(document.getElementById('grafikPendapatan'), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Pendapatan (Rp)',
            data: pendapatan,
            backgroundColor: 'rgba(52, 152, 219, 0.7)',
            borderColor: 'rgba(52, 152, 219, 1)',
            borderWidth: 1,
            borderRadius: 4,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { ticks: { callback: v => 'Rp ' + v.toLocaleString('id-ID') } }
        }
    }
});

new Chart(document.getElementById('grafikJumlah'), {
    type: 'doughnut',
    data: {
        labels: labels,
        datasets: [{
            data: jumlah,
            backgroundColor: labels.map((_, i) => `hsl(${i * 360 / labels.length}, 70%, 60%)`),
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } } }
    }
});
</script>
@endif

@endsection
