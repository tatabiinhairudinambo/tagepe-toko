@extends('backend.layout.app')
@section('title', 'Order Customer')
@section('content')

<div class="card border-0 shadow-sm" style="border-radius:14px">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="mb-0">Order dari Customer</h5>
                @if($menunggu > 0)
                    <span class="badge bg-warning text-dark mt-1">{{ $menunggu }} menunggu diproses</span>
                @endif
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="min-width:160px">Kode</th>
                        <th style="min-width:130px">Customer</th>
                        <th style="min-width:100px">Cabang</th>
                        <th style="min-width:110px">Total</th>
                        <th style="min-width:90px">Status</th>
                        <th style="min-width:90px">Waktu</th>
                        <th style="min-width:130px;padding-right:20px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>
                            <strong class="small">{{ $order->kode_order }}</strong>
                            @if($order->catatan)
                                <br><small class="text-muted">{{ \Illuminate\Support\Str::limit($order->catatan, 25) }}</small>
                            @endif
                        </td>
                        <td>
                            <div class="small fw-semibold">{{ $order->nama_customer }}</div>
                            @if($order->telepon)
                                <small class="text-muted">{{ $order->telepon }}</small>
                            @endif
                        </td>
                        <td class="small">{{ $order->cabang->nama_cabang ?? '-' }}</td>
                        <td class="fw-semibold small">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                        <td>
                            @if($order->status === 'menunggu')
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @elseif($order->status === 'diproses')
                                <span class="badge bg-info">Diproses</span>
                            @elseif($order->status === 'selesai')
                                <span class="badge bg-success">Selesai</span>
                            @else
                                <span class="badge bg-secondary">Batal</span>
                            @endif
                        </td>
                        <td class="small text-muted">{{ $order->created_at->format('d/m H:i') }}</td>
                        <td style="padding-right:20px">
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm btn-outline-secondary" title="Detail"
                                        data-bs-toggle="modal" data-bs-target="#detailModal{{ $order->id }}">
                                    <i class="bi bi-eye"></i>
                                </button>
                                @if($order->status === 'menunggu')
                                <form action="{{ route('order.kasir.proses', $order) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-sm btn-info text-white" title="Proses">
                                        <i class="bi bi-gear"></i>
                                    </button>
                                </form>
                                @endif
                                @if(in_array($order->status, ['menunggu','diproses']))
                                <button class="btn btn-sm btn-success" title="Bayar"
                                        data-bs-toggle="modal" data-bs-target="#bayarModal{{ $order->id }}">
                                    <i class="bi bi-cash"></i>
                                </button>
                                <form action="{{ route('order.kasir.batal', $order) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-sm btn-danger" title="Batal"
                                            onclick="return confirm('Batalkan order ini?')">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="bi bi-inbox d-block mb-2" style="font-size:2.5rem"></i>
                            Belum ada order masuk
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $orders->links() }}</div>
    </div>
</div>

{{-- Semua modal di luar tabel --}}
@foreach($orders as $order)

{{-- Modal Detail --}}
<div class="modal fade" id="detailModal{{ $order->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="bi bi-receipt me-2"></i>{{ $order->kode_order }}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-6">
                        <div class="text-muted small">Customer</div>
                        <div class="fw-semibold">{{ $order->nama_customer }}</div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small">Telepon</div>
                        <div class="fw-semibold">{{ $order->telepon ?? '-' }}</div>
                    </div>
                </div>
                @if($order->catatan)
                <div class="alert alert-light py-2 small mb-3">
                    <i class="bi bi-chat-left-text me-1"></i>{{ $order->catatan }}
                </div>
                @endif
                <table class="table table-sm table-bordered mb-0">
                    <thead class="table-light">
                        <tr><th>Produk</th><th class="text-center">Qty</th><th class="text-end">Subtotal</th></tr>
                    </thead>
                    <tbody>
                        @foreach($order->details as $d)
                        <tr>
                            <td>{{ $d->produk->nama }}</td>
                            <td class="text-center">{{ $d->jumlah }}</td>
                            <td class="text-end">Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-light">
                            <td colspan="2" class="fw-bold">Total</td>
                            <td class="text-end fw-bold text-primary">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Bayar --}}
@if(in_array($order->status, ['menunggu','diproses']))
<div class="modal fade" id="bayarModal{{ $order->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="bi bi-cash-coin me-2"></i>Konfirmasi Pembayaran</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('order.kasir.selesai', $order) }}" method="POST">
                @csrf @method('PATCH')
                <div class="modal-body">
                    <div class="alert alert-info py-2 small">
                        <strong>{{ $order->nama_customer }}</strong> — {{ $order->kode_order }}
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Total Tagihan</span>
                        <strong class="text-primary">Rp {{ number_format($order->total, 0, ',', '.') }}</strong>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Uang Bayar</label>
                        <input type="number" name="bayar" class="form-control"
                               min="{{ $order->total }}" placeholder="Masukkan nominal" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-1"></i>Selesaikan & Cetak Struk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@endforeach

@endsection
