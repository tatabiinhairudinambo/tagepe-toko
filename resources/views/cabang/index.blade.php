@extends('layout.app')
@section('title', 'Data Cabang')
@section('content')

<div class="card border-0 shadow-sm" style="border-radius:14px">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">Data Cabang</h5>
            <a href="{{ route('cabang.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Tambah Cabang
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Cabang</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Jumlah Produk</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cabangs as $cabang)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $cabang->kode_cabang }}</strong></td>
                        <td>{{ $cabang->nama_cabang }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($cabang->alamat, 50) }}</td>
                        <td>{{ $cabang->telepon }}</td>
                        <td><span class="badge bg-info">{{ $cabang->stok_cabangs_count }} produk</span></td>
                        <td>
                            @if($cabang->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('cabang.stok', $cabang->id) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-box-seam"></i> Stok
                            </a>
                            <a href="{{ route('cabang.edit', $cabang->id) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('cabang.destroy', $cabang->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Belum ada cabang</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
