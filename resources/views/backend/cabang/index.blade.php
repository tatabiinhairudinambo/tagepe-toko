@extends('backend.layout.app')
@section('title', 'Data Cabang')
@section('content')

<div class="card border-0 shadow-sm" style="border-radius:12px">
    <div class="card-body p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0" style="font-size:1.1rem">Data Cabang</h5>
            <a href="{{ route('cabang.create') }}" class="btn btn-primary btn-sm" style="border-radius:8px">
                <i class="bi bi-plus-lg me-1"></i> Tambah Cabang
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" style="font-size:.9rem;padding:10px 15px">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover mb-0" style="font-size:.85rem">
                <thead style="background:#f8fafc">
                    <tr>
                        <th class="py-2 px-3" style="font-size:.75rem">NO</th>
                        <th class="py-2 px-3" style="font-size:.75rem">KODE</th>
                        <th class="py-2 px-3" style="font-size:.75rem">NAMA CABANG</th>
                        <th class="py-2 px-3" style="font-size:.75rem">ALAMAT</th>
                        <th class="py-2 px-3" style="font-size:.75rem">TELEPON</th>
                        <th class="py-2 px-3" style="font-size:.75rem">PRODUK</th>
                        <th class="py-2 px-3" style="font-size:.75rem">STATUS</th>
                        <th class="py-2 px-3" style="font-size:.75rem">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cabangs as $cabang)
                    <tr>
                        <td class="py-2 px-3 align-middle">{{ $loop->iteration }}</td>
                        <td class="py-2 px-3 align-middle"><strong>{{ $cabang->kode_cabang }}</strong></td>
                        <td class="py-2 px-3 align-middle">{{ $cabang->nama_cabang }}</td>
                        <td class="py-2 px-3 align-middle" style="max-width:200px">
                            <span class="text-truncate d-inline-block" style="max-width:200px" title="{{ $cabang->alamat }}">
                                {{ $cabang->alamat }}
                            </span>
                        </td>
                        <td class="py-2 px-3 align-middle">{{ $cabang->telepon }}</td>
                        <td class="py-2 px-3 align-middle">
                            <span class="badge bg-info" style="font-size:.7rem;padding:3px 8px">{{ $cabang->stok_cabangs_count }}</span>
                        </td>
                        <td class="py-2 px-3 align-middle">
                            @if($cabang->is_active)
                                <span class="badge bg-success" style="font-size:.7rem;padding:3px 8px">Aktif</span>
                            @else
                                <span class="badge bg-secondary" style="font-size:.7rem;padding:3px 8px">Nonaktif</span>
                            @endif
                        </td>
                        <td class="py-2 px-3 align-middle">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('cabang.stok', $cabang->id) }}" class="btn btn-info" style="font-size:.75rem;padding:4px 10px" title="Stok">
                                    <i class="bi bi-box-seam"></i>
                                </a>
                                <a href="{{ route('cabang.edit', $cabang->id) }}" class="btn btn-warning" style="font-size:.75rem;padding:4px 10px" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('cabang.destroy', $cabang->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" style="font-size:.75rem;padding:4px 10px" onclick="return confirm('Yakin hapus?')" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">Belum ada cabang</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
