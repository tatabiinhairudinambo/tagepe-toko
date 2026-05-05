@extends('layout.app')
@section('title', isset($cabang) ? 'Edit Cabang' : 'Tambah Cabang')
@section('content')

<div class="card border-0 shadow-sm" style="border-radius:14px">
    <div class="card-body">
        <h5 class="mb-4">{{ isset($cabang) ? 'Edit Cabang' : 'Tambah Cabang' }}</h5>

        <form action="{{ isset($cabang) ? route('cabang.update', $cabang->id) : route('cabang.store') }}" method="POST">
            @csrf
            @if(isset($cabang))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label">Kode Cabang <span class="text-danger">*</span></label>
                <input type="text" name="kode_cabang" class="form-control @error('kode_cabang') is-invalid @enderror" 
                    value="{{ old('kode_cabang', $cabang->kode_cabang ?? '') }}" required>
                @error('kode_cabang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Contoh: CBG-001, PUSAT, CABANG-A</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Cabang <span class="text-danger">*</span></label>
                <input type="text" name="nama_cabang" class="form-control @error('nama_cabang') is-invalid @enderror" 
                    value="{{ old('nama_cabang', $cabang->nama_cabang ?? '') }}" required>
                @error('nama_cabang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat <span class="text-danger">*</span></label>
                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" required>{{ old('alamat', $cabang->alamat ?? '') }}</textarea>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Telepon <span class="text-danger">*</span></label>
                <input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror" 
                    value="{{ old('telepon', $cabang->telepon ?? '') }}" required>
                @error('telepon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                    value="{{ old('email', $cabang->email ?? '') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" 
                        {{ old('is_active', $cabang->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">
                        Cabang Aktif
                    </label>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Simpan
                </button>
                <a href="{{ route('cabang.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
