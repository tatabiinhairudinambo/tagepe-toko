<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>Login - TAGEPE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary: #0066FF;
            --primary-dark: #0052CC;
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
        
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
        }
        
        .login-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 3rem 2rem;
            text-align: center;
        }
        
        .login-header h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .login-header p {
            opacity: 0.9;
        }
        
        .login-body {
            padding: 2.5rem 2rem;
        }
        
        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }
        
        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 10px;
            border: 2px solid #e5e7eb;
            font-size: 1rem;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(0,102,255,0.1);
        }
        
        .btn-login {
            background: var(--primary);
            color: white;
            padding: 0.75rem;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            font-size: 1rem;
            width: 100%;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,102,255,0.3);
        }
        
        .back-link {
            text-align: center;
            margin-top: 1.5rem;
        }
        
        .back-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }
        
        .back-link a:hover {
            text-decoration: underline;
        }
        
        .alert {
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <i class="bi bi-shop" style="font-size: 3rem;"></i>
            <h2>TAGEPE</h2>
            <p>Masuk ke akun Anda</p>
        </div>
        <div class="login-body">
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
                
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Ingat saya</label>
                </div>
                
                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                </button>
            </form>
            
            <div class="text-center mt-3">
                <a href="{{ route('password.request') }}" style="color: #6c757d; text-decoration: none;">
                    <small>Lupa password?</small>
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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        :root {
            --primary-blue: #0066FF;
            --primary-dark: #0052CC;
            --secondary-blue: #4D94FF;
            --accent-green: #00C853;
            --bg-light: #F8FAFB;
            --bg-white: #FFFFFF;
            --text-dark: #1A1A1A;
            --text-gray: #6B7280;
            --text-light: #9CA3AF;
            --border-color: #E5E7EB;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Helvetica', 'Arial', sans-serif;
            background: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
        }
        
        /* Header Navigation */
        .top-nav {
            background: var(--bg-white);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }
        
        .top-nav .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .logo i {
            font-size: 1.75rem;
        }
        
        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        
        .nav-links a {
            color: var(--text-gray);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .nav-links a:hover {
            color: var(--primary-blue);
        }
        
        /* Main Container */
        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 100px 20px 40px;
        }
        
        .login-container {
            max-width: 1200px;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }
        
        /* Left Side - Content */
        .login-content {
            padding: 2rem;
        }
        
        .login-content h1 {
            font-size: 2.75rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }
        
        .login-content h1 .highlight {
            color: var(--primary-blue);
        }
        
        .login-content p {
            font-size: 1.125rem;
            color: var(--text-gray);
            margin-bottom: 2rem;
            line-height: 1.7;
        }
        
        .features-list {
            list-style: none;
            padding: 0;
            margin: 2rem 0;
        }
        
        .features-list li {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
            font-size: 1rem;
            color: var(--text-gray);
        }
        
        .features-list li i {
            width: 24px;
            height: 24px;
            background: var(--accent-green);
            color: white;
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
            margin-top: 2rem;
            flex-wrap: wrap;
        }
        
        .trust-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-gray);
            font-size: 0.875rem;
        }
        
        .trust-badge i {
            color: var(--accent-green);
            font-size: 1.25rem;
        }
        
        /* Right Side - Form */
        .login-form-container {
            background: var(--bg-white);
            border-radius: 16px;
            padding: 3rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .form-header h2 {
            font-size: 1.875rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }
        
        .form-header p {
            color: var(--text-gray);
            font-size: 0.9375rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }
        
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1.5px solid var(--border-color);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
            background: var(--bg-white);
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(0, 102, 255, 0.1);
        }
        
        .password-wrapper {
            position: relative;
        }
        
        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-gray);
            cursor: pointer;
            padding: 0.25rem;
        }
        
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }
        
        .remember-me label {
            font-size: 0.875rem;
            color: var(--text-gray);
            cursor: pointer;
            margin: 0;
        }
        
        .forgot-link {
            color: var(--primary-blue);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .forgot-link:hover {
            text-decoration: underline;
        }
        
        .btn-login {
            width: 100%;
            padding: 0.875rem;
            background: var(--primary-blue);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 102, 255, 0.3);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.5rem 0;
            color: var(--text-light);
            font-size: 0.875rem;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid var(--border-color);
        }
        
        .divider span {
            padding: 0 1rem;
        }
        
        .register-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9375rem;
            color: var(--text-gray);
        }
        
        .register-link a {
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 600;
        }
        
        .register-link a:hover {
            text-decoration: underline;
        }
        
        .alert {
            padding: 0.875rem 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
        }
        
        .alert-danger {
            background: #FEE2E2;
            color: #991B1B;
            border: 1px solid #FCA5A5;
        }
        
        .alert-success {
            background: #D1FAE5;
            color: #065F46;
            border: 1px solid #6EE7B7;
        }
        
        /* ========================================
           LANDING PAGE SECTIONS
           ======================================== */
        
        /* Benefits Section */
        .benefits-section {
            padding: 5rem 0;
            background: var(--bg-white);
        }
        
        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }
        
        .section-header h2 {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }
        
        .section-header p {
            font-size: 1.125rem;
            color: var(--text-gray);
        }
        
        .benefit-card {
            background: var(--bg-light);
            border-radius: 16px;
            padding: 2rem;
            height: 100%;
            transition: all 0.3s;
            border: 1px solid var(--border-color);
        }
        
        .benefit-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.1);
        }
        
        .benefit-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-dark));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .benefit-card h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.75rem;
        }
        
        .benefit-card p {
            color: var(--text-gray);
            line-height: 1.6;
        }
        
        /* Feature Section */
        .feature-section {
            padding: 5rem 0;
            background: var(--bg-light);
        }
        
        .feature-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            margin-bottom: 5rem;
        }
        
        .feature-content:last-child {
            margin-bottom: 0;
        }
        
        .feature-content:nth-child(even) {
            direction: rtl;
        }
        
        .feature-content:nth-child(even) > * {
            direction: ltr;
        }
        
        .feature-text h3 {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }
        
        .feature-text p {
            font-size: 1.125rem;
            color: var(--text-gray);
            margin-bottom: 2rem;
            line-height: 1.7;
        }
        
        .feature-list {
            list-style: none;
            padding: 0;
        }
        
        .feature-list li {
            display: flex;
            align-items: start;
            gap: 1rem;
            margin-bottom: 1rem;
            font-size: 1rem;
            color: var(--text-gray);
        }
        
        .feature-list li i {
            width: 24px;
            height: 24px;
            background: var(--accent-green);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            flex-shrink: 0;
            margin-top: 2px;
        }
        
        .feature-image {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 12px 48px rgba(0, 0, 0, 0.1);
        }
        
        .feature-image img {
            width: 100%;
            height: auto;
            display: block;
        }
        
        /* Stats Section */
        .stats-section {
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-dark));
            color: white;
            padding: 4rem 0;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            font-size: 1rem;
            opacity: 0.9;
        }
        
        /* CTA Section */
        .cta-section {
            background: var(--bg-white);
            padding: 5rem 0;
            text-align: center;
        }
        
        .cta-section h2 {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }
        
        .cta-section p {
            font-size: 1.125rem;
            color: var(--text-gray);
            margin-bottom: 2rem;
        }
        
        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn-primary-cta {
            background: var(--primary-blue);
            color: white;
            padding: 1rem 2.5rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }
        
        .btn-primary-cta:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 102, 255, 0.3);
            color: white;
        }
        
        .btn-outline-cta {
            background: transparent;
            color: var(--primary-blue);
            border: 2px solid var(--primary-blue);
            padding: 1rem 2.5rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }
        
        .btn-outline-cta:hover {
            background: var(--primary-blue);
            color: white;
        }
        
        /* Footer */
        .footer-section {
            background: var(--text-dark);
            color: white;
            padding: 3rem 0 1.5rem;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 2fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .footer-title {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: white;
        }
        
        .footer-text {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.6;
            margin-bottom: 1rem;
        }
        
        .footer-link {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            display: block;
            padding: 0.5rem 0;
            transition: all 0.3s;
        }
        
        .footer-link:hover {
            color: white;
            padding-left: 0.5rem;
        }
        
        .social-icons {
            display: flex;
            gap: 0.75rem;
            margin-top: 1rem;
        }
        
        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .social-icon:hover {
            background: var(--primary-blue);
            transform: translateY(-3px);
        }
        
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1.5rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.7);
        }
        
        /* Responsive */
        @media (max-width: 1023px) {
            .login-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .login-content {
                text-align: center;
            }
            
            .features-list li {
                justify-content: center;
            }
            
            .trust-badges {
                justify-content: center;
            }
            
            .feature-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .feature-content:nth-child(even) {
                direction: ltr;
            }
            
            .footer-content {
                grid-template-columns: 1fr 1fr;
            }
        }
        
        @media (max-width: 767px) {
            .top-nav {
                padding: 0.75rem 0;
            }
            
            .logo {
                font-size: 1.25rem;
            }
            
            .nav-links {
                gap: 1rem;
                display: none;
            }
            
            .nav-links a {
                font-size: 0.875rem;
            }
            
            .login-wrapper {
                padding: 80px 16px 20px;
            }
            
            .login-content h1 {
                font-size: 2rem;
            }
            
            .login-content p {
                font-size: 1rem;
            }
            
            .login-form-container {
                padding: 2rem 1.5rem;
            }
            
            .form-header h2 {
                font-size: 1.5rem;
            }
            
            .section-header h2 {
                font-size: 1.75rem;
            }
            
            .stat-number {
                font-size: 2rem;
            }
            
            .cta-section h2 {
                font-size: 1.75rem;
            }
            
            .cta-buttons {
                flex-direction: column;
            }
            
            .cta-buttons a {
                width: 100%;
                text-align: center;
            }
            
            .footer-content {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Top Navigation -->
    <nav class="top-nav">
        <div class="container">
            <a href="/" class="logo">
                <i class="bi bi-shop"></i>
                <span>TAGEPE UMKM</span>
            </a>
            <div class="nav-links">
                <a href="#fitur">Fitur</a>
                <a href="{{ route('shop.home') }}">Toko Online</a>
                <a href="{{ route('register') }}" style="color: var(--primary-blue); font-weight: 600;">Daftar Gratis</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="login-wrapper">
        <div class="login-container">
            <!-- Left Side - Content -->
            <div class="login-content">
                <h1>
                    Kelola Toko Anda dengan <span class="highlight">Lebih Mudah</span>
                </h1>
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

            <!-- Right Side - Form -->
            <div class="login-form-container">
                <div class="form-header">
                    <h2>Masuk ke Akun Anda</h2>
                    <p>Selamat datang kembali! Silakan masuk untuk melanjutkan.</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle me-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-control" 
                            placeholder="nama@email.com"
                            value="{{ old('email') }}"
                            required 
                            autofocus
                        >
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <div class="password-wrapper">
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="form-control" 
                                placeholder="Masukkan password Anda"
                                required
                            >
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-options">
                        <div class="remember-me">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Ingat saya</label>
                        </div>
                        <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a>
                    </div>

                    <button type="submit" class="btn-login">
                        Masuk
                    </button>

                    <div class="divider">
                        <span>atau</span>
                    </div>

                    <div class="register-link">
                        Belum punya akun? <a href="{{ route('register') }}">Daftar Gratis</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Benefits Section -->
    <section class="benefits-section">
        <div class="container">
            <div class="section-header">
                <h2>Semua #BisnisJadiMudah</h2>
                <p>Kelola bisnis Anda dengan lebih efisien dan profesional</p>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="bi bi-lightning-charge"></i>
                        </div>
                        <h3>Operasional Bisnis Optimal</h3>
                        <p>Dari penjualan, pembayaran, stok, hingga laporan keuangan—semua tercatat otomatis dalam satu sistem tanpa repot input manual.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="bi bi-grid-3x3-gap"></i>
                        </div>
                        <h3>Fleksibel untuk Berbagai Jenis Usaha</h3>
                        <p>Cocok untuk restoran, kafe, retail, hingga bisnis multi-outlet. Mendukung berbagai metode pembayaran dan program loyalitas.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="bi bi-star"></i>
                        </div>
                        <h3>Mudah Digunakan & Fitur Lengkap</h3>
                        <p>Antarmuka sederhana dan intuitif, dilengkapi dengan fitur yang komplit untuk mendukung semua kebutuhan bisnis Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature Section -->
    <section class="feature-section" id="fitur">
        <div class="container">
            <div class="section-header">
                <h2>Jualan Bebas Hambatan</h2>
                <p>Nikmati fitur-fitur sistem POS yang membuat transaksi lancar dan operasional lebih mudah</p>
            </div>
            
            <div class="feature-content">
                <div class="feature-text">
                    <h3>Transaksi Cepat & Akurat</h3>
                    <p>Proses transaksi penjualan dengan cepat menggunakan barcode scanner atau pencarian produk. Semua data tersimpan otomatis dan terintegrasi dengan laporan keuangan.</p>
                    <ul class="feature-list">
                        <li>
                            <i class="bi bi-check"></i>
                            <span>Online & Offline - Tetap bisa transaksi tanpa internet</span>
                        </li>
                        <li>
                            <i class="bi bi-check"></i>
                            <span>Multidevice - Akses dari kasir, tablet, atau smartphone</span>
                        </li>
                        <li>
                            <i class="bi bi-check"></i>
                            <span>Promo & Diskon - Buat penawaran menarik dengan mudah</span>
                        </li>
                    </ul>
                </div>
                <div class="feature-image">
                    <img src="https://placehold.co/800x600/0066FF/FFFFFF/png?text=POS+System+Dashboard" alt="POS System Dashboard">
                </div>
            </div>
            
            <div class="feature-content">
                <div class="feature-text">
                    <h3>Kelola Stok Real-Time</h3>
                    <p>Pantau stok produk secara real-time di semua cabang. Dapatkan notifikasi otomatis saat stok menipis dan buat laporan stok dengan mudah.</p>
                    <ul class="feature-list">
                        <li>
                            <i class="bi bi-check"></i>
                            <span>Multi Satuan & Desimal - Kelola stok dalam berbagai satuan</span>
                        </li>
                        <li>
                            <i class="bi bi-check"></i>
                            <span>Notifikasi Stok Minimum - Alert otomatis saat stok menipis</span>
                        </li>
                        <li>
                            <i class="bi bi-check"></i>
                            <span>Transfer Stok Antar Cabang - Mudah dan tercatat rapi</span>
                        </li>
                    </ul>
                </div>
                <div class="feature-image">
                    <img src="https://placehold.co/800x600/00C853/FFFFFF/png?text=Stock+Management" alt="Stock Management">
                </div>
            </div>
            
            <div class="feature-content">
                <div class="feature-text">
                    <h3>Laporan Lengkap & Real-Time</h3>
                    <p>Dapatkan laporan penjualan, stok, dan keuangan secara real-time. Analisis performa bisnis dengan grafik yang mudah dipahami.</p>
                    <ul class="feature-list">
                        <li>
                            <i class="bi bi-check"></i>
                            <span>Laporan Penjualan - Per hari, minggu, bulan, atau custom</span>
                        </li>
                        <li>
                            <i class="bi bi-check"></i>
                            <span>Laporan Stok - Pantau pergerakan stok dengan detail</span>
                        </li>
                        <li>
                            <i class="bi bi-check"></i>
                            <span>Laporan Keuangan - Profit, loss, dan cash flow</span>
                        </li>
                    </ul>
                </div>
                <div class="feature-image">
                    <img src="https://placehold.co/800x600/FF6B35/FFFFFF/png?text=Reports+%26+Analytics" alt="Reports & Analytics">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <div class="stat-item">
                        <div class="stat-number">1000+</div>
                        <div class="stat-label">UMKM Terdaftar</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <div class="stat-item">
                        <div class="stat-number">50K+</div>
                        <div class="stat-label">Transaksi per Hari</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <div class="stat-item">
                        <div class="stat-number">99.9%</div>
                        <div class="stat-label">Uptime</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">4.9/5</div>
                        <div class="stat-label">Rating Pengguna</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2>Siap Upgrade Sistem Kasir Anda?</h2>
            <p>Mulai hari ini dan rasakan kemudahan mengelola bisnis dengan sistem POS modern</p>
            <div class="cta-buttons">
                <a href="{{ route('shop.home') }}" class="btn-primary-cta">
                    <i class="bi bi-shop me-2"></i>Lihat Toko Online
                </a>
                <a href="https://wa.me/6281234567890" class="btn-outline-cta">
                    <i class="bi bi-whatsapp me-2"></i>Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-section">
        <div class="container">
            <div class="footer-content">
                <div>
                    <h3 class="footer-title">TAGEPE UMKM</h3>
                    <p class="footer-text">Sistem POS modern yang membantu ribuan UMKM mengelola penjualan, stok, dan laporan dengan efisien.</p>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                <div>
                    <h5 class="footer-title">Menu</h5>
                    <a href="#" class="footer-link">Beranda</a>
                    <a href="#fitur" class="footer-link">Fitur</a>
                    <a href="{{ route('shop.home') }}" class="footer-link">Toko Online</a>
                    <a href="{{ route('register') }}" class="footer-link">Daftar</a>
                </div>
                <div>
                    <h5 class="footer-title">Bantuan</h5>
                    <a href="#" class="footer-link">FAQ</a>
                    <a href="#" class="footer-link">Cara Order</a>
                    <a href="#" class="footer-link">Pembayaran</a>
                    <a href="#" class="footer-link">Pengiriman</a>
                </div>
                <div>
                    <h5 class="footer-title">Kontak</h5>
                    <p class="footer-text">
                        <i class="bi bi-telephone me-2"></i>08213840405
                    </p>
                    <p class="footer-text">
                        <i class="bi bi-envelope me-2"></i>toko@datastoko.com
                    </p>
                    <p class="footer-text">
                        <i class="bi bi-geo-alt me-2"></i>Jln pahlawan kel namatio puncak, Masohi, Maluku Tengah
                    </p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 TAGEPE UMKM. Dibuat dengan ❤️ dan bismillah</p>
            </div>
        </div>
    </footer>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        }
    </script>
</body>
</html>
