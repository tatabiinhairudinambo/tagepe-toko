@extends('layout.app')
@section('title', 'Data Kategori')
@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <span class="fw-semibold">Daftar Kategori</span>
        <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg"></i> Tambah
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Produk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategoris as $k)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $k->nama }}</td>
                    <td>{{ $k->deskripsi ?? '-' }}</td>
                    <td>{{ $k->produks_count }}</td>
                    <td>
                        <a href="{{ route('kategori.edit', $k) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('kategori.destroy', $k) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted">Belum ada kategori</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
