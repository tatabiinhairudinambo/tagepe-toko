@extends('backend.layout.app')
@section('title', isset($kategori) ? 'Edit Kategori' : 'Tambah Kategori')
@section('content')
<div class="card border-0 shadow-sm" style="max-width:500px">
    <div class="card-body">
        <form action="{{ isset($kategori) ? route('kategori.update', $kategori) : route('kategori.store') }}" method="POST">
            @csrf
            @if(isset($kategori)) @method('PUT') @endif

            <div class="mb-3">
                <label class="form-label">Nama Kategori</label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                       value="{{ old('nama', $kategori->nama ?? '') }}" required>
                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $kategori->deskripsi ?? '') }}</textarea>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
