@extends('backend.layout.app')
@section('title', 'Manajemen User')
@section('content')

<div class="card border-0 shadow-sm" style="border-radius:12px">
    <div class="card-body p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0" style="font-size:1.1rem">Manajemen Pengguna</h5>
            <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm" style="border-radius:8px">
                <i class="bi bi-plus-lg me-1"></i> Tambah User
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" style="font-size:.9rem;padding:10px 15px">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" style="font-size:.9rem;padding:10px 15px">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover mb-0" style="font-size:.85rem">
                <thead style="background:#f8fafc">
                    <tr>
                        <th class="py-2 px-3" style="font-size:.75rem">NO</th>
                        <th class="py-2 px-3" style="font-size:.75rem">NAMA</th>
                        <th class="py-2 px-3" style="font-size:.75rem">EMAIL</th>
                        <th class="py-2 px-3" style="font-size:.75rem">ROLE</th>
                        <th class="py-2 px-3" style="font-size:.75rem">CABANG</th>
                        <th class="py-2 px-3" style="font-size:.75rem">DIBUAT</th>
                        <th class="py-2 px-3" style="font-size:.75rem">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td class="py-2 px-3 align-middle">{{ $loop->iteration }}</td>
                        <td class="py-2 px-3 align-middle"><strong>{{ $user->name }}</strong></td>
                        <td class="py-2 px-3 align-middle">{{ $user->email }}</td>
                        <td class="py-2 px-3 align-middle">
                            @if($user->role === 'admin')
                                <span class="badge bg-danger" style="font-size:.7rem;padding:3px 8px">Admin</span>
                            @else
                                <span class="badge bg-info" style="font-size:.7rem;padding:3px 8px">Kasir</span>
                            @endif
                        </td>
                        <td class="py-2 px-3 align-middle">{{ $user->cabang->nama_cabang ?? '-' }}</td>
                        <td class="py-2 px-3 align-middle">{{ $user->created_at->format('d/m/Y') }}</td>
                        <td class="py-2 px-3 align-middle">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('user.edit', $user) }}" class="btn btn-warning" style="font-size:.75rem;padding:4px 10px" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('user.destroy', $user) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger" style="font-size:.75rem;padding:4px 10px" onclick="return confirm('Yakin hapus user ini?')" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Belum ada user</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
