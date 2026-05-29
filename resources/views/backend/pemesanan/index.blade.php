@extends('backend.layout.app')
@section('title', 'Daftar Pesanan')
@section('content')

<div class="card border-0 shadow-sm" style="border-radius:14px">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">Daftar Pesanan</h5>
            <a href="{{ route('pemesanan.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Buat Pesanan
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>Pelanggan</th>
                        <th>Kasir</th>
                        <th>Cabang</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pemesanans as $p)
                    <tr>
                        <td><strong>{{ $p->kode_pesan }}</strong></td>
                        <td>{{ $p->nama_pelanggan ?? '-' }}</td>
                        <td>{{ $p->kasir }}</td>
                        <td>{{ $p->cabang->nama_cabang ?? '-' }}</td>
                        <td>Rp {{ number_format($p->total, 0, ',', '.') }}</td>
                        <td>
                            @if($p->status === 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($p->status === 'dibayar')
                                <span class="badge bg-success">Dibayar</span>
                            @else
                                <span class="badge bg-secondary">Batal</span>
                            @endif
                        </td>
                        <td>{{ $p->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('pemesanan.nota', $p->id) }}" class="btn btn-sm btn-secondary" target="_blank">
                                <i class="bi bi-printer"></i>
                            </a>
                            @if($p->status === 'pending')
                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#bayarModal{{ $p->id }}">
                                <i class="bi bi-cash"></i> Bayar
                            </button>
                            <form action="{{ route('pemesanan.batal', $p->id) }}" method="POST" class="d-inline">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Batalkan pesanan?')">
                                    <i class="bi bi-x"></i>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>

                    {{-- Modal Bayar --}}
                    @if($p->status === 'pending')
                    <div class="modal fade" id="bayarModal{{ $p->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Konfirmasi Pembayaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('pemesanan.bayar', $p->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <div class="modal-body">
                                        <p>Total: <strong>Rp {{ number_format($p->total, 0, ',', '.') }}</strong></p>
                                        <div class="mb-3">
                                            <label class="form-label">Uang Bayar</label>
                                            <input type="number" name="bayar" class="form-control" min="{{ $p->total }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Konfirmasi Bayar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif

                    @empty
                    <tr><td colspan="8" class="text-center text-muted">Belum ada pesanan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $pemesanans->links() }}
    </div>
</div>
@endsection
