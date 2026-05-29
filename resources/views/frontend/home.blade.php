@extends('frontend.layout.app')

@section('title', 'Home')

@push('styles')
<style>
    /* Hero Section Fullscreen */
    .hero-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
        animation: heroFadeIn 1s ease-out;
    }
    
    @keyframes heroFadeIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .hero-title {
        font-size: 4rem;
        font-weight: 900;
        line-height: 1.2;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, var(--primary), var(--secondary), var(--accent));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: titleSlideUp 0.8s ease-out 0.2s both;
    }
    
    @keyframes titleSlideUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .hero-subtitle {
        font-size: 1.5rem;
        color: var(--text-secondary);
        margin-bottom: 2rem;
        animation: subtitleFadeIn 0.8s ease-out 0.4s both;
    }
    
    @keyframes subtitleFadeIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .hero-buttons {
        animation: buttonsFadeIn 0.8s ease-out 0.6s both;
    }
    
    @keyframes buttonsFadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .hero-image {
        position: relative;
        animation: imageFloat 3s ease-in-out infinite;
    }
    
    @keyframes imageFloat {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }
    
    /* Stats Section */
    .stats-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
    }
    
    .stats-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 32px rgba(99, 102, 241, 0.2);
    }
    
    .stats-number {
        font-size: 3rem;
        font-weight: 900;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    /* Product Card */
    .product-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        height: 100%;
    }
    
    .product-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 16px 40px rgba(99, 102, 241, 0.3);
    }
    
    .product-image {
        height: 250px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .product-card:hover .product-image {
        transform: scale(1.1);
    }
    
    .product-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        background: linear-gradient(135deg, var(--danger), var(--warning));
        color: white;
        z-index: 2;
    }
    
    .product-price {
        font-size: 1.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    /* Article Card */
    .article-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s ease;
        height: 100%;
    }
    
    .article-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 16px 40px rgba(99, 102, 241, 0.3);
    }
    
    .article-image {
        height: 200px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .article-card:hover .article-image {
        transform: scale(1.1);
    }
    
    /* Testimonial Card */
    .testimonial-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        padding: 2rem;
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 32px rgba(99, 102, 241, 0.2);
    }
    
    .testimonial-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--primary);
    }
    
    .rating-stars {
        color: var(--warning);
    }
    
    /* Section Title */
    .section-title {
        font-size: 2.5rem;
        font-weight: 900;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .section-subtitle {
        font-size: 1.2rem;
        color: var(--text-secondary);
        margin-bottom: 3rem;
    }
    
    /* Banner Slider */
    .banner-slider {
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 16px 48px rgba(0, 0, 0, 0.2);
    }
    
    .banner-slide {
        height: 500px;
        background-size: cover;
        background-position: center;
        position: relative;
    }
    
    .banner-content {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 3rem;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
        color: white;
    }
    
    /* Promo Banner */
    .promo-banner {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 24px;
        padding: 3rem;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .promo-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="40" fill="rgba(255,255,255,0.05)"/></svg>');
        opacity: 0.3;
    }
    
    /* Responsive */
    /* Tablet */
    @media (max-width: 992px) {
        .hero-section {
            padding: 80px 0 60px;
        }
        .hero-title {
            font-size: 2.8rem;
        }
        .hero-subtitle {
            font-size: 1.3rem;
        }
        .section-title {
            font-size: 2.2rem;
        }
        .stat-number {
            font-size: 2rem;
        }
        .banner-slide {
            height: 350px;
        }
    }
    
    /* Mobile */
    @media (max-width: 768px) {
        .hero-section {
            padding: 60px 0 40px;
        }
        .hero-title {
            font-size: 2.2rem;
            line-height: 1.3;
        }
        .hero-subtitle {
            font-size: 1.1rem;
        }
        .section-title {
            font-size: 1.8rem;
        }
        .stat-number {
            font-size: 1.8rem;
        }
        .stat-label {
            font-size: .9rem;
        }
        .banner-slide {
            height: 280px;
        }
        .product-card {
            margin-bottom: 20px;
        }
        .kategori-card {
            margin-bottom: 16px;
        }
        .testimoni-card {
            margin-bottom: 20px;
        }
    }
    
    /* Small Mobile */
    @media (max-width: 576px) {
        .hero-section {
            padding: 50px 0 30px;
        }
        .hero-title {
            font-size: 1.8rem;
        }
        .hero-subtitle {
            font-size: 1rem;
        }
        .section-title {
            font-size: 1.5rem;
        }
        .stat-number {
            font-size: 1.5rem;
        }
        .banner-slide {
            height: 220px;
        }
        .btn-hero {
            padding: 12px 24px;
            font-size: .95rem;
        }
    }
</style>
@endpush

@section('content')

{{-- Hero Section --}}
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <h1 class="hero-title">
                        Belanja Modern<br>
                        Lebih Mudah & Cepat
                    </h1>
                    <p class="hero-subtitle">
                        Temukan produk berkualitas dengan harga terbaik. Pengalaman belanja online yang menyenangkan dimulai dari sini.
                    </p>
                    <div class="hero-buttons d-flex gap-3 flex-wrap">
                        <a href="{{ route('katalog') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-grid me-2"></i>Lihat Produk
                        </a>
                        <a href="{{ route('order.index') }}" class="btn btn-outline-primary btn-lg">
                            <i class="bi bi-cart me-2"></i>Mulai Belanja
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image text-center">
                    <img src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=600&h=600&fit=crop" 
                         alt="Hero" 
                         class="img-fluid rounded-4"
                         style="max-width: 500px;">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Stats Section --}}
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3 col-6">
                <div class="stats-card">
                    <div class="stats-number">500+</div>
                    <div class="text-muted">Produk</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stats-card">
                    <div class="stats-number">1K+</div>
                    <div class="text-muted">Customer</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stats-card">
                    <div class="stats-number">4.9</div>
                    <div class="text-muted">Rating</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stats-card">
                    <div class="stats-number">24/7</div>
                    <div class="text-muted">Support</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Banner Slider --}}
