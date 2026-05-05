@extends('layout.app')
@section('title', 'Edit Data Toko')
@section('content')

<div class="card border-0 shadow-sm" style="border-radius:14px;max-width:600px">
    <div class="card-body p-4">
        <form action="{{ route('toko.update', $toko->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Toko</label>
                <input type="text" name="nama_toko" class="form-control @error('nama_toko') is-invalid @enderror"
                       value="{{ old('nama_toko', $toko->nama_toko) }}" required>
                @error('nama_toko')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Alamat</label>
                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                          rows="3" required>{{ old('alamat', $toko->alamat) }}</textarea>
                @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Telepon</label>
                <input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror"
                       value="{{ old('telepon', $toko->telepon) }}" required>
                @error('telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $toko->email) }}">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">TAGEPE TOKO</label>
                @if($toko->logo)
                    <div class="mb-2">
                        @if(str_starts_with($toko->logo, 'http'))
                            <img src="{{ $toko->logo }}" alt="Logo" style="max-height:80px;border-radius:8px">
                        @else
                            <img src="{{ asset('storage/' . $toko->logo) }}" alt="Logo" style="max-height:80px;border-radius:8px">
                        @endif
                        <div class="text-muted small mt-1">Logo saat ini. Upload baru untuk mengganti.</div>
                    </div>
                @endif

                {{-- Tab Upload atau URL --}}
                <ul class="nav nav-tabs mb-2" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#upload-tab" type="button">
                            <i class="bi bi-upload me-1"></i>Upload File
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#url-tab" type="button">
                            <i class="bi bi-link-45deg me-1"></i>Pakai URL
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    {{-- Tab Upload --}}
                    <div class="tab-pane fade show active" id="upload-tab">
                        <input type="file" name="logo" id="logo-file" class="form-control @error('logo') is-invalid @enderror" accept="image/*" onchange="previewLogo(event)">
                        <div class="form-text">Format: JPG, PNG. Maks 2MB.</div>
                    </div>

                    {{-- Tab URL --}}
                    <div class="tab-pane fade" id="url-tab">
                        <input type="url" name="logo_url" id="logo-url" class="form-control" placeholder="https://example.com/logo.png" onchange="previewLogoUrl(event)">
                        <div class="form-text">Paste URL gambar dari internet (misalnya dari Imgur, Google Drive, dll)</div>
                    </div>
                </div>

                {{-- Preview --}}
                <div id="logo-preview" class="mt-2" style="display:none">
                    <img id="preview-img" src="" alt="Preview" style="max-height:100px;border-radius:8px;border:2px solid #dee2e6">
                </div>

                @error('logo')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>

            <script>
            function previewLogo(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('preview-img').src = e.target.result;
                        document.getElementById('logo-preview').style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                    // Clear URL input
                    document.getElementById('logo-url').value = '';
                }
            }

            function previewLogoUrl(event) {
                const url = event.target.value;
                if (url) {
                    document.getElementById('preview-img').src = url;
                    document.getElementById('logo-preview').style.display = 'block';
                    // Clear file input
                    document.getElementById('logo-file').value = '';
                }
            }
            </script>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary" style="border-radius:8px">
                    <i class="bi bi-check-lg me-1"></i> Simpan
                </button>
                <a href="{{ route('toko.index') }}" class="btn btn-secondary" style="border-radius:8px">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection
