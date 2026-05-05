@extends('layout.app')
@section('title', 'Detail Transaksi')
@section('content')

<div class="card border-0 shadow-sm" style="border-radius:14px">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">Detail Transaksi</h5>
            <div>
                <a href="{{ route('transaksi.struk', $transaksi->id) }}" class="btn btn-secondary" target="_blank">
                    <i class="bi bi-printer"></i> Print Struk
                </a>
                <a href="{{ route('transaksi.laporan') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <td width="150"><strong>Kode Transaksi</strong></td>
                        <td>: {{ $transaksi->kode_transaksi }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal</strong></td>
                        <td>: {{ $transaksi->tanggal->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Kasir</strong></td>
                        <td>: {{ $transaksi->kasir }}</td>
                    </tr>
                    @if($transaksi->cabang)
                    <tr>
                        <td><strong>Cabang</strong></td>
                        <td>: {{ $transaksi->cabang->nama_cabang }} ({{ $transaksi->cabang->kode_cabang }})</td>
                    </tr>
                    @endif
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <td width="150"><strong>Total</strong></td>
                        <td>: Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Bayar</strong></td>
                        <td>: Rp {{ number_format($transaksi->bayar, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Kembalian</strong></td>
                        <td>: Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <hr>

        <h6 class="mb-3">Detail Produk</h6>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksi->details as $detail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $detail->produk->nama }}</strong><br>
                            <small class="text-muted">{{ $detail->produk->kategori->nama ?? '-' }}</small>
                        </td>
                        <td>Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td class="text-end"><strong>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</strong></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <th colspan="4" class="text-end">TOTAL</th>
                        <th class="text-end">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

@endsection
