<!DOCTYPE html>
<html lang="id">
@php use Illuminate\Support\Facades\Auth; @endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Toko - @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root { --sidebar-w: 240px; }
        body { background: #f0f4f8; font-family: 'Segoe UI', sans-serif; }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: linear-gradient(180deg, #1a2535 0%, #2c3e50 100%);
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-column: column;
            flex-direction: column;
            padding: 0;
            z-index: 100;
            box-shadow: 4px 0 20px rgba(0,0,0,.15);
        }
        .sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .sidebar-brand .brand-name {
            color: #fff;
            font-size: 1.2rem;
            font-weight: 700;
            letter-spacing: .3px;
        }
        .sidebar-brand .brand-sub {
            color: rgba(255,255,255,.45);
            font-size: .72rem;
            margin-top: 2px;
        }
        .sidebar-nav { padding: 16px 12px; flex: 1; }
        .nav-label {
            color: rgba(255,255,255,.3);
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 0 8px;
            margin: 12px 0 6px;
        }
        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255,255,255,.6);
            text-decoration: none;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: .9rem;
            transition: all .18s;
            margin-bottom: 2px;
        }
        .sidebar-nav a:hover { color: #fff; background: rgba(255,255,255,.08); }
        .sidebar-nav a.active {
            color: #fff;
            background: linear-gradient(90deg, #3498db, #2980b9);
            box-shadow: 0 4px 12px rgba(52,152,219,.35);
        }
        .sidebar-nav a i { font-size: 1rem; width: 20px; text-align: center; }
        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,.08);
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            border-radius: 8px;
            background: rgba(255,255,255,.06);
            margin-bottom: 10px;
        }
        .user-avatar {
            width: 34px; height: 34px;
            background: linear-gradient(135deg, #3498db, #2c3e50);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: .85rem; font-weight: 700;
            flex-shrink: 0;
        }
        .user-name { color: #fff; font-size: .85rem; font-weight: 600; }
        .user-role { color: rgba(255,255,255,.4); font-size: .72rem; }

        /* ── Main ── */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .topbar {
            background: white;
            padding: 14px 28px;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 1px 8px rgba(0,0,0,.06);
        }
        .topbar-title { font-size: 1.1rem; font-weight: 700; color: #1a2535; }
        .main-content { padding: 28px; flex: 1; }

        /* ── Cards ── */
        .card { border-radius: 12px !important; }
    </style>
</head>
<body>

{{-- Sidebar --}}
@php $toko = \App\Models\Toko::first(); @endphp
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="d-flex align-items-center gap-2">
            <div style="width:36px;height:36px;background:linear-gradient(135deg,#3498db,#2980b9);border-radius:8px;display:flex;align-items:center;justify-content:center">
                <i class="bi bi-shop text-white"></i>
            </div>
            <div>
                <div class="brand-name">{{ $toko->nama_toko ?? 'Data Toko' }}</div>
                <div class="brand-sub">Management System</div>
            </div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-label">Menu</div>
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="{{ route('transaksi.index') }}" class="{{ request()->routeIs('transaksi.index') || request()->routeIs('transaksi.store') ? 'active' : '' }}">
            <i class="bi bi-cart-check"></i> Kasir
        </a>
        <a href="{{ route('transaksi.laporan') }}" class="{{ request()->routeIs('transaksi.laporan') || request()->routeIs('transaksi.show') ? 'active' : '' }}">
            <i class="bi bi-graph-up"></i> Laporan
        </a>
        
        <div class="nav-label mt-3">Data Master</div>
        <a href="{{ route('kategori.index') }}" class="{{ request()->routeIs('kategori.*') ? 'active' : '' }}">
            <i class="bi bi-tags"></i> Kategori
        </a>
        <a href="{{ route('produk.index') }}" class="{{ request()->routeIs('produk.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Produk
        </a>
        <a href="{{ route('toko.index') }}" class="{{ request()->routeIs('toko.*') ? 'active' : '' }}">
            <i class="bi bi-shop"></i> Data Toko
        </a>

        <div class="nav-label mt-3">Publik</div>
        <a href="{{ route('katalog') }}" target="_blank">
            <i class="bi bi-grid-3x3-gap"></i> Lihat Katalog
            <i class="bi bi-box-arrow-up-right ms-auto" style="font-size:.7rem;opacity:.5"></i>
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div>
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role">Administrator</div>
            </div>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-sm w-100"
                    style="background:rgba(231,76,60,.15);color:#e74c3c;border:1px solid rgba(231,76,60,.2);border-radius:8px">
                <i class="bi bi-box-arrow-left me-1"></i> Logout
            </button>
        </form>
    </div>
</aside>

{{-- Main --}}
<div class="main-wrapper">
    <div class="topbar">
        <span class="topbar-title">@yield('title', 'Dashboard')</span>
        <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i>{{ now()->translatedFormat('d F Y') }}</span>
    </div>

    <div class="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    {{-- Footer dengan alamat toko --}}
    <footer style="background:white;border-top:1px solid #e9ecef;padding:20px 28px;margin-top:auto">
        <div class="text-center text-muted small">
            @if($toko)
                <p class="mb-1">
                    <i class="bi bi-shop me-1"></i><strong>{{ $toko->nama_toko }}</strong>
                </p>
                <p class="mb-1">
                    <i class="bi bi-geo-alt me-1"></i>{{ $toko->alamat }}
                </p>
                <p class="mb-0">
                    <i class="bi bi-telephone me-1"></i>{{ $toko->telepon }}
                    @if($toko->email)
                        <span class="mx-2">|</span>
                        <i class="bi bi-envelope me-1"></i>{{ $toko->email }}
                    @endif
                </p>
            @else
                <p class="mb-0">Sistem Manajemen Toko</p>
            @endif
        </div>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
