@extends('backend.layout.app')
@section('title', 'Data Toko')
@section('content')

<div class="row g-4">
    {{-- Card Informasi Utama --}}
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius:14px">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4">
                    <div style="width:48px;height:48px;background:linear-gradient(135deg,#3498db,#2980b9);border-radius:12px;display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-info-circle text-white" style="font-size:1.5rem"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-0 fw-bold">INFORMASI TAGEPE-DIGITAL UMKM</h5>
                        <p class="text-muted small mb-0">Detail lengkap tentang toko Anda</p>
                    </div>
                </div>

                @if($toko)
                    <div class="row g-3">
                        {{-- data toko --}}
                        <div class="col-12">
                            <div class="p-3 rounded" style="background:#f8f9fa">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-shop text-primary me-3" style="font-size:1.3rem"></i>
                                    <div class="flex-grow-1">
                                        <div class="text-muted small mb-1">TAGEPE-DIGITAL UMKM</div>
                                        <div class="fw-semibold fs-5">{{ $toko->nama_toko }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Alamat --}}
                        <div class="col-12">
                            <div class="p-3 rounded" style="background:#f8f9fa">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-geo-alt text-danger me-3" style="font-size:1.3rem"></i>
                                    <div class="flex-grow-1">
                                        <div class="text-muted small mb-1">Alamat Lengkap</div>
                                        <div class="fw-semibold">{{ $toko->alamat }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Kontak --}}
                        <div class="col-md-6">
                            <div class="p-3 rounded" style="background:#f8f9fa">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-telephone text-success me-3" style="font-size:1.3rem"></i>
                                    <div class="flex-grow-1">
                                        <div class="text-muted small mb-1">Nomor Telepon</div>
                                        <div class="fw-semibold">{{ $toko->telepon }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 rounded" style="background:#f8f9fa">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-envelope text-info me-3" style="font-size:1.3rem"></i>
                                    <div class="flex-grow-1">
                                        <div class="text-muted small mb-1">Email</div>
                                        <div class="fw-semibold">{{ $toko->email ?? '-' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <a href="{{ route('toko.edit', $toko->id) }}" class="btn btn-primary" style="border-radius:8px">
                            <i class="bi bi-pencil me-1"></i> Edit Data Toko
                        </a>
                        <a href="{{ route('katalog') }}" target="_blank" class="btn btn-outline-secondary" style="border-radius:8px">
                            <i class="bi bi-eye me-1"></i> Lihat Katalog Publik
                        </a>
                    </div>
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-exclamation-circle" style="font-size:3rem"></i>
                        <p class="mt-3">Data toko belum tersedia.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Card Logo & Statistik --}}
    <div class="col-lg-4">
        {{-- Logo Toko --}}
        <div class="card border-0 shadow-sm mb-4" style="border-radius:14px">
            <div class="card-body p-4 text-center">
                @if($toko && $toko->logo)
                    @if(str_starts_with($toko->logo, 'http'))
                        <img src="{{ $toko->logo }}" alt="Logo" class="img-fluid rounded" style="max-height:150px;max-width:100%;object-fit:contain">
                    @else
                        <img src="{{ asset('storage/' . $toko->logo) }}" alt="Logo" class="img-fluid rounded" style="max-height:150px;max-width:100%;object-fit:contain">
                    @endif
                @else
                    <div style="width:120px;height:120px;background:linear-gradient(135deg,#3498db,#2c3e50);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto">
                        <i class="bi bi-shop text-white" style="font-size:3rem"></i>
                    </div>
                    <p class="text-muted small mt-3 mb-0">logo gue nanti nyusul</p>
                @endif
            </div>
        </div>

        {{-- Statistik Singkat --}}
        <div class="card border-0 shadow-sm" style="border-radius:14px">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3">Statistik Toko</h6>
                
                <div class="d-flex align-items-center mb-3 p-2 rounded" style="background:#e8f4fd">
                    <div style="width:40px;height:40px;background:#3498db;border-radius:8px;display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-box-seam text-white"></i>
                    </div>
                    <div class="ms-3">
                        <div class="fw-bold fs-5">{{ \App\Models\Produk::count() }}</div>
                        <div class="text-muted small">Total Produk</div>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-3 p-2 rounded" style="background:#fef3e8">
                    <div style="width:40px;height:40px;background:#f39c12;border-radius:8px;display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-tags text-white"></i>
                    </div>
                    <div class="ms-3">
                        <div class="fw-bold fs-5">{{ \App\Models\Kategori::count() }}</div>
                        <div class="text-muted small">Kategori</div>
                    </div>
                </div>

                <div class="d-flex align-items-center p-2 rounded" style="background:#e8f8f5">
                    <div style="width:40px;height:40px;background:#27ae60;border-radius:8px;display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-check-circle text-white"></i>
                    </div>
                    <div class="ms-3">
                        <div class="fw-bold fs-5">{{ \App\Models\Produk::where('stok', '>', 0)->count() }}</div>
                        <div class="text-muted small">Produk Tersedia</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Card Informasi Tambahan --}}
<div class="row mt-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius:14px">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3">
                    <i class="bi bi-lightbulb text-warning me-2"></i>Tips Pengelolaan Toko
                </h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="d-flex align-items-start">
                            <div class="text-primary me-2">1.</div>
                            <div>
                                <div class="fw-semibold small">Update Informasi Secara Berkala</div>
                                <div class="text-muted small">Pastikan data toko selalu up-to-date untuk kepercayaan pelanggan</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-start">
                            <div class="text-primary me-2">2.</div>
                            <div>
                                <div class="fw-semibold small">Gunakan Logo Berkualitas</div>
                                <div class="text-muted small">Logo yang jelas meningkatkan profesionalitas toko Anda</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-start">
                            <div class="text-primary me-2">3.</div>
                            <div>
                                <div class="fw-semibold small">Kelola Produk dengan Baik</div>
                                <div class="text-muted small">Update stok dan harga produk secara rutin</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
