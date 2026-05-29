@extends('backend.layout.app')
@section('title', 'Kelola Stok - ' . $cabang->nama_cabang)
@section('content')

<div class="card border-0 shadow-sm" style="border-radius:14px">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="mb-1">Kelola Stok Cabang</h5>
                <p class="text-muted mb-0">{{ $cabang->nama_cabang }} ({{ $cabang->kode_cabang }})</p>
            </div>
            <a href="{{ route('cabang.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('cabang.updateStok', $cabang->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Kode</th>
                            <th width="30%">Nama Produk</th>
                            <th width="15%">Kategori</th>
                            <th width="15%">Harga</th>
                            <th width="20%">Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produks as $produk)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $produk->id }}</strong></td>
                            <td>{{ $produk->nama }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ $produk->kategori->nama ?? '-' }}</span>
                            </td>
                            <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                            <td>
                                <input type="number" 
                                    name="stok[{{ $produk->id }}]" 
                                    class="form-control" 
                                    value="{{ $stoks[$produk->id]->stok ?? 0 }}" 
                                    min="0" 
                                    required>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada produk</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($produks->count() > 0)
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Simpan Stok
                </button>
            </div>
            @endif
        </form>
    </div>
</div>

@endsection
