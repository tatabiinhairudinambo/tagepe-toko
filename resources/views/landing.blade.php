<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>TAGEPE - Sistem POS Modern untuk UMKM</title>
    
    <!-- PWA Meta Tags -->
    @include('components.pwa-meta')
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="/css/app-mode.css" rel="stylesheet">
    <style>
        :root {
            --primary: #0066FF;
            --primary-dark: #0052CC;
            --secondary: #00C853;
            --dark: #1A1A1A;
            --gray: #6B7280;
            --light: #F8FAFB;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: var(--dark);
            line-height: 1.6;
        }
        
        /* Navbar */
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }
        
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }
        
        .nav-link {
            color: var(--gray);
            font-weight: 500;
            margin: 0 1rem;
            transition: color 0.3s;
        }
        
        .nav-link:hover {
            color: var(--primary);
        }
        
        .btn-login {
            background: var(--primary);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            background: var(--primary-dark);
            color: white;
            transform: translateY(-2px);
        }
        
        /* Hero Section */
        .hero {
            padding: 120px 0 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }
        
        .hero p {
            font-size: 1.25rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }
        
        .hero-image {
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 100%;
        }
        
        .btn-cta {
            background: white;
            color: var(--primary);
            padding: 1rem 2.5rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1.1rem;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }
        
        .btn-cta:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            color: var(--primary);
        }
        
        /* Stats */
        .stats {
            background: white;
            padding: 60px 0;
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }
        
        .stat-card {
            text-align: center;
            padding: 2rem;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary);
        }
        
        .stat-label {
            color: var(--gray);
            font-size: 1.1rem;
        }
        
        /* About Section */
        .about {
            padding: 80px 0;
            background: var(--light);
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--dark);
        }
        
        .section-subtitle {
            font-size: 1.2rem;
            color: var(--gray);
            margin-bottom: 3rem;
        }
        
        .about-image {
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            max-width: 100%;
        }
        
        /* Features */
        .features {
            padding: 80px 0;
            background: white;
        }
        
        .feature-card {
            background: white;
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            height: 100%;
            transition: all 0.3s;
            border: 2px solid transparent;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            border-color: var(--primary);
        }
        
        .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }
        
        .feature-icon i {
            font-size: 2rem;
            color: white;
        }
        
        .feature-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .feature-desc {
            color: var(--gray);
            line-height: 1.8;
        }
        
        /* Testimonials */
        .testimonials {
            padding: 80px 0;
            background: var(--light);
        }
        
        .testimonial-card {
            background: white;
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            height: 100%;
        }
        
        .testimonial-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 1.5rem;
        }
        
        .testimonial-rating {
            color: #FFC107;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }
        
        .testimonial-text {
            font-size: 1.1rem;
            font-style: italic;
            color: var(--gray);
            margin-bottom: 1.5rem;
            line-height: 1.8;
        }
        
        .testimonial-author {
            font-weight: 700;
            margin-bottom: 0.25rem;
        }
        
        .testimonial-role {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        /* CTA Section */
        .cta-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
        }
        
        .cta-section h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }
        
        .cta-section p {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 2.5rem;
        }
        
        /* Footer */
        .footer {
            background: var(--dark);
            color: white;
            padding: 60px 0 30px;
        }
        
        .footer h5 {
            font-weight: 700;
            margin-bottom: 1.5rem;
        }
        
        .footer-links {
            list-style: none;
            padding: 0;
        }
        
        .footer-links li {
            margin-bottom: 0.75rem;
        }
        
        .footer-links a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        .footer-bottom {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.1);
            text-align: center;
            color: rgba(255,255,255,0.6);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }
            
            .hero p {
                font-size: 1rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .stat-number {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center w-100">
                <a class="navbar-brand" href="/">
                    <i class="bi bi-shop"></i> TAGEPE
                </a>
                <div class="d-flex align-items-center gap-3">
                    <a href="#about" class="nav-link">Tentang</a>
                    <a href="#features" class="nav-link">Fitur</a>
                    <a href="#testimonials" class="nav-link">Testimoni</a>
                    <a href="{{ route('register') }}" class="nav-link" style="color: var(--secondary); font-weight: 600;">
                        Daftar Gratis
                    </a>
                    <a href="{{ route('login') }}" class="btn-login">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h1>Sistem POS Modern untuk UMKM Indonesia</h1>
                    <p>Kelola toko, stok, transaksi, dan laporan dengan mudah. Tingkatkan produktivitas bisnis Anda dengan TAGEPE.</p>
                    <a href="{{ route('register') }}" class="btn-cta">
                        Daftar Gratis Sekarang <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1556742502-ec7c0e9f34b1?w=800&h=600&fit=crop" alt="POS System" class="hero-image">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">UMKM Terdaftar</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-number">50K+</div>
                        <div class="stat-label">Transaksi/Bulan</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-number">99.9%</div>
                        <div class="stat-label">Uptime</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-number">4.9/5</div>
                        <div class="stat-label">Rating Pengguna</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=800&h=600&fit=crop" alt="Team Working" class="about-image">
                </div>
                <div class="col-lg-6">
                    <h2 class="section-title">Tentang TAGEPE</h2>
                    <p class="section-subtitle">Solusi POS yang dirancang khusus untuk UMKM Indonesia</p>
                    <p style="font-size: 1.1rem; color: var(--gray); line-height: 1.8; margin-bottom: 1.5rem;">
                        TAGEPE adalah sistem Point of Sale (POS) modern yang dikembangkan untuk membantu UMKM Indonesia mengelola bisnis mereka dengan lebih efisien. Dengan interface yang intuitif dan fitur lengkap, kami berkomitmen untuk meningkatkan produktivitas dan profitabilitas bisnis Anda.
                    </p>
                    <p style="font-size: 1.1rem; color: var(--gray); line-height: 1.8; margin-bottom: 1.5rem;">
                        Sistem kami mendukung multi-cabang, manajemen inventori real-time, laporan lengkap, dan dapat diakses dari berbagai perangkat. Semua dirancang dengan teknologi terkini untuk memastikan performa maksimal dan keamanan data Anda.
                    </p>
                    <div class="row mt-4">
                        <div class="col-6">
                            <h4 style="color: var(--primary); font-weight: 700;">✓ Mudah Digunakan</h4>
                            <p style="color: var(--gray);">Interface intuitif untuk semua kalangan</p>
                        </div>
                        <div class="col-6">
                            <h4 style="color: var(--primary); font-weight: 700;">✓ Aman & Terpercaya</h4>
                            <p style="color: var(--gray);">Data terenkripsi dan backup otomatis</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Fitur Unggulan</h2>
                <p class="section-subtitle">Semua yang Anda butuhkan untuk mengelola toko modern</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-cart-check"></i>
                        </div>
                        <h3 class="feature-title">Transaksi Cepat</h3>
                        <p class="feature-desc">Proses transaksi dalam hitungan detik dengan interface kasir yang simpel dan responsif. Cetak struk otomatis dan tracking real-time.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <h3 class="feature-title">Manajemen Stok</h3>
                        <p class="feature-desc">Kelola inventori dengan mudah. Alert otomatis untuk stok menipis, tracking per cabang, dan riwayat pergerakan barang lengkap.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h3 class="feature-title">Laporan Detail</h3>
                        <p class="feature-desc">Analisis penjualan dengan grafik interaktif. Export ke PDF/CSV, filter tanggal custom, dan insights bisnis yang actionable.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-building"></i>
                        </div>
                        <h3 class="feature-title">Multi-Cabang</h3>
                        <p class="feature-desc">Kelola multiple lokasi dari satu dashboard. Monitoring stok per cabang, performa kasir, dan sinkronisasi data real-time.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3 class="feature-title">Manajemen User</h3>
                        <p class="feature-desc">Kontrol akses berbasis role (Admin & Kasir). Tracking aktivitas user, history login, dan approval produk baru.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-phone"></i>
                        </div>
                        <h3 class="feature-title">Responsive Design</h3>
                        <p class="feature-desc">Akses dari desktop, tablet, atau smartphone. Interface adaptif yang optimal di semua ukuran layar untuk mobilitas maksimal.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials" id="testimonials">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Apa Kata Pengguna</h2>
                <p class="section-subtitle">Testimoni dari pelaku UMKM yang sudah menggunakan TAGEPE</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <img src="https://i.pravatar.cc/150?img=1" alt="User" class="testimonial-avatar">
                        <div class="testimonial-rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="testimonial-text">"TAGEPE sangat membantu bisnis saya. Sekarang saya bisa monitor stok dan penjualan dari mana saja. Recommended banget!"</p>
                        <div class="testimonial-author">Budi Santoso</div>
                        <div class="testimonial-role">Owner Toko Elektronik</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <img src="https://i.pravatar.cc/150?img=5" alt="User" class="testimonial-avatar">
                        <div class="testimonial-rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="testimonial-text">"Interface-nya mudah dipahami, kasir saya langsung bisa pakai tanpa training lama. Transaksi jadi lebih cepat dan akurat."</p>
                        <div class="testimonial-author">Siti Nurhaliza</div>
                        <div class="testimonial-role">Manager Minimarket</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <img src="https://i.pravatar.cc/150?img=8" alt="User" class="testimonial-avatar">
                        <div class="testimonial-rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                        <p class="testimonial-text">"Laporan penjualannya detail banget, saya jadi tahu produk mana yang laris. Profit bisnis naik 30% sejak pakai TAGEPE!"</p>
                        <div class="testimonial-author">Ahmad Ridwan</div>
                        <div class="testimonial-role">Owner Toko Pakaian</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2>Siap Meningkatkan Bisnis Anda?</h2>
            <p>Bergabunglah dengan ratusan UMKM yang sudah menggunakan TAGEPE</p>
            <a href="{{ route('register') }}" class="btn-cta">
                Daftar Gratis Sekarang <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5><i class="bi bi-shop"></i> TAGEPE</h5>
                    <p style="color: rgba(255,255,255,0.7);">Sistem POS modern untuk UMKM Indonesia. Kelola bisnis dengan lebih mudah dan efisien.</p>
                </div>
                <div class="col-md-2 mb-4">
                    <h5>Produk</h5>
                    <ul class="footer-links">
                        <li><a href="#features">Fitur</a></li>
                        <li><a href="#testimonials">Testimoni</a></li>
                        <li><a href="#">Harga</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h5>Perusahaan</h5>
                    <ul class="footer-links">
                        <li><a href="#about">Tentang Kami</a></li>
                        <li><a href="#">Karir</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h5>Bantuan</h5>
                    <ul class="footer-links">
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Dokumentasi</a></li>
                        <li><a href="#">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h5>Legal</h5>
                    <ul class="footer-links">
                        <li><a href="#">Privasi</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 TAGEPE. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>
