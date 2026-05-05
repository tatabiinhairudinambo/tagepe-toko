@extends('layout.app')
@section('title', 'Data Produk')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0">Daftar Produk</h5>
    <div class="d-flex gap-2">
        {{-- Search --}}
        <input type="text" id="searchProduk" class="form-control form-control-sm" placeholder="🔍 Cari produk..." style="width:200px">
        {{-- Tombol tambah untuk semua (admin langsung aktif, kasir pending) --}}
        <a href="{{ route('produk.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i>
            {{ Auth::user()->role === 'kasir' ? 'Ajukan Produk' : 'Tambah Produk' }}
        </a>
        {{-- Toggle view --}}
        <button class="btn btn-outline-secondary btn-sm" id="toggleView" title="Ganti tampilan">
            <i class="bi bi-list" id="toggleIcon"></i>
        </button>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- Grid View --}}
<div id="gridView">
    <div class="row g-3">
        @forelse($produks as $p)
        @php
            $foto = $p->foto
                ? (str_starts_with($p->foto, 'http') ? $p->foto : asset('storage/'.$p->foto))
                : null;
        @endphp
        <div class="col-6 col-md-3 col-lg-2">
            <div class="card border-0 shadow-sm h-100" style="border-radius:12px;overflow:hidden">
                {{-- Foto --}}
                <div style="height:150px;background:#f0f4f8;overflow:hidden;position:relative">
                    @if($foto)
                        <img src="{{ $foto }}" alt="{{ $p->nama }}"
                             style="width:100%;height:100%;object-fit:cover"
                             data-bs-toggle="modal" data-bs-target="#fotoModal{{ $p->id }}"
                             class="cursor-pointer" style="cursor:pointer">
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <i class="bi bi-image text-muted" style="font-size:3rem"></i>
                        </div>
                    @endif
                    {{-- Badge status --}}
                    @if(isset($p->status) && $p->status === 'pending')
                        <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-1" style="font-size:.65rem">Pending</span>
                    @endif
                    {{-- Badge stok habis --}}
                    @if($p->stok <= 0)
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
                             style="background:rgba(0,0,0,.4)">
                            <span class="badge bg-danger">Stok Habis</span>
                        </div>
                    @endif
                </div>
                <div class="card-body p-2">
                    <div class="fw-semibold small mb-1" style="font-size:.82rem;line-height:1.3">{{ $p->nama }}</div>
                    <div class="text-muted small mb-1" style="font-size:.75rem">{{ $p->kategori->nama ?? '-' }}</div>
                    <div class="text-primary fw-bold small">Rp {{ number_format($p->harga, 0, ',', '.') }}</div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <span class="badge {{ $p->stok > 0 ? 'bg-success' : 'bg-secondary' }}" style="font-size:.7rem">
                            Stok: {{ $p->stok }}
                        </span>
                        @if(Auth::user()->role === 'admin')
                        <div class="d-flex gap-1">
                            <a href="{{ route('produk.edit', $p) }}" class="btn btn-xs btn-warning p-1" style="font-size:.7rem;line-height:1">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('produk.destroy', $p) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Hapus produk ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-xs btn-danger p-1" style="font-size:.7rem;line-height:1">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal foto besar --}}
        @if($foto)
        <div class="modal fade" id="fotoModal{{ $p->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-header border-0 pb-0">
                        <h6 class="modal-title fw-bold">{{ $p->nama }}</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ $foto }}" alt="{{ $p->nama }}" class="img-fluid rounded" style="max-height:400px">
                        <div class="mt-3 text-start">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-muted small">Kategori</span>
                                <span class="small fw-semibold">{{ $p->kategori->nama ?? '-' }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-muted small">Harga</span>
                                <span class="small fw-bold text-primary">Rp {{ number_format($p->harga, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted small">Stok</span>
                                <span class="small fw-semibold">{{ $p->stok }}</span>
                            </div>
                            @if($p->deskripsi)
                            <div class="mt-2 pt-2 border-top">
                                <p class="small text-muted mb-0">{{ $p->deskripsi }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @empty
        <div class="col-12 text-center text-muted py-5">
            <i class="bi bi-box-seam d-block mb-2" style="font-size:3rem"></i>
            Belum ada produk
        </div>
        @endforelse
    </div>
</div>

{{-- List View (tersembunyi default) --}}
<div id="listView" style="display:none">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th><th>Foto</th><th>Nama</th><th>Kategori</th><th>Harga</th><th>Stok</th>
                        @if(Auth::user()->role === 'admin')<th>Aksi</th>@endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($produks as $p)
                    @php
                        $foto = $p->foto ? (str_starts_with($p->foto,'http') ? $p->foto : asset('storage/'.$p->foto)) : null;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($foto)
                                <img src="{{ $foto }}" style="width:50px;height:50px;object-fit:cover;border-radius:8px">
                            @else
                                <div style="width:50px;height:50px;background:#f0f4f8;border-radius:8px;display:flex;align-items:center;justify-content:center">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $p->nama }}</td>
                        <td>{{ $p->kategori->nama ?? '-' }}</td>
                        <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                        <td><span class="badge {{ $p->stok > 0 ? 'bg-success' : 'bg-secondary' }}">{{ $p->stok }}</span></td>
                        @if(Auth::user()->role === 'admin')
                        <td>
                            <a href="{{ route('produk.edit', $p) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('produk.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">Belum ada produk</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Pencarian live produk
document.getElementById('searchProduk').addEventListener('input', function() {
    const keyword = this.value.toLowerCase();

    // Grid view
    document.querySelectorAll('#gridView .col-6').forEach(col => {
        const nama = col.querySelector('.fw-semibold')?.textContent.toLowerCase() || '';
        const kategori = col.querySelector('.text-muted')?.textContent.toLowerCase() || '';
        col.style.display = (nama.includes(keyword) || kategori.includes(keyword)) ? '' : 'none';
    });

    // List view
    document.querySelectorAll('#listView tbody tr').forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(keyword) ? '' : 'none';
    });
});

let isGrid = true;
document.getElementById('toggleView').addEventListener('click', function() {
    isGrid = !isGrid;
    document.getElementById('gridView').style.display = isGrid ? 'block' : 'none';
    document.getElementById('listView').style.display = isGrid ? 'none' : 'block';
    document.getElementById('toggleIcon').className = isGrid ? 'bi bi-list' : 'bi bi-grid-3x3-gap';
});
</script>
@endpush

@endsection
