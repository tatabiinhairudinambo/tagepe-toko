@extends('layout.app')
@section('title', 'Data Produk')
@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <span class="fw-semibold">Daftar Produk</span>
        <a href="{{ route('produk.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg"></i> Tambah
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produks as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($p->foto)
                            @if(str_starts_with($p->foto, 'http'))
                                <img src="{{ $p->foto }}" alt="{{ $p->nama }}"
                                     style="width:60px;height:60px;object-fit:cover;border-radius:6px">
                            @else
                                <img src="{{ asset('storage/' . $p->foto) }}" alt="{{ $p->nama }}"
                                     style="width:60px;height:60px;object-fit:cover;border-radius:6px">
                            @endif
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center"
                                 style="width:60px;height:60px;border-radius:6px">
                                <i class="bi bi-image text-muted"></i>
                            </div>
                        @endif
                    </td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->kategori->nama ?? '-' }}</td>
                    <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                    <td>{{ $p->stok }}</td>
                    <td>
                        <a href="{{ route('produk.edit', $p) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('produk.destroy', $p) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus produk ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted">Belum ada produk</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
