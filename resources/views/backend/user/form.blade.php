@extends('backend.layout.app')
@section('title', isset($user) ? 'Edit User' : 'Tambah User')
@section('content')

<div class="card border-0 shadow-sm" style="max-width:500px;border-radius:14px">
    <div class="card-body">
        <form action="{{ isset($user) ? route('user.update', $user) : route('user.store') }}" method="POST">
            @csrf
            @if(isset($user)) @method('PUT') @endif

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $user->name ?? '') }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $user->email ?? '') }}" required>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-select @error('role') is-invalid @enderror" required id="role-select">
                    <option value="kasir" {{ old('role', $user->role ?? '') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                    <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3" id="cabang-field">
                <label class="form-label">Cabang <span class="text-muted small">(khusus kasir)</span></label>
                <select name="cabang_id" class="form-select @error('cabang_id') is-invalid @enderror">
                    <option value="">-- Pilih Cabang --</option>
                    @foreach($cabangs as $cabang)
                        <option value="{{ $cabang->id }}" {{ old('cabang_id', $user->cabang_id ?? '') == $cabang->id ? 'selected' : '' }}>
                            {{ $cabang->nama_cabang }}
                        </option>
                    @endforeach
                </select>
                @error('cabang_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <script>
            function toggleCabang() {
                const role = document.getElementById('role-select').value;
                document.getElementById('cabang-field').style.display = role === 'kasir' ? 'block' : 'none';
            }
            document.getElementById('role-select').addEventListener('change', toggleCabang);
            toggleCabang();
            </script>

            <div class="mb-3">
                <label class="form-label">Password {{ isset($user) ? '(kosongkan jika tidak diubah)' : '' }}</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       {{ isset($user) ? '' : 'required' }}>
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control"
                       {{ isset($user) ? '' : 'required' }}>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection
