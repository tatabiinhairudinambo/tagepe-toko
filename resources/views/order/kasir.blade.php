@extends('layout.app')
@section('title', 'Order Publik')
@section('content')

<div class="card border-0 shadow-sm" style="border-radius:14px">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="mb-0">Order dari Customer</h5>
                @if($menunggu > 0)
                    <span class="badge bg-warning text-dark">{{ $menunggu }} order menunggu</span>
                @endif
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>Customer</th>
                        <th>Telepon</th>
                        <th>Cabang</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td><strong>{{ $order->kode_order }}</strong></td>
                        <td>
                            {{ $order->nama_customer }}
                            @if($order->catatan)
                                <br><small class="text-muted">{{ $order->catatan }}</small>
                            @endif
                        </td>
                        <td>{{ $order->telepon ?? '-' }}</td>
                        <td>{{ $order->cabang->nama_cabang ?? '-' }}</td>
                        <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
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
                        <td class="small">{{ $order->created_at->format('d/m H:i') }}</td>
                        <td>
                            {{-- Detail produk --}}
                            <button class="btn btn-sm btn-outline-info mb-1" data-bs-toggle="modal"
                                    data-bs-target="#detailModal{{ $order->id }}">
                                <i class="bi bi-eye"></i>
                            </button>

                            @if($order->status === 'menunggu')
                            <form action="{{ route('order.kasir.proses', $order) }}" method="POST" class="d-inline">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm btn-info mb-1">Proses</button>
                            </form>
                            @endif

                            @if(in_array($order->status, ['menunggu', 'diproses']))
                            <button class="btn btn-sm btn-success mb-1" data-bs-toggle="modal"
                                    data-bs-target="#bayarModal{{ $order->id }}">
                                <i class="bi bi-cash"></i> Bayar
                            </button>
                            <form action="{{ route('order.kasir.batal', $order) }}" method="POST" class="d-inline">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm btn-danger mb-1" onclick="return confirm('Batalkan order?')">
                                    <i class="bi bi-x"></i>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>

                    {{-- Modal Detail --}}
                    <div class="modal fade" id="detailModal{{ $order->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title">Detail Order {{ $order->kode_order }}</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="mb-1"><strong>Customer:</strong> {{ $order->nama_customer }}</p>
                                    <p class="mb-1"><strong>Telepon:</strong> {{ $order->telepon ?? '-' }}</p>
                                    @if($order->catatan)
                                    <p class="mb-3"><strong>Catatan:</strong> {{ $order->catatan }}</p>
                                    @endif
                                    <table class="table table-sm">
                                        <thead><tr><th>Produk</th><th>Qty</th><th>Subtotal</th></tr></thead>
                                        <tbody>
                                            @foreach($order->details as $d)
                                            <tr>
                                                <td>{{ $d->produk->nama }}</td>
                                                <td>{{ $d->jumlah }}</td>
                                                <td>Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr><td colspan="2"><strong>Total</strong></td>
                                            <td><strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong></td></tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Bayar --}}
                    @if(in_array($order->status, ['menunggu', 'diproses']))
                    <div class="modal fade" id="bayarModal{{ $order->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title">Konfirmasi Pembayaran</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('order.kasir.selesai', $order) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <div class="modal-body">
                                        <p>Total: <strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong></p>
                                        <div class="mb-3">
                                            <label class="form-label">Uang Bayar</label>
                                            <input type="number" name="bayar" class="form-control"
                                                   min="{{ $order->total }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Selesaikan & Cetak Struk</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif

                    @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">Belum ada order masuk</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $orders->links() }}
    </div>
</div>

@endsection
