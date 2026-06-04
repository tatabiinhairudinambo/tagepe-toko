<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Login - TAGEPE</title>
    
    <!-- PWA Meta Tags -->
    @include('components.pwa-meta')
    
    <!-- Preload Critical Resources -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="/css/app-mode.css" rel="stylesheet">
    <style>
        :root {
            --primary: #667eea;
            --primary-dark: #5568d3;
            --secondary: #764ba2;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-container {
            max-width: 1100px;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
        }
        
        /* Left Side - Marketing Content */
        .login-info {
            color: white;
            padding: 2rem;
        }
        
        .login-info h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }
        
        .login-info p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.95;
            line-height: 1.6;
        }
        
        .features-list {
            list-style: none;
            padding: 0;
            margin-bottom: 2rem;
        }
        
        .features-list li {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
            font-size: 1rem;
        }
        
        .features-list li i {
            width: 24px;
            height: 24px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            flex-shrink: 0;
        }
        
        .trust-badges {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
        }
        
        .trust-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
        }
        
        .trust-badge i {
            font-size: 1.25rem;
        }
        
        /* Right Side - Login Form */
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 3rem 2.5rem;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .login-header i {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }
        
        .login-header h2 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }
        
        .login-header p {
            color: #6b7280;
            font-size: 0.95rem;
        }
        
        .alert {
            border-radius: 10px;
            margin-bottom: 1.5rem;
            padding: 0.875rem 1rem;
            font-size: 0.9rem;
        }
        
        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }
        
        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 10px;
            border: 2px solid #e5e7eb;
            font-size: 1rem;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
            outline: none;
        }
        
        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-login {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 0.875rem;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            font-size: 1rem;
            width: 100%;
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }
        
        .forgot-link {
            color: #6b7280;
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.3s;
        }
        
        .forgot-link:hover {
            color: var(--primary);
        }
        
        .back-link {
            text-align: center;
            margin-top: 1.5rem;
        }
        
        .back-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s;
        }
        
        .back-link a:hover {
            color: var(--primary-dark);
        }
        
        /* Responsive */
        @media (max-width: 991px) {
            .login-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .login-info {
                text-align: center;
            }
            
            .features-list li {
                justify-content: center;
            }
            
            .trust-badges {
                justify-content: center;
            }
        }
        
        @media (max-width: 576px) {
            body {
                padding: 15px;
            }
            
            .login-card {
                padding: 2rem 1.5rem;
            }
            
            .login-info h1 {
                font-size: 2rem;
            }
            
            .login-info p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Splash Screen -->
    @include('components.splash-screen')
    
    <div class="login-container">
        <!-- Left Side - Marketing Content -->
        <div class="login-info">
            <h1>Kelola Toko Anda dengan Lebih Mudah</h1>
            <p>
                Sistem POS modern yang membantu ribuan UMKM mengelola penjualan, stok, dan laporan dengan efisien. Mulai gratis hari ini!
            </p>
            
            <ul class="features-list">
                <li>
                    <i class="bi bi-check"></i>
                    <span>Kelola transaksi kasir dengan cepat dan akurat</span>
                </li>
                <li>
                    <i class="bi bi-check"></i>
                    <span>Pantau stok produk real-time di semua cabang</span>
                </li>
                <li>
                    <i class="bi bi-check"></i>
                    <span>Laporan penjualan lengkap dan mudah dipahami</span>
                </li>
                <li>
                    <i class="bi bi-check"></i>
                    <span>Akses dari mana saja, kapan saja</span>
                </li>
            </ul>
            
            <div class="trust-badges">
                <div class="trust-badge">
                    <i class="bi bi-shield-check"></i>
                    <span>Aman & Terpercaya</span>
                </div>
                <div class="trust-badge">
                    <i class="bi bi-people"></i>
                    <span>1000+ UMKM</span>
                </div>
                <div class="trust-badge">
                    <i class="bi bi-star-fill"></i>
                    <span>Rating 4.9/5</span>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="login-card">
            <div class="login-header">
                <i class="bi bi-shop"></i>
                <h2>TAGEPE</h2>
                <p>Masuk ke akun Anda</p>
            </div>
            
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            
            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle me-2"></i>
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            
            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">
                        <i class="bi bi-envelope me-2"></i>Email
                    </label>
                    <input type="email" class="form-control" id="email" name="email" 
                           placeholder="nama@email.com" required autofocus value="{{ old('email') }}">
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label">
                        <i class="bi bi-lock me-2"></i>Password
                    </label>
                    <input type="password" class="form-control" id="password" name="password" 
                           placeholder="Masukkan password" required>
                </div>
                
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="forgot-link">
                        Lupa password?
                    </a>
                </div>
                
                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                </button>
            </form>
            
            <div class="text-center mt-3">
                <span style="color: #6b7280; font-size: 0.95rem;">Belum punya akun? </span>
                <a href="{{ route('register') }}" style="color: var(--primary); text-decoration: none; font-weight: 600; font-size: 0.95rem;">
                    Daftar Sekarang
                </a>
            </div>
            
            <div class="back-link">
                <a href="{{ route('home') }}">
                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
