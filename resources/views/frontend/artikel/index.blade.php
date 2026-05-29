<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel & Promo - {{ $toko->nama_toko ?? 'Data Toko' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        :root {
            --primary: #3498db;
            --secondary: #2ecc71;
            --dark: #2c3e50;
        }
        
        body { 
            background: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            position: relative;
            overflow-x: hidden;
        }
        
        /* Animated Background */
        body::before {
            content: '';
            position: fixed;
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            top: -150px;
            right: -150px;
            clip-path: polygon(50% 0%, 100% 38%, 82% 100%, 18% 100%, 0% 38%);
            opacity: 0.1;
            animation: floatShape 20s ease-in-out infinite;
            z-index: 0;
        }
        
        @keyframes floatShape {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(-100px, 100px) rotate(180deg); }
        }
        
        .content-wrapper {
            position: relative;
            z-index: 1;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, var(--primary), var(--secondary)) !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            animation: navSlideDown 0.6s ease-out;
        }
        
        @keyframes navSlideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        .navbar-brand { 
            font-weight: 700;
            font-size: 1.4rem;
            letter-spacing: .5px;
            animation: brandPulse 2s ease-in-out infinite;
        }
        
        @keyframes brandPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        .navbar-brand i {
            animation: iconBounce 2s ease-in-out infinite;
        }
        
        @keyframes iconBounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
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
            background: white;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .nav-link:hover::after {
            width: 80%;
        }
        
        .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }

        /* Hero */
        .hero {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 80px 0 60px;
            text-align: center;
            position: relative;
            overflow: hidden;
            animation: heroFadeIn 1s ease-out;
        }
        
        @keyframes heroFadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%);
            animation: heroShine 3s linear infinite;
        }
        
        @keyframes heroShine {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        
        .hero h1 { 
            font-size: 2.8rem;
            font-weight: 800;
            margin-bottom: 16px;
            position: relative;
            z-index: 1;
            animation: titleSlideUp 0.8s ease-out 0.2s both;
        }
        
        @keyframes titleSlideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .hero p  { 
            font-size: 1.2rem;
            opacity: .9;
            position: relative;
            z-index: 1;
            animation: subtitleFadeIn 0.8s ease-out 0.4s both;
        }
        
        @keyframes subtitleFadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 0.9;
                transform: translateY(0);
            }
        }

        /* Promo Banner */
        .promo-section {
            padding: 40px 0;
            animation: sectionFadeIn 0.8s ease-out 0.6s both;
        }
        
        @keyframes sectionFadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .promo-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            cursor: pointer;
            height: 100%;
        }
        
        .promo-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s;
            z-index: 1;
        }
        
        .promo-card:hover::before {
            left: 100%;
        }
        
        .promo-card:hover {
            transform: translateY(-10px) scale(1.03);
            box-shadow: 0 16px 40px rgba(52, 152, 219, 0.3);
        }
        
        .promo-card img {
            height: 200px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .promo-card:hover img {
            transform: scale(1.1);
        }
        
        .promo-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            z-index: 2;
            animation: badgePulse 2s ease-in-out infinite;
        }
        
        @keyframes badgePulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        /* Article Card */
        .article-card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            background: white;
            cursor: pointer;
            animation: cardFadeIn 0.6s ease-out both;
        }
        
        .article-card:nth-child(1) { animation-delay: 0.1s; }
        .article-card:nth-child(2) { animation-delay: 0.15s; }
        .article-card:nth-child(3) { animation-delay: 0.2s; }
        .article-card:nth-child(4) { animation-delay: 0.25s; }
        .article-card:nth-child(5) { animation-delay: 0.3s; }
        .article-card:nth-child(6) { animation-delay: 0.35s; }
        
        @keyframes cardFadeIn {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        .article-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s;
            z-index: 1;
        }
        
        .article-card:hover::before {
            left: 100%;
        }
        
        .article-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 28px rgba(52, 152, 219, 0.25);
        }
        
        .article-card img {
            height: 220px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .article-card:hover img {
            transform: scale(1.1) rotate(2deg);
        }
        
        .article-kategori {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            background: linear-gradient(135deg, rgba(52, 152, 219, 0.15), rgba(46, 204, 113, 0.15));
            color: var(--primary);
            border: 1px solid rgba(52, 152, 219, 0.3);
            margin-bottom: 8px;
        }
        
        .article-card:hover .article-kategori {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            transform: scale(1.05);
        }
        
        .article-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
            transition: color 0.3s ease;
        }
        
        .article-card:hover .article-title {
            color: var(--primary);
        }
        
        .article-date {
            font-size: 0.85rem;
            color: #6c757d;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .article-date i {
            animation: iconPulse 2s ease-in-out infinite;
        }
        
        @keyframes iconPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }

        /* Section Title */
        .section-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 12px;
            position: relative;
            display: inline-block;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 2px;
        }
        
        .section-subtitle {
            color: #6c757d;
            font-size: 1.1rem;
            margin-bottom: 40px;
        }

        /* Footer */
        footer { 
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: rgba(255, 255, 255, 0.9);
            padding: 40px 0;
            margin-top: 80px;
            position: relative;
            overflow: hidden;
        }
        
        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.3));
            animation: footerWave 3s linear infinite;
        }
        
        @keyframes footerWave {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        
        footer strong {
            color: white !important;
        }

        /* Responsive */
        /* Tablet */
        @media (max-width: 992px) {
            .hero h1 { font-size: 2.2rem; }
            .section-title { font-size: 1.8rem; }
            .artikel-card { margin-bottom: 20px; }
        }
        
        /* Mobile */
        @media (max-width: 768px) {
            .hero { padding: 40px 0 60px; }
            .hero h1 { font-size: 1.8rem; }
            .hero p { font-size: 1rem; }
            .section-title { font-size: 1.5rem; }
            .artikel-card { margin-bottom: 16px; }
            .artikel-card .card-body {
                padding: 16px;
            }
            .filter-btn {
                font-size: .85rem;
                padding: 8px 16px;
                margin-bottom: 8px;
            }
        }
        
        /* Small Mobile */
        @media (max-width: 576px) {
            .hero { padding: 30px 0 40px; }
            .hero h1 { font-size: 1.5rem; }
            .section-title { font-size: 1.3rem; }
            .artikel-card h5 {
                font-size: 1rem;
            }
            .artikel-card .small {
                font-size: .8rem;
            }
        }
    </style>
</head>
<body>

<div class="content-wrapper">

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('katalog') }}">
            <i class="bi bi-shop me-2"></i>{{ $toko->nama_toko ?? 'Data Toko' }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('katalog') }}">
                        <i class="bi bi-grid me-1"></i>Katalog
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('artikel.index') }}">
                        <i class="bi bi-newspaper me-1"></i>Artikel & Promo
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('order.index') }}">
                        <i class="bi bi-cart me-1"></i>Order
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Login
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- Hero --}}
<div class="hero">
    <div class="container">
        <h1><i class="bi bi-newspaper me-2"></i>Artikel & Promo</h1>
        <p>Dapatkan informasi terbaru, tips belanja, dan promo menarik dari kami!</p>
    </div>
