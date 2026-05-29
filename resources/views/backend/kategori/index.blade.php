@extends('backend.layout.app')
@section('title', 'Data Kategori')
@section('content')
<div class="card border-0 shadow-sm" style="border-radius:12px">
    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center" style="padding:1rem 1.25rem">
        <h5 class="mb-0" style="font-size:1.1rem">Daftar Kategori</h5>
        <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-sm" style="border-radius:8px">
            <i class="bi bi-plus-lg me-1"></i> Tambah
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" style="font-size:.85rem">
                <thead style="background:#f8fafc">
                    <tr>
                        <th class="py-2 px-3" style="font-size:.75rem">NO</th>
                        <th class="py-2 px-3" style="font-size:.75rem">NAMA KATEGORI</th>
                        <th class="py-2 px-3" style="font-size:.75rem">DESKRIPSI</th>
                        <th class="py-2 px-3" style="font-size:.75rem">PRODUK</th>
                        <th class="py-2 px-3" style="font-size:.75rem">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $k)
                    <tr>
                        <td class="py-2 px-3 align-middle">{{ $loop->iteration }}</td>
                        <td class="py-2 px-3 align-middle"><strong>{{ $k->nama }}</strong></td>
                        <td class="py-2 px-3 align-middle">{{ $k->deskripsi ?? '-' }}</td>
                        <td class="py-2 px-3 align-middle">
                            <span class="badge bg-info" style="font-size:.7rem;padding:3px 8px">{{ $k->produks_count }}</span>
                        </td>
                        <td class="py-2 px-3 align-middle">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('kategori.edit', $k) }}" class="btn btn-warning" style="font-size:.75rem;padding:4px 10px" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('kategori.destroy', $k) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger" style="font-size:.75rem;padding:4px 10px" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">Belum ada kategori</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
