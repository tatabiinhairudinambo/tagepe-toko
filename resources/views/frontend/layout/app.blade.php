<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <title>@yield('title', 'Home') - {{ $toko->nama_toko ?? 'Tagepe-digital UMKM' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        :root {
            --primary: #6366f1;
            --secondary: #8b5cf6;
            --accent: #ec4899;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #0f172a;
            --darker: #020617;
            --light: #f8fafc;
        }
        
        [data-theme="dark"] {
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-tertiary: #334155;
            --text-primary: #f1f5f9;
            --text-secondary: #cbd5e1;
            --text-muted: #94a3b8;
            --border-color: rgba(148, 163, 184, 0.1);
            --glass-bg: rgba(30, 41, 59, 0.7);
            --glass-border: rgba(148, 163, 184, 0.1);
        }
        
        [data-theme="light"] {
            --bg-primary: #ffffff;
            --bg-secondary: #f8fafc;
            --bg-tertiary: #e2e8f0;
            --text-primary: #0f172a;
            --text-secondary: #475569;
            --text-muted: #64748b;
            --border-color: rgba(15, 23, 42, 0.1);
            --glass-bg: rgba(248, 250, 252, 0.7);
            --glass-border: rgba(15, 23, 42, 0.1);
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            overflow-x: hidden;
            transition: background 0.3s ease, color 0.3s ease;
            min-height: 100vh;
        }
        
        /* Animated Background */
        .bg-animated {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }
        
        .bg-animated::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, var(--primary) 0%, transparent 70%);
            opacity: 0.15;
            top: -200px;
            right: -200px;
            animation: float1 20s ease-in-out infinite;
            border-radius: 50%;
        }
        
        .bg-animated::after {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, var(--secondary) 0%, transparent 70%);
            opacity: 0.15;
            bottom: -150px;
            left: -150px;
            animation: float2 15s ease-in-out infinite;
            border-radius: 50%;
        }
        
        @keyframes float1 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-100px, 100px) scale(1.1); }
        }
        
        @keyframes float2 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(100px, -100px) scale(1.2); }
        }
        
        /* Glassmorphism */
        .glass {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        
        /* Ensure solid background for main content */
        main {
            background: var(--bg-primary);
            position: relative;
            z-index: 1;
        }
        
        /* Navbar Modern */
        .navbar-modern {
            padding: 1rem 0;
            transition: all 0.3s ease;
        }
        
        .navbar-modern.scrolled {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .nav-link:hover {
            color: var(--text-primary) !important;
        }
        
        .nav-link:hover::after,
        .nav-link.active::after {
            width: 80%;
        }
        
        /* Theme Toggle */
        .theme-toggle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .theme-toggle:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }
        
        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            padding: 0.75rem 2rem;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(99, 102, 241, 0.4);
        }
        
        .btn-outline-primary {
            border: 2px solid var(--primary);
            color: var(--primary);
            padding: 0.75rem 2rem;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        
        .btn-outline-primary:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }
        
        /* Footer Modern */
        .footer-modern {
            background: var(--bg-secondary);
            border-top: 1px solid var(--border-color);
            padding: 4rem 0 2rem;
            margin-top: 6rem;
        }
        
        .footer-title {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .footer-link {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            display: block;
            padding: 0.5rem 0;
            transition: all 0.3s ease;
        }
        
        .footer-link:hover {
            color: var(--primary);
            padding-left: 0.5rem;
        }
        
        .footer-modern p.text-muted {
            color: rgba(255, 255, 255, 0.7) !important;
        }
        
        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--text-primary);
            text-decoration: none;
            transition: all 0.3s ease;
            margin-right: 0.5rem;
        }
        
        .social-icon:hover {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            transform: translateY(-3px);
        }
        
        /* Scroll to Top */
        .scroll-top {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
        }
        
        .scroll-top.show {
            opacity: 1;
            visibility: visible;
        }
        
        .scroll-top:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(99, 102, 241, 0.4);
        }
        
        /* Responsive */
        /* Tablet */
        @media (max-width: 992px) {
            .navbar-nav {
                margin-top: 16px;
                margin-bottom: 16px;
            }
            .navbar-nav .nav-link {
                padding: 10px 16px;
                border-radius: 8px;
            }
            .navbar-nav .nav-link:hover {
                background: rgba(99, 102, 241, 0.1);
            }
            .d-flex.align-items-center.gap-2 {
                margin-top: 12px;
                justify-content: center;
            }
        }
        
        /* Mobile */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.1rem;
            }
            .navbar-brand i {
                font-size: 1.2rem;
            }
            .navbar-toggler {
                padding: 6px 10px;
                font-size: 1.2rem;
            }
            .navbar-nav .nav-link {
                font-size: .95rem;
                padding: 12px 16px;
            }
            .btn-order {
                width: 100%;
                justify-content: center;
                margin-bottom: 8px;
            }
            .theme-toggle {
                width: 100%;
                justify-content: center;
            }
        }
        
        /* Small Mobile */
        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1rem;
            }
            .navbar-modern {
                padding: 12px 0;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

<div class="bg-animated"></div>

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg navbar-modern fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="bi bi-shop me-2"></i>{{ $toko->nama_toko ?? 'Tagepe-digital UMKM' }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="bi bi-house me-1"></i>Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('shop.home') ? 'active' : '' }}" href="{{ route('shop.home') }}">
                        <i class="bi bi-shop me-1"></i>Toko Online
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('order.index') }}">
                        <i class="bi bi-cart me-1"></i>Order
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#kontak">
                        <i class="bi bi-envelope me-1"></i>Kontak
                    </a>
                </li>
            </ul>
            <div class="d-flex align-items-center gap-2">
                <div class="theme-toggle" id="themeToggle">
                    <i class="bi bi-moon-stars" id="themeIcon"></i>
                </div>
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-box-arrow-in-right me-1"></i>Login
                </a>
            </div>
        </div>
    </div>