</div>

{{-- Promo Section --}}
<section class="promo-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">🎉 Promo Spesial</h2>
            <p class="section-subtitle">Jangan lewatkan penawaran terbaik kami!</p>
        </div>
        
        <div class="row g-4">
            @foreach($promosis as $promo)
            <div class="col-md-4">
                <div class="promo-card card">
                    <span class="badge bg-{{ $promo['warna'] }} promo-badge">{{ $promo['badge'] }}</span>
                    <img src="{{ $promo['gambar'] }}" class="card-img-top" alt="{{ $promo['judul'] }}">
                    <div class="card-body">
                        <h5 class="fw-bold mb-2">{{ $promo['judul'] }}</h5>
                        <p class="text-muted small mb-3">{{ $promo['deskripsi'] }}</p>
                        <a href="{{ route('order.index') }}" class="btn btn-sm btn-primary rounded-pill">
                            <i class="bi bi-cart-plus me-1"></i>Belanja Sekarang
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Article Section --}}
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">📰 Artikel Terbaru</h2>
            <p class="section-subtitle">Baca artikel menarik seputar belanja dan produk kami</p>
        </div>
        
        <div class="row g-4">
            @foreach($artikels as $artikel)
            <div class="col-md-6 col-lg-4">
                <div class="article-card card">
                    <img src="{{ $artikel['gambar'] }}" class="card-img-top" alt="{{ $artikel['judul'] }}">
                    <div class="card-body">
                        <span class="article-kategori">{{ $artikel['kategori'] }}</span>
                        <h5 class="article-title">{{ $artikel['judul'] }}</h5>
                        <p class="text-muted small mb-3">{{ $artikel['excerpt'] }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="article-date">
                                <i class="bi bi-calendar3"></i>
                                {{ \Carbon\Carbon::parse($artikel['tanggal'])->format('d M Y') }}
                            </span>
                            <a href="#" class="btn btn-sm btn-outline-primary rounded-pill">
                                Baca <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="py-5" style="background: linear-gradient(135deg, rgba(52, 152, 219, 0.1), rgba(46, 204, 113, 0.1));">
    <div class="container text-center">
        <h3 class="fw-bold mb-3">Siap Berbelanja? 🛒</h3>
        <p class="text-muted mb-4">Lihat katalog lengkap produk kami dan mulai belanja sekarang!</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="{{ route('katalog') }}" class="btn btn-primary btn-lg rounded-pill px-4">
                <i class="bi bi-grid me-2"></i>Lihat Katalog
            </a>
            <a href="{{ route('order.index') }}" class="btn btn-success btn-lg rounded-pill px-4">
                <i class="bi bi-cart-plus me-2"></i>Mulai Order
            </a>
        </div>
    </div>
</section>

{{-- Footer --}}
<footer>
    <div class="container text-center">
        <p class="mb-1"><i class="bi bi-shop me-1"></i> <strong>{{ $toko->nama_toko ?? 'Data Toko' }}</strong></p>
        @if($toko)
            <p class="small mb-1">{{ $toko->alamat }}</p>
            <p class="small mb-1">
                <i class="bi bi-telephone me-1"></i>{{ $toko->telepon }}
                @if($toko->email)
                    <span class="mx-2">|</span>
                    <i class="bi bi-envelope me-1"></i>{{ $toko->email }}
                @endif
            </p>
        @endif
        <p class="small mb-0 mt-3 opacity-75">Sistem Manajemen Toko gue ! &mdash; Dibuat dengan bismillah</p>
    </div>
</footer>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Add hover sound effects
document.querySelectorAll('.promo-card, .article-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        playHoverSound();
    });
});

