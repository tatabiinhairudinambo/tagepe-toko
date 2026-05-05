@extends('layout.app')
@section('title', 'Laporan Transaksi')
@section('content')

<div class="card border-0 shadow-sm" style="border-radius:14px">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">Laporan Transaksi</h5>
            <a href="{{ route('transaksi.index') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Transaksi Baru
            </a>
        </div>

        <!-- Filter -->
        <form method="GET" class="row g-3 mb-4">
            <div class="col-md-4">
                <label class="form-label">Dari Tanggal</label>
                <input type="date" name="tanggal_dari" class="form-control" value="{{ request('tanggal_dari') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Sampai Tanggal</label>
                <input type="date" name="tanggal_sampai" class="form-control" value="{{ request('tanggal_sampai') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">&nbsp;</label>
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </form>

        <!-- Total Pendapatan -->
        <div class="alert alert-success">
            <strong>Total Pendapatan:</strong> Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
        </div>

        <!-- Tabel Transaksi -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Tanggal</th>
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
                        <td colspan="6" class="text-center text-muted">Belum ada transaksi</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $transaksis->links() }}
    </div>
</div>

@endsection
