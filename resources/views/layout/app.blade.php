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
        :root { 
            --sidebar-w: 240px;
            /* Light Mode Colors */
            --bg-primary: #f0f4f8;
            --bg-secondary: #ffffff;
            --bg-tertiary: #f8f9fa;
            --text-primary: #1a2535;
            --text-secondary: #6c757d;
            --text-muted: #adb5bd;
            --border-color: #e9ecef;
            --card-shadow: 0 1px 8px rgba(0,0,0,.06);
            --sidebar-bg: linear-gradient(180deg, #1a2535 0%, #2c3e50 100%);
            --input-bg: #ffffff;
            --input-border: #ced4da;
            --table-stripe: #f8f9fa;
            --table-hover: #f1f3f5;
        }
        
        /* Dark Mode Colors */
        [data-theme="dark"] {
            --bg-primary: #1e1e1e;
            --bg-secondary: #2d2d30;
            --bg-tertiary: #3e3e42;
            --text-primary: #e4e6eb;
            --text-secondary: #b0b3b8;
            --text-muted: #8a8d93;
            --border-color: #3e3e42;
            --card-shadow: 0 2px 12px rgba(0,0,0,.4);
            --sidebar-bg: linear-gradient(180deg, #1e1e1e 0%, #252526 100%);
            --input-bg: #3e3e42;
            --input-border: #4e4e52;
            --table-stripe: #3e3e42;
            --table-hover: #4e4e52;
        }
        
        body { 
            background: var(--bg-primary); 
            font-family: 'Segoe UI', sans-serif;
            color: var(--text-primary);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: var(--sidebar-bg);
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
            background: var(--bg-secondary);
            padding: 14px 28px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: var(--card-shadow);
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        .topbar-title { font-size: 1.1rem; font-weight: 700; color: var(--text-primary); }
        .main-content { padding: 28px; flex: 1; }

        /* ── Cards ── */
        .card { 
            border-radius: 12px !important;
            background: var(--bg-secondary) !important;
            border-color: var(--border-color) !important;
            color: var(--text-primary) !important;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        .card-body {
            color: var(--text-primary) !important;
        }
        .card-header {
            background: var(--bg-secondary) !important;
            border-color: var(--border-color) !important;
            color: var(--text-primary) !important;
        }
        
        /* ── Forms ── */
        .form-control, .form-select {
            background: var(--input-bg) !important;
            border-color: var(--input-border) !important;
            color: var(--text-primary) !important;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            background: var(--input-bg) !important;
            border-color: #3498db !important;
            color: var(--text-primary) !important;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25) !important;
        }
        .form-control::placeholder {
            color: var(--text-muted) !important;
        }
        .form-label {
            color: var(--text-primary) !important;
        }
        .form-text {
            color: var(--text-secondary) !important;
        }
        
        /* ── Tables ── */
        .table {
            color: var(--text-primary) !important;
            border-color: var(--border-color) !important;
        }
        .table thead {
            background: var(--bg-secondary) !important;
            color: var(--text-primary) !important;
            border-color: var(--border-color) !important;
        }
        .table tbody tr {
            background: var(--bg-secondary) !important;
            border-color: var(--border-color) !important;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background: var(--bg-secondary) !important;
        }
        .table-striped tbody tr:nth-of-type(even) {
            background: var(--bg-secondary) !important;
        }
        .table-hover tbody tr:hover {
            background: var(--table-hover) !important;
        }
        .table-light {
            background: var(--bg-secondary) !important;
            color: var(--text-primary) !important;
            border-color: var(--border-color) !important;
        }
        [data-theme="dark"] .table > :not(caption) > * > * {
            background: var(--bg-secondary) !important;
            border-color: var(--border-color) !important;
        }
        
        /* ── Text Colors ── */
        .text-muted {
            color: var(--text-muted) !important;
        }
        .text-secondary {
            color: var(--text-secondary) !important;
        }
        
        /* ── Alerts ── */
        [data-theme="dark"] .alert-success {
            background: rgba(40, 167, 69, 0.2) !important;
            border-color: rgba(40, 167, 69, 0.4) !important;
            color: #6fd88e !important;
        }
        [data-theme="dark"] .alert-danger {
            background: rgba(220, 53, 69, 0.2) !important;
            border-color: rgba(220, 53, 69, 0.4) !important;
            color: #f78a96 !important;
        }
        [data-theme="dark"] .alert-warning {
            background: rgba(255, 193, 7, 0.2) !important;
            border-color: rgba(255, 193, 7, 0.4) !important;
            color: #ffd454 !important;
        }
        [data-theme="dark"] .alert-info {
            background: rgba(13, 202, 240, 0.2) !important;
            border-color: rgba(13, 202, 240, 0.4) !important;
            color: #5de0f5 !important;
        }
        
        /* ── Badges ── */
        [data-theme="dark"] .badge {
            filter: brightness(1.3) saturate(1.1);
        }
        
        /* ── Buttons ── */
        [data-theme="dark"] .btn-light {
            background: var(--bg-tertiary) !important;
            border-color: var(--border-color) !important;
            color: var(--text-primary) !important;
        }
        [data-theme="dark"] .btn-outline-secondary {
            color: var(--text-primary) !important;
            border-color: var(--border-color) !important;
        }
        [data-theme="dark"] .btn-outline-secondary:hover {
            background: var(--bg-tertiary) !important;
            color: var(--text-primary) !important;
        }
        [data-theme="dark"] .btn-outline-info {
            color: #5de0f5 !important;
            border-color: #5de0f5 !important;
        }
        [data-theme="dark"] .btn-outline-info:hover {
            background: rgba(13, 202, 240, 0.2) !important;
            color: #5de0f5 !important;
        }
        
        /* ── Dropdown ── */
        [data-theme="dark"] .dropdown-menu {
            background: var(--bg-secondary) !important;
            border-color: var(--border-color) !important;
        }
        [data-theme="dark"] .dropdown-item {
            color: var(--text-primary) !important;
        }
        [data-theme="dark"] .dropdown-item:hover {
            background: var(--bg-tertiary) !important;
        }
        [data-theme="dark"] .dropdown-divider {
            border-color: var(--border-color) !important;
        }
        
        /* ── Modal ── */
        [data-theme="dark"] .modal-content {
            background: var(--bg-secondary) !important;
            border-color: var(--border-color) !important;
        }
        [data-theme="dark"] .modal-header,
        [data-theme="dark"] .modal-footer {
            border-color: var(--border-color) !important;
        }
        
        /* ── Images & Icons ── */
        [data-theme="dark"] img {
            opacity: 0.9;
        }
        [data-theme="dark"] img:hover {
            opacity: 1;
        }
        
        /* ── Footer ── */
        [data-theme="dark"] footer {
            background: var(--bg-secondary) !important;
            border-color: var(--border-color) !important;
        }
        
        /* ── Small Text ── */
        [data-theme="dark"] .small,
        [data-theme="dark"] small {
            color: var(--text-secondary) !important;
        }
        
        /* ── List Group ── */
        [data-theme="dark"] .list-group-item {
            background: var(--bg-secondary) !important;
            border-color: var(--border-color) !important;
            color: var(--text-primary) !important;
        }
        
        /* ── Pagination ── */
        [data-theme="dark"] .pagination .page-link {
            background: var(--bg-secondary) !important;
            border-color: var(--border-color) !important;
            color: var(--text-primary) !important;
        }
        [data-theme="dark"] .pagination .page-link:hover {
            background: var(--bg-tertiary) !important;
        }
        [data-theme="dark"] .pagination .page-item.active .page-link {
            background: #3498db !important;
            border-color: #3498db !important;
        }
        
        /* ── Breadcrumb ── */
        [data-theme="dark"] .breadcrumb {
            background: var(--bg-secondary) !important;
        }
        [data-theme="dark"] .breadcrumb-item,
        [data-theme="dark"] .breadcrumb-item a {
            color: var(--text-secondary) !important;
        }
        [data-theme="dark"] .breadcrumb-item.active {
            color: var(--text-primary) !important;
        }
        
        /* ── Progress Bar ── */
        [data-theme="dark"] .progress {
            background: var(--bg-tertiary) !important;
        }
        
        /* ── Nav Tabs ── */
        [data-theme="dark"] .nav-tabs {
            border-color: var(--border-color) !important;
        }
        [data-theme="dark"] .nav-tabs .nav-link {
            color: var(--text-secondary) !important;
            border-color: transparent !important;
            background: transparent !important;
        }
        [data-theme="dark"] .nav-tabs .nav-link:hover {
            border-color: var(--border-color) !important;
            color: var(--text-primary) !important;
            background: var(--bg-tertiary) !important;
        }
        [data-theme="dark"] .nav-tabs .nav-link.active {
            background: var(--bg-secondary) !important;
            border-color: var(--border-color) var(--border-color) var(--bg-secondary) !important;
            color: var(--text-primary) !important;
        }
        
        /* ── Accordion ── */
        [data-theme="dark"] .accordion-item {
            background: var(--bg-secondary) !important;
            border-color: var(--border-color) !important;
        }
        [data-theme="dark"] .accordion-button {
            background: var(--bg-secondary) !important;
            color: var(--text-primary) !important;
        }
        [data-theme="dark"] .accordion-button:not(.collapsed) {
            background: var(--bg-secondary) !important;
            color: var(--text-primary) !important;
        }
        [data-theme="dark"] .accordion-body {
            background: var(--bg-secondary) !important;
            color: var(--text-primary) !important;
        }
        
        /* ── Toast ── */
        [data-theme="dark"] .toast {
            background: var(--bg-secondary) !important;
            border-color: var(--border-color) !important;
            color: var(--text-primary) !important;
        }
        [data-theme="dark"] .toast-header {
            background: var(--bg-tertiary) !important;
            border-color: var(--border-color) !important;
            color: var(--text-primary) !important;
        }
        
        /* ── Offcanvas ── */
        [data-theme="dark"] .offcanvas {
            background: var(--bg-secondary) !important;
            color: var(--text-primary) !important;
        }
        [data-theme="dark"] .offcanvas-header {
            border-color: var(--border-color) !important;
        }
        
        /* ── Dark Mode Toggle ── */
        .theme-toggle {
            background: rgba(255,255,255,.1);
            border: 1px solid rgba(255,255,255,.15);
            border-radius: 20px;
            padding: 6px 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            color: rgba(255,255,255,.7);
            font-size: 0.85rem;
        }
        .theme-toggle:hover {
            background: rgba(255,255,255,.15);
            color: #fff;
        }
        .theme-toggle i {
            font-size: 1rem;
        }

        /* ── Mobile Responsive ── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,.5);
            z-index: 99;
        }
        .btn-hamburger {
            display: none;
            background: none;
            border: none;
            font-size: 1.4rem;
            color: #1a2535;
            cursor: pointer;
            padding: 4px 8px;
        }

        @media (max-width: 768px) {
            :root { --sidebar-w: 0px; }
            .sidebar {
                transform: translateX(-100%);
                transition: transform .25s ease;
                z-index: 100;
                width: 240px;
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .sidebar-overlay.open { display: block; }
            .main-wrapper { margin-left: 0; }
            .btn-hamburger { display: inline-block; }
            .main-content { padding: 16px; }
            .topbar { padding: 12px 16px; }
            .topbar-title { font-size: .95rem; }
            .display-6 { font-size: 1.5rem !important; }
        }
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

        @if(Auth::user()->role === 'kasir')
        <a href="{{ route('transaksi.index') }}" class="{{ request()->routeIs('transaksi.index') ? 'active' : '' }}">
            <i class="bi bi-cart-check"></i> Kasir
        </a>
        <a href="{{ route('pemesanan.index') }}" class="{{ request()->routeIs('pemesanan.*') ? 'active' : '' }}">
            <i class="bi bi-receipt"></i> Pemesanan
        </a>
        <a href="{{ route('order.kasir.index') }}" class="{{ request()->routeIs('order.kasir.*') ? 'active' : '' }}">
            <i class="bi bi-bag-check"></i> Order Customer
            @php $orderMenunggu = \App\Models\OrderPublik::where('status','menunggu')->count(); @endphp
            @if($orderMenunggu > 0)
                <span class="badge bg-warning text-dark ms-auto">{{ $orderMenunggu }}</span>
            @endif
        </a>
        <a href="{{ route('produk.index') }}" class="{{ request()->routeIs('produk.index') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Produk
        </a>
        @endif

        @if(Auth::user()->role === 'admin')
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
        <a href="{{ route('cabang.index') }}" class="{{ request()->routeIs('cabang.*') ? 'active' : '' }}">
            <i class="bi bi-building"></i> Cabang
        </a>
        <a href="{{ route('user.index') }}" class="{{ request()->routeIs('user.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> User
        </a>
        <a href="{{ route('toko.index') }}" class="{{ request()->routeIs('toko.*') ? 'active' : '' }}">
            <i class="bi bi-shop"></i> Data Toko
        </a>
        @endif

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
        
        {{-- Dark Mode Toggle --}}
        <div class="theme-toggle mb-2" onclick="toggleTheme()" id="themeToggle">
            <i class="bi bi-moon-stars-fill" id="themeIcon"></i>
            <span id="themeText">Dark Mode</span>
        </div>
        
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <a href="{{ route('profile.edit') }}" class="btn btn-sm w-100 mb-2"
               style="background:rgba(52,152,219,.15);color:#3498db;border:1px solid rgba(52,152,219,.2);border-radius:8px">
                <i class="bi bi-key me-1"></i> Ganti Password
            </a>
            <button type="submit" class="btn btn-sm w-100"
                    style="background:rgba(231,76,60,.15);color:#e74c3c;border:1px solid rgba(231,76,60,.2);border-radius:8px">
                <i class="bi bi-box-arrow-left me-1"></i> Logout
            </button>
        </form>
    </div>
</aside>

{{-- Sidebar overlay untuk mobile --}}
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

{{-- Main --}}
<div class="main-wrapper">
    <div class="topbar">
        <div class="d-flex align-items-center gap-2">
            <button class="btn-hamburger" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
            <span class="topbar-title">@yield('title', 'Dashboard')</span>
        </div>
        <div class="d-flex align-items-center gap-3">
            {{-- Notifikasi stok menipis --}}
            @php
                $user = Auth::user();
                if ($user->role === 'kasir' && $user->cabang_id) {
                    $stokMenipis = \App\Models\StokCabang::with('produk')
                        ->where('cabang_id', $user->cabang_id)
                        ->whereHas('produk', fn($q) => $q->where('status','aktif'))
                        ->whereColumn('stok', '<=', \Illuminate\Support\Facades\DB::raw('(SELECT stok_minimum FROM produks WHERE produks.id = stok_cabangs.produk_id)'))
                        ->where('stok', '>', 0)->get();
                    $stokHabis = \App\Models\StokCabang::where('cabang_id', $user->cabang_id)->where('stok', 0)->count();
                } else {
                    $stokMenipis = \App\Models\Produk::whereColumn('stok', '<=', 'stok_minimum')->where('stok', '>', 0)->where('status', 'aktif')->get();
                    $stokHabis = \App\Models\Produk::where('stok', 0)->where('status', 'aktif')->count();
                }
            @endphp
            @if($stokMenipis->count() > 0 || $stokHabis > 0)
            <div class="dropdown">
                <button class="btn btn-sm position-relative" style="background:rgba(231,76,60,.1);color:#e74c3c;border:1px solid rgba(231,76,60,.2);border-radius:8px"
                        data-bs-toggle="dropdown">
                    <i class="bi bi-bell-fill"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:.6rem">
                        {{ $stokMenipis->count() + $stokHabis }}
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-end shadow border-0 p-0" style="min-width:280px;border-radius:12px;overflow:hidden">
                    <div class="p-3 border-bottom" style="background:#fff3f3">
                        <strong class="small text-danger"><i class="bi bi-exclamation-triangle me-1"></i>Peringatan Stok</strong>
                    </div>
                    @if($stokHabis > 0)
                    <div class="px-3 py-2 border-bottom bg-light">
                        <span class="badge bg-danger me-2">Habis</span>
                        <span class="small">{{ $stokHabis }} produk stok habis</span>
                    </div>
                    @endif
                    @foreach($stokMenipis->take(5) as $p)
                    <div class="px-3 py-2 border-bottom d-flex justify-content-between align-items-center">
                        <span class="small">{{ $p->nama ?? $p->produk->nama ?? '-' }}</span>
                        <span class="badge bg-warning text-dark">Sisa {{ $p->stok }}</span>
                    </div>
                    @endforeach
                    @if($stokMenipis->count() > 5)
                    <div class="px-3 py-2 text-center">
                        <span class="small text-muted">+{{ $stokMenipis->count() - 5 }} produk lainnya</span>
                    </div>
                    @endif
                    <div class="p-2 text-center border-top">
                        <a href="{{ route('produk.index') }}" class="small text-primary">Lihat semua produk →</a>
                    </div>
                </div>
            </div>
            @endif
            <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i>{{ now()->translatedFormat('d F Y') }}</span>
        </div>
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
                <p class="mb-0">sistem manajemen gue!</p>
            @endif
        </div>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Dark Mode Toggle
function toggleTheme() {
    const html = document.documentElement;
    const currentTheme = html.getAttribute('data-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    
    html.setAttribute('data-theme', newTheme);
    localStorage.setItem('theme', newTheme);
    updateThemeUI(newTheme);
}

function updateThemeUI(theme) {
    const icon = document.getElementById('themeIcon');
    const text = document.getElementById('themeText');
    
    if (theme === 'dark') {
        icon.className = 'bi bi-sun-fill';
        text.textContent = 'Light Mode';
    } else {
        icon.className = 'bi bi-moon-stars-fill';
        text.textContent = 'Dark Mode';
    }
}

// Load theme on page load
(function() {
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', savedTheme);
    updateThemeUI(savedTheme);
})();

// Sidebar toggle
function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('open');
    document.getElementById('sidebarOverlay').classList.toggle('open');
}
function closeSidebar() {
    document.querySelector('.sidebar').classList.remove('open');
    document.getElementById('sidebarOverlay').classList.remove('open');
}
// Tutup sidebar saat klik link di mobile
document.querySelectorAll('.sidebar-nav a').forEach(link => {
    link.addEventListener('click', () => {
        if (window.innerWidth <= 768) closeSidebar();
    });
});
</script>
@stack('scripts')
</body>
</html>