function playHoverSound() {
    const audioContext = new (window.AudioContext || window.webkitAudioContext)();
    const osc = audioContext.createOscillator();
    const gain = audioContext.createGain();
    osc.connect(gain);
    gain.connect(audioContext.destination);
    
    osc.frequency.value = 800;
    osc.type = 'sine';
    gain.gain.setValueAtTime(0.05, audioContext.currentTime);
    gain.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.08);
    
    osc.start(audioContext.currentTime);
    osc.stop(audioContext.currentTime + 0.08);
}

// Welcome sound
window.addEventListener('load', function() {
    setTimeout(() => {
        const audioContext = new (window.AudioContext || window.webkitAudioContext)();
        const notes = [
            { freq: 523.25, time: 0, duration: 0.12 },
            { freq: 659.25, time: 0.12, duration: 0.12 },
            { freq: 783.99, time: 0.24, duration: 0.15 }
        ];
        
        notes.forEach(note => {
            const osc = audioContext.createOscillator();
            const gain = audioContext.createGain();
            osc.connect(gain);
            gain.connect(audioContext.destination);
            
            osc.frequency.value = note.freq;
            osc.type = 'sine';
            gain.gain.setValueAtTime(0.08, audioContext.currentTime + note.time);
            gain.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + note.time + note.duration);
            
            osc.start(audioContext.currentTime + note.time);
            osc.stop(audioContext.currentTime + note.time + note.duration);
        });
    }, 500);
});
</script>
</body>
</html>