@if($banners->count() > 0)
<section class="py-5">
    <div class="container">
        <div id="bannerCarousel" class="carousel slide banner-slider" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach($banners as $index => $banner)
                <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="{{ $index }}" 
                        class="{{ $index === 0 ? 'active' : '' }}"></button>
                @endforeach
            </div>
            <div class="carousel-inner">
                @foreach($banners as $index => $banner)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <div class="banner-slide" style="background-image: url('{{ asset('storage/' . $banner->gambar) }}');">
                        <div class="banner-content">
                            <h2 class="display-4 fw-bold">{{ $banner->judul }}</h2>
                            <p class="lead">{{ $banner->deskripsi }}</p>
                            @if($banner->link)
                            <a href="{{ $banner->link }}" class="btn btn-light btn-lg">
                                Lihat Selengkapnya <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
</section>
@endif

{{-- Produk Unggulan --}}
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">✨ Produk Unggulan</h2>
            <p class="section-subtitle">Produk terbaik pilihan kami untuk Anda</p>
        </div>
        
        <div class="row g-4">
            @forelse($produkUnggulan as $produk)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product-card">
                    <div class="position-relative">
                        @if($produk->foto)
                            <img src="{{ asset('storage/' . $produk->foto) }}" 
                                 class="product-image w-100" 
                                 alt="{{ $produk->nama }}">
                        @else
                            <div class="product-image w-100 d-flex align-items-center justify-content-center bg-secondary">
                                <i class="bi bi-image" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                        <span class="product-badge">NEW</span>
                    </div>
                    <div class="p-3">
                        <div class="small text-muted mb-2">{{ $produk->kategori->nama ?? 'Uncategorized' }}</div>
                        <h5 class="fw-bold mb-2">{{ $produk->nama }}</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="product-price">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
                            <span class="badge bg-success">Stok: {{ $produk->stok }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-box-seam" style="font-size: 4rem; color: var(--text-muted);"></i>
                <p class="text-muted mt-3">Belum ada produk tersedia</p>
            </div>
            @endforelse
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('katalog') }}" class="btn btn-outline-primary btn-lg">
                Lihat Semua Produk <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

{{-- Promo Banner --}}
<section class="py-5">
    <div class="container">
        <div class="promo-banner">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h2 class="display-5 fw-bold mb-3">🎉 Promo Spesial Hari Ini!</h2>
                    <p class="lead mb-4">Dapatkan diskon hingga 50% untuk produk pilihan. Buruan sebelum kehabisan!</p>
                    <a href="{{ route('katalog') }}" class="btn btn-light btn-lg">
                        <i class="bi bi-tag me-2"></i>Lihat Promo
                    </a>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="display-1 fw-bold">50%</div>
                    <div class="h4">OFF</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Artikel Terbaru --}}
@if($artikels->count() > 0)
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">📰 Artikel Terbaru</h2>
            <p class="section-subtitle">Baca tips dan informasi menarik seputar belanja</p>
        </div>
        
        <div class="row g-4">
            @foreach($artikels as $artikel)
            <div class="col-lg-4 col-md-6">
                <div class="article-card">
                    <div class="overflow-hidden">
                        <img src="{{ $artikel->gambar ?? 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=600&h=400&fit=crop' }}" 
                             class="article-image w-100" 
                             alt="{{ $artikel->judul }}">
                    </div>
                    <div class="p-4">
                        <div class="small text-muted mb-2">
                            <i class="bi bi-calendar3 me-1"></i>
                            {{ $artikel->created_at->format('d M Y') }}
                        </div>
                        <h5 class="fw-bold mb-3">{{ $artikel->judul }}</h5>
                        <p class="text-muted mb-3">{{ Str::limit($artikel->excerpt, 100) }}</p>
                        <a href="#" class="btn btn-sm btn-outline-primary">
                            Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('artikel.index') }}" class="btn btn-outline-primary btn-lg">
                Lihat Semua Artikel <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

{{-- Testimoni --}}
@if($testimonis->count() > 0)
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">💬 Testimoni Customer</h2>
            <p class="section-subtitle">Apa kata mereka tentang kami</p>
        </div>
        
        <div class="row g-4">
            @foreach($testimonis as $testimoni)
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ $testimoni->foto ?? 'https://ui-avatars.com/api/?name=' . urlencode($testimoni->nama) }}" 
                             class="testimonial-avatar me-3" 
                             alt="{{ $testimoni->nama }}">
                        <div>
                            <h6 class="fw-bold mb-1">{{ $testimoni->nama }}</h6>
                            <div class="rating-stars">
                                @for($i = 0; $i < $testimoni->rating; $i++)
                                <i class="bi bi-star-fill"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <p class="text-muted">"{{ $testimoni->testimoni }}"</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA Section --}}
<section class="py-5">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title mb-4">Siap Mulai Belanja? 🛒</h2>
            <p class="section-subtitle mb-4">Dapatkan pengalaman belanja terbaik bersama kami</p>
            <a href="{{ route('order.index') }}" class="btn btn-primary btn-lg px-5">
                <i class="bi bi-cart-plus me-2"></i>Mulai Belanja Sekarang
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
// Auto play carousel
const carousel = new bootstrap.Carousel(document.getElementById('bannerCarousel'), {
    interval: 5000,
    wrap: true
});
</script>
@endpush
