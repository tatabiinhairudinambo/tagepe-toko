@extends('layout.app')
@section('title', 'Dashboard')
@section('content')

{{-- Stat Cards --}}
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px!important;overflow:hidden">
            <div class="card-body p-0">
                <div class="d-flex">
                    <div class="flex-grow-1 p-4">
                        <div class="text-muted small fw-semibold text-uppercase mb-1" style="letter-spacing:.5px">Total Kategori</div>
                        <div class="display-6 fw-bold text-dark">{{ $totalKategori }}</div>
                        <a href="{{ route('kategori.index') }}" class="text-decoration-none small text-primary mt-2 d-inline-block">
                            Lihat semua <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                    <div class="d-flex align-items-center justify-content-center px-4"
                         style="background:linear-gradient(135deg,#3498db,#2980b9);min-width:90px">
                        <i class="bi bi-tags text-white" style="font-size:2.2rem"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px!important;overflow:hidden">
            <div class="card-body p-0">
                <div class="d-flex">
                    <div class="flex-grow-1 p-4">
                        <div class="text-muted small fw-semibold text-uppercase mb-1" style="letter-spacing:.5px">Total Produk</div>
                        <div class="display-6 fw-bold text-dark">{{ $totalProduk }}</div>
                        <a href="{{ route('produk.index') }}" class="text-decoration-none small text-success mt-2 d-inline-block">
                            Lihat semua <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                    <div class="d-flex align-items-center justify-content-center px-4"
                         style="background:linear-gradient(135deg,#2ecc71,#27ae60);min-width:90px">
                        <i class="bi bi-box-seam text-white" style="font-size:2.2rem"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px!important;overflow:hidden">
            <div class="card-body p-0">
                <div class="d-flex">
                    <div class="flex-grow-1 p-4">
                        <div class="text-muted small fw-semibold text-uppercase mb-1" style="letter-spacing:.5px">Total Nilai Stok</div>
                        <div class="fw-bold text-dark" style="font-size:1.5rem">
                            Rp {{ number_format($totalNilai, 0, ',', '.') }}
                        </div>
                        <span class="text-muted small mt-2 d-inline-block">harga × stok semua produk</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-center px-4"
                         style="background:linear-gradient(135deg,#f39c12,#e67e22);min-width:90px">
                        <i class="bi bi-cash-stack text-white" style="font-size:2.2rem"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Produk Terbaru --}}
<div class="card border-0 shadow-sm" style="border-radius:14px!important">
    <div class="card-header bg-white border-0 pt-4 px-4 pb-0 d-flex justify-content-between align-items-center">
        <div>
            <h6 class="fw-bold mb-0">Produk Terbaru</h6>
            <p class="text-muted small mb-0">5 produk yang baru ditambahkan</p>
        </div>
        <a href="{{ route('produk.index') }}" class="btn btn-sm btn-outline-primary" style="border-radius:8px">
            Lihat Semua
        </a>
    </div>
    <div class="card-body p-0 mt-3">
        <table class="table table-hover mb-0">
            <thead style="background:#f8fafc">
                <tr>
                    <th class="ps-4 py-3 text-muted small fw-semibold border-0">PRODUK</th>
                    <th class="py-3 text-muted small fw-semibold border-0">KATEGORI</th>
                    <th class="py-3 text-muted small fw-semibold border-0">HARGA</th>
                    <th class="py-3 text-muted small fw-semibold border-0">STOK</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produkTerbaru as $p)
                <tr>
                    <td class="ps-4 py-3 align-middle">
                        <div class="d-flex align-items-center gap-3">
                            @if($p->foto)
                                <img src="{{ asset('storage/' . $p->foto) }}" alt=""
                                     style="width:40px;height:40px;object-fit:cover;border-radius:8px">
                            @else
                                <div style="width:40px;height:40px;background:#e8edf2;border-radius:8px;display:flex;align-items:center;justify-content:center">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                            @endif
                            <span class="fw-semibold">{{ $p->nama }}</span>
                        </div>
                    </td>
                    <td class="py-3 align-middle">
                        <span style="background:#e8f4fd;color:#2980b9;font-size:.78rem;font-weight:600;padding:4px 10px;border-radius:50px">
                            {{ $p->kategori->nama ?? '-' }}
                        </span>
                    </td>
                    <td class="py-3 align-middle fw-semibold">Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                    <td class="py-3 align-middle">
                        @if($p->stok > 0)
                            <span class="badge bg-success" style="border-radius:50px;padding:4px 10px">{{ $p->stok }}</span>
                        @else
                            <span class="badge bg-secondary" style="border-radius:50px;padding:4px 10px">Habis</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-5">
                        <i class="bi bi-box-seam d-block mb-2" style="font-size:2rem"></i>
                        Belum ada produk
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
