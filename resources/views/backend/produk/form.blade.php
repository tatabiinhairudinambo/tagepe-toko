@extends('backend.layout.app')
@section('title', isset($produk) ? 'Edit Produk' : 'Tambah Produk')
@section('content')
<div class="card border-0 shadow-sm" style="max-width:500px">
    <div class="card-body">
        {{-- enctype multipart/form-data wajib ada agar file foto bisa dikirim --}}
        <form action="{{ isset($produk) ? route('produk.update', $produk) : route('produk.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($produk)) @method('PUT') @endif

            <div class="mb-3">
                <label class="form-label">Nama Produk</label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                       value="{{ old('nama', $produk->nama ?? '') }}" required>
                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoris as $k)
                        <option value="{{ $k->id }}" {{ old('kategori_id', $produk->kategori_id ?? '') == $k->id ? 'selected' : '' }}>
                            {{ $k->nama }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror"
                       value="{{ old('harga', $produk->harga ?? '') }}" min="0" required>
                @error('harga')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
                       value="{{ old('stok', $produk->stok ?? 0) }}" min="0" required>
                @error('stok')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Stok Minimum <span class="text-muted small">(notifikasi jika stok di bawah ini)</span></label>
                <input type="number" name="stok_minimum" class="form-control"
                       value="{{ old('stok_minimum', $produk->stok_minimum ?? 5) }}" min="0">
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $produk->deskripsi ?? '') }}</textarea>
            </div>

            {{-- Input foto produk --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Foto Produk</label>
                
                {{-- Tab pilihan: Upload atau URL --}}
                <ul class="nav nav-tabs mb-3" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#upload-tab">Upload File</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#url-tab">URL Gambar</button>
                    </li>
                </ul>

                <div class="tab-content">
                    {{-- Tab Upload --}}
                    <div class="tab-pane fade show active" id="upload-tab">
                        @if(isset($produk) && $produk->foto && !str_starts_with($produk->foto, 'http'))
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $produk->foto) }}" alt="Foto" class="img-thumbnail" style="max-height:120px">
                                <div class="text-muted small">Foto saat ini</div>
                            </div>
                        @endif
                        
                        <div id="preview-container" class="mb-2" style="display:none">
                            <img id="preview-image" class="img-thumbnail" style="max-height:120px">
                            <div class="text-success small">✓ Foto siap diupload</div>
                        </div>
                        
                        <input type="file" name="foto" id="foto-input" class="form-control @error('foto') is-invalid @enderror"
                               accept="image/*" onchange="previewFoto(this)">
                        <div class="form-text">Format: JPG, PNG, WEBP. Maks 2MB.</div>
                    </div>

                    {{-- Tab URL --}}
                    <div class="tab-pane fade" id="url-tab">
                        @if(isset($produk) && $produk->foto && str_starts_with($produk->foto, 'http'))
                            <div class="mb-2">
                                <img src="{{ $produk->foto }}" alt="Foto" class="img-thumbnail" style="max-height:120px">
                                <div class="text-muted small">Foto saat ini</div>
                            </div>
                        @endif

                        <div id="preview-url-container" class="mb-2" style="display:none">
                            <img id="preview-url-image" class="img-thumbnail" style="max-height:120px">
                            <div class="text-success small">✓ URL gambar valid</div>
                        </div>

                        <input type="url" name="foto_url" id="foto-url-input" class="form-control"
                               placeholder="https://example.com/gambar.jpg"
                               value="{{ isset($produk) && str_starts_with($produk->foto ?? '', 'http') ? $produk->foto : '' }}"
                               onchange="previewURL(this)">
                        <div class="form-text">Masukkan URL gambar dari internet (misal: https://picsum.photos/200)</div>
                    </div>
                </div>

                @error('foto')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>

            <script>
            function previewFoto(input) {
                const preview = document.getElementById('preview-image');
                const container = document.getElementById('preview-container');
                
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        container.style.display = 'block';
                    }
                    reader.readAsDataURL(input.files[0]);
                    // Clear URL input
                    document.getElementById('foto-url-input').value = '';
                } else {
                    container.style.display = 'none';
                }
            }

            function previewURL(input) {
                const preview = document.getElementById('preview-url-image');
                const container = document.getElementById('preview-url-container');
                
                if (input.value) {
                    preview.src = input.value;
                    preview.onerror = function() {
                        container.style.display = 'none';
                        alert('URL gambar tidak valid atau tidak bisa diakses');
                    };
                    preview.onload = function() {
                        container.style.display = 'block';
                    };
                    // Clear file input
                    document.getElementById('foto-input').value = '';
                } else {
                    container.style.display = 'none';
                }
            }
            </script>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('produk.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
