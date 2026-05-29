<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Online - Tagepe-digital UMKM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { 
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body { 
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Floating Shapes Background */
        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
            pointer-events: none;
        }
        
        .shape {
            position: absolute;
            opacity: 0.1;
            animation: float 20s infinite ease-in-out;
        }
        
        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #3498db, #2980b9);
            border-radius: 50%;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #1abc9c, #16a085);
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            top: 60%;
            left: 80%;
            animation-delay: 2s;
        }
        
        .shape:nth-child(3) {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #3498db, #2ecc71);
            border-radius: 50%;
            top: 80%;
            left: 20%;
            animation-delay: 4s;
        }
        
        .shape:nth-child(4) {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            border-radius: 30%;
            top: 30%;
            left: 70%;
            animation-delay: 1s;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg) scale(1);
            }
            25% {
                transform: translateY(-30px) rotate(90deg) scale(1.1);
            }
            50% {
                transform: translateY(-60px) rotate(180deg) scale(0.9);
            }
            75% {
                transform: translateY(-30px) rotate(270deg) scale(1.1);
            }
        }

        /* Hero */
        .hero {
            background: linear-gradient(135deg, #3498db 0%, #2ecc71 100%);
            padding: 50px 0 80px;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,.08) 0%, transparent 60%);
            animation: rotate 30s linear infinite;
        }
        
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .hero::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100px;
            background: linear-gradient(to bottom, transparent, #f5f7fa);
        }
        
        .hero h1 { 
            font-size: 2.2rem;
            font-weight: 700;
            color: white;
            animation: fadeInDown 0.8s ease-out;
            text-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        
        .hero p { 
            color: rgba(255,255,255,.9);
            font-size: 1rem;
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }
        
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Navbar */
        .top-nav {
            background: rgba(255,255,255,.15);
            backdrop-filter: blur(15px);
            padding: 14px 0;
            border-bottom: 1px solid rgba(255,255,255,.2);
            animation: slideDown 0.6s ease-out;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .top-nav .brand { 
            color: white;
            font-weight: 700;
            font-size: 1.3rem;
            text-shadow: 0 2px 8px rgba(0,0,0,0.2);
            animation: pulse 2s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        .top-nav .btn {
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .top-nav .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
        }

        /* Cards produk */
        .produk-card {
            border-radius: 18px;
            border: 2px solid transparent;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            overflow: hidden;
            position: relative;
            background: white;
            animation: fadeInScale 0.6s ease-out both;
        }
        
        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        .produk-col:nth-child(1) .produk-card { animation-delay: 0.1s; }
        .produk-col:nth-child(2) .produk-card { animation-delay: 0.2s; }
        .produk-col:nth-child(3) .produk-card { animation-delay: 0.3s; }
        .produk-col:nth-child(4) .produk-card { animation-delay: 0.4s; }
        .produk-col:nth-child(5) .produk-card { animation-delay: 0.5s; }
        .produk-col:nth-child(6) .produk-card { animation-delay: 0.6s; }
        
        .produk-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(52, 152, 219, 0.1), rgba(46, 204, 113, 0.1));
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .produk-card:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 20px 40px rgba(52, 152, 219, 0.25);
            border-color: #3498db;
        }
        
        .produk-card:hover::before {
            opacity: 1;
        }
        
        .produk-card.selected {
            border-color: #3498db;
            box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.2);
            animation: selectedPulse 1.5s ease-in-out infinite;
        }
        
        @keyframes selectedPulse {
            0%, 100% {
                box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.2);
            }
            50% {
                box-shadow: 0 0 0 8px rgba(52, 152, 219, 0.3);
            }
        }
        
        .produk-card .foto {
            height: 180px;
            overflow: hidden;
            background: linear-gradient(135deg, #f0f4ff, #e8ecff);
            position: relative;
        }
        
        .produk-card .foto::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.3), transparent);
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }
        
        @keyframes shine {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }
        
        .produk-card .foto img { 
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        
        .produk-card:hover .foto img {
            transform: scale(1.1) rotate(2deg);
        }
        
        .produk-card .foto .no-foto {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            font-size: 3.5rem;
            color: #c5cae9;
            animation: bounce 2s ease-in-out infinite;
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        .harga { 
            color: #3498db;
            font-weight: 700;
            font-size: 1rem;
        }
        
        .badge-stok { 
            font-size: .7rem;
            animation: fadeIn 0.5s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Cart */
        .cart-panel {
            background: white;
            border-radius: 24px;
            box-shadow: 0 12px 40px rgba(52, 152, 219, 0.2);
            position: sticky;
            top: 20px;
            overflow: hidden;
            animation: slideInRight 0.8s ease-out;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }
        
        .cart-panel:hover {
            border-color: rgba(52, 152, 219, 0.3);
            box-shadow: 0 16px 50px rgba(52, 152, 219, 0.3);
            transform: translateY(-5px);
        }
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .cart-header {
            background: linear-gradient(135deg, #3498db, #2ecc71);
            padding: 18px 22px;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .cart-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }
        
        .cart-header i {
            animation: cartIconBounce 2s ease-in-out infinite;
        }
        
        @keyframes cartIconBounce {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            25% { transform: translateY(-5px) rotate(-10deg); }
            75% { transform: translateY(-5px) rotate(10deg); }
        }
        
        #cartCount {
            animation: badgePop 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            display: inline-block;
        }
        
        @keyframes badgePop {
            0% { transform: scale(0) rotate(0deg); }
            50% { transform: scale(1.3) rotate(180deg); }
            100% { transform: scale(1) rotate(360deg); }
        }
        
        .cart-panel .p-3 {
            position: relative;
        }
        
        .cart-panel .p-3::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #3498db, #2ecc71, transparent);
            animation: shimmerLine 2s linear infinite;
        }
        
        @keyframes shimmerLine {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        
        .cart-item {
            background: linear-gradient(135deg, #f8f9ff, #f0f4ff);
            border-radius: 12px;
            padding: 12px 14px;
            margin-bottom: 10px;
            animation: slideInLeft 0.4s ease-out;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }
        
        .cart-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(52, 152, 219, 0.1), transparent);
            transition: left 0.5s ease;
        }
        
        .cart-item:hover::before {
            left: 100%;
        }
        
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateX(0) scale(1);
            }
        }
        
        .cart-item:hover {
            transform: translateX(8px) scale(1.02);
            border-color: #3498db;
            box-shadow: 0 6px 16px rgba(52, 152, 219, 0.2);
        }
        
        .cart-item .fw-semibold {
            animation: fadeIn 0.5s ease-out;
        }
        
        .cart-item .text-muted {
            animation: fadeIn 0.5s ease-out 0.1s both;
        }
        
        /* Empty Cart Animation */
        #cartItems .text-center {
            animation: emptyCartPulse 2s ease-in-out infinite;
        }
        
        @keyframes emptyCartPulse {
            0%, 100% { opacity: 0.5; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.05); }
        }
        
        #cartItems .bi-cart {
            animation: emptyCartSway 3s ease-in-out infinite;
        }
        
        @keyframes emptyCartSway {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(-15deg); }
            75% { transform: rotate(15deg); }
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, #3498db, #2ecc71);
            border: none;
            border-radius: 14px;
            padding: 16px;
            font-weight: 700;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 8px 20px rgba(52, 152, 219, 0.4);
        }
        
        .btn-primary-custom::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255,255,255,0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(52, 152, 219, 0.5);
            color: white;
        }
        
        .btn-primary-custom:hover::before {
            width: 400px;
            height: 400px;
        }
        
        .btn-primary-custom:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }
        
        .btn-primary-custom i {
            animation: wiggle 1s ease-in-out infinite;
        }
        
        @keyframes wiggle {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(-10deg); }
            75% { transform: rotate(10deg); }
        }

        /* Search */
        .search-box {
            background: white;
            border-radius: 50px;
            padding: 12px 24px;
            border: 3px solid rgba(255,255,255,0.3);
            display: flex;
            align-items: center;
            gap: 12px;
            max-width: 500px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
            animation: fadeInUp 0.8s ease-out 0.4s both;
        }
        
        .search-box:focus-within {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(0,0,0,0.2);
            border-color: rgba(255,255,255,0.5);
        }
        
        .search-box input {
            border: none;
            outline: none;
            flex: 1;
            font-size: 1rem;
            background: transparent;
        }
        
        .search-box i {
            color: #3498db;
            font-size: 1.2rem;
            animation: searchPulse 2s ease-in-out infinite;
        }
        
        @keyframes searchPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }

        /* Section */
        .section-wrap {
            margin-top: -40px;
            position: relative;
            z-index: 10;
        }

        /* Form */
        .form-control-custom {
            border-radius: 12px;
            border: 2px solid #e8ecff;
            padding: 12px 16px;
            font-size: .95rem;
            transition: all 0.3s ease;
            background: white;
            position: relative;
        }
        
        .form-control-custom:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.15);
            transform: translateY(-2px);
            animation: inputGlow 1.5s ease-in-out infinite;
        }
        
        @keyframes inputGlow {
            0%, 100% {
                box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.15);
            }
            50% {
                box-shadow: 0 0 0 6px rgba(52, 152, 219, 0.25);
            }
        }
        
        .form-label {
            animation: labelSlide 0.5s ease-out;
        }
        
        @keyframes labelSlide {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Total */
        .total-box {
            background: linear-gradient(135deg, #e8f4fd, #d4f1e8);
            border-radius: 14px;
            padding: 16px 18px;
            border: 2px solid #3498db;
            animation: totalPulse 2s ease-in-out infinite;
            position: relative;
            overflow: hidden;
        }
        
        .total-box::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(52, 152, 219, 0.1), transparent);
            animation: totalShine 3s linear infinite;
        }
        
        @keyframes totalShine {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @keyframes totalPulse {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(52, 152, 219, 0.4);
                transform: scale(1);
            }
            50% {
                box-shadow: 0 0 0 8px rgba(52, 152, 219, 0);
                transform: scale(1.02);
            }
        }
        
        #totalHarga {
            animation: priceChange 0.5s ease-out;
            position: relative;
            z-index: 1;
        }
        
        @keyframes priceChange {
            0% { 
                transform: scale(1.5) rotate(5deg); 
                color: #e74c3c; 
            }
            50% {
                transform: scale(1.2) rotate(-5deg);
                color: #f39c12;
            }
            100% { 
                transform: scale(1) rotate(0deg); 
                color: #3498db; 
            }
        }
        
        /* Badge Animation */
        #cartCount {
            animation: badgePop 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            display: inline-block;
        }
        
        @keyframes badgePop {
            0% { transform: scale(0) rotate(0deg); }
            50% { transform: scale(1.3) rotate(180deg); }
            100% { transform: scale(1) rotate(360deg); }
        }
        
        /* Button Controls */
        .btn-outline-secondary,
        .btn-outline-danger {
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-outline-secondary::before,
        .btn-outline-danger::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            transform: translate(-50%, -50%);
            transition: width 0.3s, height 0.3s;
        }
        
        .btn-outline-secondary:active::before,
        .btn-outline-danger:active::before {
            width: 100px;
            height: 100px;
        }
        
        .btn-outline-secondary:hover {
            transform: scale(1.15) rotate(5deg);
            background: #3498db !important;
            border-color: #3498db !important;
            color: white !important;
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.4);
        }
        
        .btn-outline-danger:hover {
            transform: scale(1.15) rotate(90deg);
            box-shadow: 0 4px 12px rgba(231, 76, 60, 0.4);
        }
        
        /* Quantity Number Animation */
        .cart-item .fw-bold.small {
            animation: numberPulse 0.3s ease-out;
            display: inline-block;
        }
        
        @keyframes numberPulse {
            0% { transform: scale(1.5); color: #3498db; }
            100% { transform: scale(1); color: inherit; }
        }

        /* Tablet */
        @media (max-width: 992px) {
            .hero h1 { font-size: 1.8rem; }
            .order-card { margin-bottom: 20px; }
            .produk-card { margin-bottom: 16px; }
        }
        
        /* Mobile */
        @media (max-width: 768px) {
            .hero h1 { font-size: 1.6rem; }
            .hero { padding: 30px 0 60px; }
            .produk-card .foto { height: 140px; }
            .search-box { max-width: 100%; }
            .cart-panel:hover {
                transform: none;
            }
            .form-label {
                font-size: .9rem;
            }
            .form-control, .form-select {
                font-size: .9rem;
            }
            .btn-order {
                font-size: .95rem;
            }
        }
        
        /* Small Mobile */
        @media (max-width: 576px) {
            .hero h1 { font-size: 1.3rem; }
            .hero { padding: 25px 0 40px; }
            .produk-card .foto { height: 120px; }
            .produk-card .card-body {
                padding: 12px;
            }
            .btn-order {
                font-size: .9rem;
                padding: 10px 20px;
            }
            .cart-panel {
                width: 100%;
                right: 0;
                border-radius: 16px 16px 0 0;
            }
        }
    </style>
</head>
<body>

{{-- Floating Shapes --}}
<div class="floating-shapes">
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>
</div>

{{-- Navbar --}}
<div class="top-nav" style="background:linear-gradient(135deg,#3498db,#2ecc71)">
    <div class="container d-flex justify-content-between align-items-center">
        <span class="brand"><i class="bi bi-bag-heart-fill me-2"></i>Tagepe-digital UMKM</span>
        <div class="d-flex gap-2">
            <a href="{{ route('order.cek') }}" class="btn btn-sm btn-light rounded-pill">
                <i class="bi bi-search me-1"></i> Cek Order
            </a>
            <a href="{{ route('katalog') }}" class="btn btn-sm btn-outline-light rounded-pill">
                <i class="bi bi-grid me-1"></i> Katalog
            </a>
        </div>
    </div>
</div>

{{-- Hero --}}
<div class="hero">
    <div class="container text-center">
        <h1>🛍️ Pesan Sekarang, Bayar via QRIS / di Kasir!</h1>
        <p>Pilih produk favoritmu, isi data, dan tunjukkan kode order ke kasir.</p>
        <div class="d-flex justify-content-center mt-3">
            <form action="{{ route('order.cari') }}" method="GET" class="search-box">
                <i class="bi bi-search text-muted"></i>
                <input type="text" name="search" placeholder="Cari produk..." value="{{ $search ?? '' }}" autocomplete="off">
                <button type="submit" class="btn btn-sm px-3 rounded-pill text-white" style="background:linear-gradient(135deg,#3498db,#2ecc71);border:none">Cari</button>
            </form>
        </div>
        @if(isset($search) && $search)
        <div class="mt-2">
            <span class="badge bg-white text-primary px-3 py-2">
                Hasil: "{{ $search }}" — {{ $produks->count() }} produk
                <a href="{{ route('order.index') }}" class="ms-2 text-muted">✕</a>
            </span>
        </div>
        @endif
    </div>
</div>

{{-- Content --}}
<div class="container section-wrap pb-5">
    @if(session('error'))
        <div class="alert alert-danger rounded-3 mb-4">{{ session('error') }}</div>
    @endif

    <div class="row g-4">
        {{-- Produk --}}
        <div class="col-lg-8">
            <div class="bg-white rounded-4 shadow-sm p-4">
                <h6 class="fw-bold mb-3 text-muted text-uppercase" style="letter-spacing:1px;font-size:.75rem">
                    Pilih Produk
                </h6>
                <div class="row g-3" id="produkList">
                    @forelse($produks as $produk)
                    @php
                        $foto = $produk->foto
                            ? (str_starts_with($produk->foto,'http') ? $produk->foto : asset('storage/'.$produk->foto))
                            : null;
                    @endphp
                    <div class="col-6 col-md-4 produk-col">
                        <div class="card border-0 produk-card h-100"
                             data-id="{{ $produk->id }}"
                             data-nama="{{ $produk->nama }}"
                             data-harga="{{ $produk->harga }}"
                             data-stok="{{ $produk->stok }}"
                             onclick="tambahKeranjang(this)">
                            <div class="foto">
                                @if($foto)
                                    <img src="{{ $foto }}" alt="{{ $produk->nama }}">
                                @else
                                    <div class="no-foto"><i class="bi bi-bag"></i></div>
                                @endif
                            </div>
                            <div class="card-body p-3">
                                <div class="fw-semibold mb-1" style="font-size:.85rem;line-height:1.3">{{ $produk->nama }}</div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="harga" style="font-size:.85rem">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                    <span class="badge {{ $produk->stok > 5 ? 'bg-success' : 'bg-warning text-dark' }} badge-stok">
                                        Stok {{ $produk->stok }}
                                    </span>
                                </div>
                                <div class="text-muted small mt-1">{{ $produk->kategori->nama ?? '' }}</div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center text-muted py-5">
                        <i class="bi bi-bag-x d-block mb-2" style="font-size:3rem"></i>
                        Belum ada produk tersedia
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Cart & Form --}}
        <div class="col-lg-4">
            <div class="cart-panel">
                <div class="cart-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold"><i class="bi bi-cart3 me-2"></i>Keranjang</span>
                        <span class="badge bg-white text-primary" id="cartCount">0 item</span>
                    </div>
                </div>
                <div class="p-3">
                    <form action="{{ route('order.store') }}" method="POST" id="formOrder">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">PILIH CABANG</label>
                            <select name="cabang_id" class="form-select form-control-custom">
                                <option value="">Semua Cabang</option>
                                @foreach($cabangs as $c)
                                    <option value="{{ $c->id }}" {{ $cabang_id == $c->id ? 'selected' : '' }}>
                                        {{ $c->nama_cabang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div id="cartItems" class="mb-3">
                            <div class="text-center text-muted py-3">
                                <i class="bi bi-cart d-block mb-1" style="font-size:2rem;opacity:.3"></i>
                                <small>Klik produk untuk menambahkan</small>
                            </div>
                        </div>

                        <div class="total-box mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-semibold">Total Pembayaran</span>
                                <span class="fw-bold" id="totalHarga" style="color:#3498db;font-size:1.1rem">Rp 0</span>
                            </div>
                        </div>

                        <hr class="my-3">

                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">NAMA KAMU <span class="text-danger">*</span></label>
                            <input type="text" name="nama_customer" class="form-control form-control-custom"
                                   placeholder="Masukkan nama lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">NO. TELEPON</label>
                            <input type="text" name="telepon" class="form-control form-control-custom"
                                   placeholder="08xxxxxxxxxx">
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-semibold text-muted">CATATAN</label>
                            <textarea name="catatan" class="form-control form-control-custom" rows="2"
                                      placeholder="Catatan untuk kasir..."></textarea>
                        </div>

                        <button type="submit" class="btn-primary-custom" id="btnOrder" disabled>
                            <i class="bi bi-bag-check me-2"></i>Buat Order Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
let cart = [];

function tambahKeranjang(el) {
    const id = el.dataset.id, nama = el.dataset.nama;
    const harga = parseFloat(el.dataset.harga), stok = parseInt(el.dataset.stok);
    const existing = cart.find(i => i.id == id);
    if (existing) {
        if (existing.jumlah < stok) existing.jumlah++;
        else { alert('Stok tidak cukup!'); return; }
    } else {
        cart.push({ id, nama, harga, jumlah: 1, stok });
    }
    updateCart();
}

function updateCart() {
    const div = document.getElementById('cartItems');
    document.getElementById('cartCount').textContent = cart.reduce((s,i) => s+i.jumlah, 0) + ' item';

    if (cart.length === 0) {
        div.innerHTML = `<div class="text-center text-muted py-3">
            <i class="bi bi-cart d-block mb-1" style="font-size:2rem;opacity:.3"></i>
            <small>Klik produk untuk menambahkan</small></div>`;
        document.getElementById('btnOrder').disabled = true;
        document.getElementById('totalHarga').textContent = 'Rp 0';
        document.querySelectorAll('.produk-card').forEach(c => c.classList.remove('selected'));
        return;
    }

    let html = '', total = 0;
    cart.forEach((item, i) => {
        total += item.harga * item.jumlah;
        html += `<div class="cart-item d-flex justify-content-between align-items-center">
            <div class="flex-grow-1">
                <div class="fw-semibold" style="font-size:.82rem">${item.nama}</div>
                <div class="text-muted" style="font-size:.75rem">Rp ${item.harga.toLocaleString('id-ID')} × ${item.jumlah}</div>
                <input type="hidden" name="items[${i}][produk_id]" value="${item.id}">
                <input type="hidden" name="items[${i}][jumlah]" value="${item.jumlah}">
            </div>
            <div class="d-flex align-items-center gap-1 ms-2">
                <button type="button" class="btn btn-sm btn-outline-secondary rounded-circle p-0" style="width:24px;height:24px;line-height:1" onclick="ubahJumlah(${i},-1)">-</button>
                <span class="fw-bold small">${item.jumlah}</span>
                <button type="button" class="btn btn-sm btn-outline-secondary rounded-circle p-0" style="width:24px;height:24px;line-height:1" onclick="ubahJumlah(${i},1)">+</button>
                <button type="button" class="btn btn-sm btn-outline-danger rounded-circle p-0 ms-1" style="width:24px;height:24px;line-height:1" onclick="hapusItem(${i})">×</button>
            </div>
        </div>`;
    });

    div.innerHTML = html;
    document.getElementById('totalHarga').textContent = 'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('btnOrder').disabled = false;
    document.querySelectorAll('.produk-card').forEach(c => {
        c.classList.toggle('selected', cart.some(i => i.id == c.dataset.id));
    });
}

function ubahJumlah(index, delta) {
    const item = cart[index];
    const newJumlah = item.jumlah + delta;
    if (newJumlah <= 0) hapusItem(index);
    else if (newJumlah <= item.stok) { item.jumlah = newJumlah; updateCart(); }
    else alert('Stok tidak cukup!');
}

function hapusItem(index) { cart.splice(index, 1); updateCart(); }

document.getElementById('searchProduk').addEventListener('input', function() {
    const keyword = this.value.toLowerCase();
    document.querySelectorAll('.produk-col').forEach(col => {
        const nama = col.querySelector('.fw-semibold')?.textContent.toLowerCase() || '';
        col.style.display = nama.includes(keyword) ? '' : 'none';
    });
});
</script>
</body>
</html>
