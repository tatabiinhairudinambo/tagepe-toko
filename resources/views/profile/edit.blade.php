@extends('layout.app')
@section('title', 'Ganti Password')
@section('content')

<div class="card border-0 shadow-sm" style="max-width:480px;border-radius:14px">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-1">Ganti Password</h5>
        <p class="text-muted small mb-4">Pastikan password baru minimal 6 karakter.</p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('profile.password') }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label class="form-label">Password Lama</label>
                <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Password Baru</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Simpan Password</button>
        </form>
    </div>
</div>

@endsection