</nav>

{{-- Content --}}
<main style="padding-top: 80px;">
    @yield('content')
</main>

{{-- Footer --}}
<footer class="footer-modern">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <h3 class="footer-title">{{ $toko->nama_toko ?? 'Tagepe-digital UMKM' }}</h3>
                <p class="text-muted">{{ $toko->deskripsi ?? 'Jln pahlawan kel namatio puncak,pahlawan,masohi maluku tengah indonesia.' }}</p>
                <div class="mt-3">
                    <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-title">Menu</h5>
                <a href="{{ route('home') }}" class="footer-link">Beranda</a>
                <a href="{{ route('shop.home') }}" class="footer-link">Toko Online</a>
                <a href="{{ route('login') }}" class="footer-link">Login</a>
                <a href="{{ route('order.index') }}" class="footer-link">Order</a>
            </div>
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-title">Bantuan</h5>
                <a href="#" class="footer-link">FAQ</a>
                <a href="#" class="footer-link">Cara Order</a>
                <a href="#" class="footer-link">Pembayaran</a>
                <a href="#" class="footer-link">Pengiriman</a>
            </div>
            <div class="col-lg-4">
                <h5 class="footer-title">Kontak</h5>
                <p class="text-muted mb-2">
                    <i class="bi bi-telephone me-2"></i>{{ $toko->telepon ?? '08213840405' }}
                </p>
                <p class="text-muted mb-2">
                    <i class="bi bi-envelope me-2"></i>{{ $toko->email ?? 'toko@datastoko.com' }}
                </p>
                <p class="text-muted">
                    <i class="bi bi-geo-alt me-2"></i>{{ $toko->alamat ?? 'Jln pahlawan kel namatio puncak,pahlawan,masohi maluku tengah indonesia.' }}
                </p>
            </div>
        </div>
        <hr class="my-4" style="border-color: var(--border-color);">
        <div class="text-center" style="color: rgba(255, 255, 255, 0.7);">
            <p class="mb-0">&copy; 2026 {{ $toko->nama_toko ?? 'Tagepe-digital UMKM' }}. Dibuat dengan ❤️ dan bismillah</p>
        </div>
    </div>
</footer>

{{-- Scroll to Top --}}
<div class="scroll-top" id="scrollTop">
    <i class="bi bi-arrow-up"></i>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Navbar scroll effect
window.addEventListener('scroll', function() {
    const navbar = document.getElementById('mainNav');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// Theme toggle
const themeToggle = document.getElementById('themeToggle');
const themeIcon = document.getElementById('themeIcon');
const html = document.documentElement;

// Load saved theme
const savedTheme = localStorage.getItem('theme') || 'dark';
html.setAttribute('data-theme', savedTheme);
updateThemeIcon(savedTheme);

themeToggle.addEventListener('click', function() {
    const currentTheme = html.getAttribute('data-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    
    html.setAttribute('data-theme', newTheme);
    localStorage.setItem('theme', newTheme);
    updateThemeIcon(newTheme);
});

function updateThemeIcon(theme) {
    if (theme === 'dark') {
        themeIcon.className = 'bi bi-moon-stars';
    } else {
        themeIcon.className = 'bi bi-sun';
    }
}

// Scroll to top
const scrollTop = document.getElementById('scrollTop');

window.addEventListener('scroll', function() {
    if (window.scrollY > 300) {
        scrollTop.classList.add('show');
    } else {
        scrollTop.classList.remove('show');
    }
});

scrollTop.addEventListener('click', function() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});
</script>
@stack('scripts')
</body>
</html>
