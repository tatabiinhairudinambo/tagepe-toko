<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk - Data Toko</title>
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
        
        /* Animated Background Shapes - Geometric */
        body::before,
        body::after {
            content: '';
            position: fixed;
            z-index: 0;
            pointer-events: none;
            opacity: 0.15;
        }
        
        body::before {
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            top: -100px;
            right: -100px;
            clip-path: polygon(50% 0%, 100% 38%, 82% 100%, 18% 100%, 0% 38%);
            animation: floatHexagon 20s ease-in-out infinite;
        }
        
        body::after {
            width: 250px;
            height: 250px;
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            bottom: -80px;
            left: -80px;
            clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
            animation: floatDiamond 15s ease-in-out infinite;
        }
        
        @keyframes floatHexagon {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(-80px, 80px) rotate(180deg); }
        }
        
        @keyframes floatDiamond {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(80px, -80px) rotate(180deg); }
        }
        
        /* Floating Geometric Shapes */
        .floating-shape {
            position: fixed;
            z-index: 0;
            pointer-events: none;
            opacity: 0.12;
        }
        
        .floating-shape:nth-child(1) {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            top: 15%;
            left: 8%;
            clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
            animation: floatTriangle1 10s ease-in-out infinite;
        }
        
        .floating-shape:nth-child(2) {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            top: 55%;
            right: 12%;
            transform: rotate(45deg);
            animation: floatSquare 12s ease-in-out infinite;
        }
        
        .floating-shape:nth-child(3) {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            bottom: 25%;
            left: 15%;
            clip-path: polygon(30% 0%, 70% 0%, 100% 30%, 100% 70%, 70% 100%, 30% 100%, 0% 70%, 0% 30%);
            animation: floatOctagon 14s ease-in-out infinite;
        }
        
        /* Happy Emoji Floating */
        .happy-emoji {
            position: fixed;
            font-size: 2.5rem;
            z-index: 0;
            pointer-events: none;
            animation: emojiFloat 8s ease-in-out infinite;
        }
        
        .happy-emoji:nth-child(4) {
            content: '🎉';
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }
        
        .happy-emoji:nth-child(5) {
            content: '✨';
            top: 30%;
            right: 8%;
            animation-delay: 1s;
        }
        
        .happy-emoji:nth-child(6) {
            content: '💫';
            bottom: 30%;
            left: 10%;
            animation-delay: 2s;
        }
        
        .happy-emoji:nth-child(7) {
            content: '⭐';
            top: 50%;
            right: 5%;
            animation-delay: 3s;
        }
        
        .happy-emoji:nth-child(8) {
            content: '🌟';
            bottom: 15%;
            right: 20%;
            animation-delay: 1.5s;
        }
        
        @keyframes emojiFloat {
            0%, 100% {
                transform: translateY(0) rotate(0deg) scale(1);
                opacity: 0.3;
            }
            25% {
                transform: translateY(-20px) rotate(10deg) scale(1.2);
                opacity: 0.6;
            }
            50% {
                transform: translateY(-10px) rotate(-10deg) scale(1.1);
                opacity: 0.4;
            }
            75% {
                transform: translateY(-15px) rotate(5deg) scale(1.15);
                opacity: 0.5;
            }
        }
        
        /* Sparkle Particles */
        .sparkle-particle {
            position: fixed;
            width: 6px;
            height: 6px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            z-index: 0;
            pointer-events: none;
            box-shadow: 0 0 10px rgba(52, 152, 219, 0.8);
            animation: sparkleParticle 3s ease-in-out infinite;
        }
        
        .sparkle-particle:nth-child(9) { top: 20%; left: 15%; animation-delay: 0s; }
        .sparkle-particle:nth-child(10) { top: 40%; right: 25%; animation-delay: 0.5s; }
        .sparkle-particle:nth-child(11) { bottom: 35%; left: 25%; animation-delay: 1s; }
        .sparkle-particle:nth-child(12) { top: 60%; right: 15%; animation-delay: 1.5s; }
        .sparkle-particle:nth-child(13) { bottom: 20%; right: 30%; animation-delay: 2s; }
        
        @keyframes sparkleParticle {
            0%, 100% {
                transform: scale(0) rotate(0deg);
                opacity: 0;
            }
            50% {
                transform: scale(2) rotate(180deg);
                opacity: 1;
            }
        }
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            bottom: 25%;
            left: 15%;
            clip-path: polygon(30% 0%, 70% 0%, 100% 30%, 100% 70%, 70% 100%, 30% 100%, 0% 70%, 0% 30%);
            animation: floatOctagon 14s ease-in-out infinite;
        }
        
        @keyframes floatTriangle1 {
            0%, 100% { 
                transform: translate(0, 0) rotate(0deg);
                opacity: 0.12;
            }
            50% { 
                transform: translate(40px, -40px) rotate(120deg);
                opacity: 0.2;
            }
        }
        
        @keyframes floatSquare {
            0%, 100% { 
                transform: translate(0, 0) rotate(45deg);
                opacity: 0.12;
            }
            50% { 
                transform: translate(-50px, 50px) rotate(225deg);
                opacity: 0.2;
            }
        }
        
        @keyframes floatOctagon {
            0%, 100% { 
                transform: translate(0, 0) rotate(0deg);
                opacity: 0.12;
            }
            50% { 
                transform: translate(30px, 30px) rotate(180deg);
                opacity: 0.2;
            }
        }
        
        /* Content wrapper */
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
        
        .btn-outline-light {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .btn-outline-light::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        
        .btn-outline-light:hover::before {
            width: 300px;
            height: 300px;
        }
        
        .btn-outline-light:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3);
        }

        /* Hero */
        .hero {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 72px 0 56px;
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
            font-size: 2.6rem;
            font-weight: 800;
            margin-bottom: 12px;
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
        
        .hero h1 i {
            animation: heartBeat 1.5s ease-in-out infinite;
        }
        
        @keyframes heartBeat {
            0%, 100% { transform: scale(1); }
            10%, 30% { transform: scale(1.2); }
            20%, 40% { transform: scale(1.1); }
        }
        
        .hero p  { 
            font-size: 1.1rem;
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
        
        /* Stats Animation */
        .stats-container {
            animation: statsSlideUp 0.8s ease-out 0.6s both;
        }
        
        @keyframes statsSlideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .stat-item {
            transition: all 0.3s ease;
        }
        
        .stat-item:hover {
            transform: scale(1.1);
        }
        
        .stat-number {
            font-size: 1.8rem;
            font-weight: 800;
            animation: countUp 2s ease-out 0.8s both;
        }
        
        @keyframes countUp {
            from {
                opacity: 0;
                transform: scale(0.5);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Search Box */
        .search-box {
            position: relative;
            max-width: 500px;
            margin: 0 auto 2rem;
            animation: searchSlideDown 0.8s ease-out;
        }
        
        @keyframes searchSlideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .search-box input {
            border-radius: 50px;
            padding: 12px 50px 12px 20px;
            border: 2px solid #e0e0e0;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        
        .search-box input:focus {
            border-color: var(--primary);
            box-shadow: 0 4px 16px rgba(52, 152, 219, 0.2);
            outline: none;
        }
        
        .search-box i {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            animation: searchIconPulse 2s ease-in-out infinite;
        }
        
        @keyframes searchIconPulse {
            0%, 100% { transform: translateY(-50%) scale(1); }
            50% { transform: translateY(-50%) scale(1.2); }
        }

        /* Filter pills */
        .filter-container {
            animation: filterSlideUp 0.8s ease-out 0.2s both;
        }
        
        @keyframes filterSlideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .filter-pill {
            cursor: pointer;
            border-radius: 50px;
            padding: 8px 20px;
            font-size: .875rem;
            border: 2px solid #e0e0e0;
            background: white;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        
        .filter-pill::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(52, 152, 219, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        
        .filter-pill:hover::before {
            width: 300px;
            height: 300px;
        }
        
        .filter-pill:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.2);
            border-color: var(--primary);
        }
        
        .filter-pill.active {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-color: var(--primary);
            color: white;
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
            animation: filterActivePulse 0.5s ease-out;
        }
        
        @keyframes filterActivePulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        /* Kartu produk */
        .produk-item {
            animation: cardFadeIn 0.6s ease-out both;
        }
        
        .produk-item:nth-child(1) { animation-delay: 0.1s; }
        .produk-item:nth-child(2) { animation-delay: 0.15s; }
        .produk-item:nth-child(3) { animation-delay: 0.2s; }
        .produk-item:nth-child(4) { animation-delay: 0.25s; }
        .produk-item:nth-child(5) { animation-delay: 0.3s; }
        .produk-item:nth-child(6) { animation-delay: 0.35s; }
        .produk-item:nth-child(7) { animation-delay: 0.4s; }
        .produk-item:nth-child(8) { animation-delay: 0.45s; }
        
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
        
        .produk-card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            background: white;
            position: relative;
            cursor: pointer;
        }
        
        .produk-card::before {
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
        
        .produk-card::after {
            content: '✨';
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 1.5rem;
            opacity: 0;
            transform: scale(0) rotate(0deg);
            transition: all 0.4s ease;
            z-index: 2;
        }
        
        .produk-card:hover::before {
            left: 100%;
        }
        
        .produk-card:hover::after {
            opacity: 1;
            transform: scale(1) rotate(360deg);
        }
        
        .produk-card:hover {
            transform: translateY(-12px) scale(1.03) rotate(-1deg);
            box-shadow: 0 16px 32px rgba(52, 152, 219, 0.3), 0 0 40px rgba(46, 204, 113, 0.2);
            animation: cardBounce 0.6s ease-out;
        }
        
        @keyframes cardBounce {
            0%, 100% { transform: translateY(-12px) scale(1.03) rotate(-1deg); }
            50% { transform: translateY(-16px) scale(1.05) rotate(1deg); }
        }
        
        .produk-card .card-img-top {
            height: 200px;
            object-fit: cover;
            transition: all 0.5s ease;
        }
        
        .produk-card:hover .card-img-top {
            transform: scale(1.15) rotate(3deg);
            filter: brightness(1.1) saturate(1.2);
        }
        
        .produk-card .no-foto {
            height: 200px;
            background: linear-gradient(135deg, rgba(52, 152, 219, 0.1), rgba(46, 204, 113, 0.1));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: #94a3b8;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .produk-card .no-foto::before {
            content: '🎨';
            position: absolute;
            font-size: 4rem;
            opacity: 0;
            transform: scale(0) rotate(0deg);
            transition: all 0.5s ease;
        }
        
        .produk-card:hover .no-foto {
            background: linear-gradient(135deg, rgba(52, 152, 219, 0.2), rgba(46, 204, 113, 0.2));
        }
        
        .produk-card:hover .no-foto::before {
            opacity: 0.3;
            transform: scale(1) rotate(360deg);
        }
        
        .produk-card:hover .no-foto i {
            animation: imageIconJump 0.6s ease-out;
        }
        
        @keyframes imageIconJump {
            0%, 100% { transform: translateY(0) rotate(0deg) scale(1); }
            25% { transform: translateY(-20px) rotate(10deg) scale(1.2); }
            50% { transform: translateY(-10px) rotate(-10deg) scale(1.3); }
            75% { transform: translateY(-15px) rotate(5deg) scale(1.25); }
        }
        
        .badge-kategori {
            background: linear-gradient(135deg, rgba(52, 152, 219, 0.15), rgba(46, 204, 113, 0.15));
            color: var(--primary);
            font-size: .75rem;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 50px;
            border: 1px solid rgba(52, 152, 219, 0.3);
            animation: badgePulse 2s ease-in-out infinite;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .badge-kategori::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.8), transparent);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        
        @keyframes badgePulse {
            0%, 100% { 
                box-shadow: 0 0 0 0 rgba(52, 152, 219, 0.4);
            }
            50% { 
                box-shadow: 0 0 0 6px rgba(52, 152, 219, 0);
            }
        }
        
        .produk-card:hover .badge-kategori {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            transform: scale(1.1) rotate(-3deg);
            animation: badgeRainbow 2s linear infinite;
        }
        
        .produk-card:hover .badge-kategori::before {
            width: 200px;
            height: 200px;
        }
        
        @keyframes badgeRainbow {
            0% { filter: hue-rotate(0deg); }
            100% { filter: hue-rotate(360deg); }
        }
        
        .card-body h6 {
            transition: color 0.3s ease;
        }
        
        .produk-card:hover .card-body h6 {
            color: var(--primary);
        }
        
        .harga {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary);
            animation: priceGlow 2s ease-in-out infinite;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .harga::before {
            content: '💰';
            position: absolute;
            left: -25px;
            opacity: 0;
            transform: scale(0);
            transition: all 0.3s ease;
        }
        
        @keyframes priceGlow {
            0%, 100% {
                text-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
            }
            50% {
                text-shadow: 0 0 20px rgba(52, 152, 219, 0.8), 0 0 30px rgba(46, 204, 113, 0.5);
            }
        }
        
        .produk-card:hover .harga {
            color: var(--secondary);
            transform: scale(1.15) rotate(-3deg);
            animation: priceJump 0.6s ease-out;
        }
        
        .produk-card:hover .harga::before {
            opacity: 1;
            transform: scale(1) rotate(20deg);
        }
        
        @keyframes priceJump {
            0%, 100% { transform: scale(1.15) rotate(-3deg) translateY(0); }
            50% { transform: scale(1.2) rotate(3deg) translateY(-5px); }
        }
        
        .stok-badge {
            font-size: .75rem;
            padding: 4px 12px;
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        
        .produk-card:hover .stok-badge {
            transform: scale(1.1);
        }
        
        .bg-success {
            background: linear-gradient(135deg, var(--secondary), #27ae60) !important;
        }

        /* Empty State */
        .empty-state {
            animation: emptyStateFadeIn 0.8s ease-out;
        }
        
        @keyframes emptyStateFadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        .empty-state i {
            animation: emptyIconFloat 3s ease-in-out infinite;
        }
        
        @keyframes emptyIconFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        /* Footer */
        footer { 
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: rgba(255, 255, 255, 0.9);
            padding: 32px 0;
            margin-top: 64px;
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
        
        footer p {
            animation: footerTextFadeIn 0.8s ease-out both;
            color: rgba(255, 255, 255, 0.9);
        }
        
        footer p:nth-child(1) { animation-delay: 0.1s; }
        footer p:nth-child(2) { animation-delay: 0.2s; }
        footer p:nth-child(3) { animation-delay: 0.3s; }
        footer p:nth-child(4) { animation-delay: 0.4s; }
        
        footer strong {
            color: white !important;
        }
        
        footer .opacity-75 {
            opacity: 0.85 !important;
        }
        
        @keyframes footerTextFadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Responsive */
        /* Tablet */
        @media (max-width: 992px) {
            .hero h1 { font-size: 2.2rem; }
            .stat-number { font-size: 1.8rem; }
            .product-card { margin-bottom: 20px; }
        }
        
        /* Mobile */
        @media (max-width: 768px) {
            .hero { padding: 40px 0 60px; }
            .hero h1 { font-size: 1.8rem; }
            .hero p { font-size: 1rem; }
            .stat-number { font-size: 1.5rem; }
            .stat-label { font-size: .85rem; }
            .product-card { margin-bottom: 16px; }
            .filter-btn { 
                font-size: .85rem;
                padding: 8px 16px;
            }
        }
        
        /* Small Mobile */
        @media (max-width: 576px) {
            .hero { padding: 30px 0 40px; }
            .hero h1 { font-size: 1.5rem; }
            .stat-number { font-size: 1.3rem; }
            .product-card .card-body {
                padding: 12px;
            }
            .product-card h5 {
                font-size: .95rem;
            }
            .btn-order {
                font-size: .85rem;
                padding: 8px 16px;
            }
        }
    </style>
</head>
<body>

<!-- Floating Shapes -->
<div class="floating-shape"></div>
<div class="floating-shape"></div>
<div class="floating-shape"></div>

<!-- Happy Emoji Floating -->
<div class="happy-emoji">🎉</div>
<div class="happy-emoji">✨</div>
<div class="happy-emoji">💫</div>
<div class="happy-emoji">⭐</div>
<div class="happy-emoji">🌟</div>

<!-- Sparkle Particles -->
<div class="sparkle-particle"></div>
<div class="sparkle-particle"></div>
<div class="sparkle-particle"></div>
<div class="sparkle-particle"></div>
<div class="sparkle-particle"></div>

<div class="content-wrapper">

{{-- Navbar --}}
@php $toko = \App\Models\Toko::first(); @endphp
<nav class="navbar navbar-dark sticky-top">
    <div class="container">
        <span class="navbar-brand">
            <i class="bi bi-shop me-2"></i>{{ $toko->nama_toko ?? 'Data Toko' }}
        </span>
        <div class="d-flex gap-2">
            <a href="{{ route('artikel.index') }}" class="btn btn-outline-light btn-sm">
                <i class="bi bi-newspaper me-1"></i>Artikel & Promo
            </a>
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">
                <i class="bi bi-box-arrow-in-right me-1"></i>Login Admin
            </a>
        </div>
    </div>
</nav>

{{-- Hero --}}
<div class="hero">
    <div class="container">
        <h1><i class="bi bi-bag-heart me-2"></i>Katalog Produk</h1>
        <p>Temukan semua produk pilihan kami dengan harga terbaik</p>
        <div class="mt-4 d-flex justify-content-center gap-4 flex-wrap stats-container">
            <div class="text-center stat-item">
                <div class="stat-number">{{ $totalProduk }}</div>
                <div style="font-size:.85rem;opacity:.8">Total Produk</div>
            </div>
            <div class="text-center stat-item">
                <div class="stat-number">{{ $totalKategori }}</div>
                <div style="font-size:.85rem;opacity:.8">Kategori</div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">

    {{-- Search Box --}}
    <div class="search-box">
        <input type="text" class="form-control" id="searchInput" placeholder="Cari produk...">
        <i class="bi bi-search"></i>
    </div>

    {{-- Filter Kategori --}}
    <div class="d-flex flex-wrap gap-2 mb-4 align-items-center filter-container">
        <span class="text-muted small me-1">Filter:</span>
        <button class="filter-pill active" onclick="filterKategori('semua', this)">Semua</button>
        @foreach($kategoris as $k)
            <button class="filter-pill" onclick="filterKategori('{{ $k->id }}', this)">
                {{ $k->nama }}
            </button>
        @endforeach
    </div>

    {{-- Grid Produk --}}
    @if($produks->isEmpty())
        <div class="text-center py-5 text-muted empty-state">
            <i class="bi bi-box-seam" style="font-size:3rem"></i>
            <p class="mt-3">Belum ada produk tersedia.</p>
        </div>
    @else
        <div class="row g-4" id="produk-grid">
            @foreach($produks as $p)
            <div class="col-sm-6 col-md-4 col-lg-3 produk-item" data-kategori="{{ $p->kategori_id }}" data-nama="{{ strtolower($p->nama) }}">
                <div class="produk-card card">
                    {{-- Foto --}}
                    @if($p->foto)
                        @if(str_starts_with($p->foto, 'http'))
                            <img src="{{ $p->foto }}" class="card-img-top" alt="{{ $p->nama }}">
                        @else
                            <img src="{{ asset('storage/' . $p->foto) }}" class="card-img-top" alt="{{ $p->nama }}">
                        @endif
                    @else
                        <div class="no-foto"><i class="bi bi-image"></i></div>
                    @endif

                    <div class="card-body d-flex flex-column gap-2">
                        {{-- Kategori --}}
                        <span class="badge-kategori align-self-start">{{ $p->kategori->nama ?? '-' }}</span>

                        {{-- Nama --}}
                        <h6 class="mb-0 fw-semibold" style="line-height:1.4">{{ $p->nama }}</h6>

                        {{-- Deskripsi --}}
                        @if($p->deskripsi)
                            <p class="text-muted small mb-0" style="line-height:1.5">
                                {{ \Illuminate\Support\Str::limit($p->deskripsi, 60) }}
                            </p>
                        @endif

                        <div class="mt-auto pt-2 d-flex justify-content-between align-items-center">
                            {{-- Harga --}}
                            <span class="harga">Rp {{ number_format($p->harga, 0, ',', '.') }}</span>

                            {{-- Stok --}}
                            @if($p->stok > 0)
                                <span class="badge bg-success stok-badge">Stok {{ $p->stok }}</span>
                            @else
                                <span class="badge bg-secondary stok-badge">Habis</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

{{-- Footer --}}
<footer>
    <div class="container text-center">
        @php $toko = \App\Models\Toko::first(); @endphp
        @if($toko)
            <p class="mb-1"><i class="bi bi-shop me-1"></i> <strong style="color:white">{{ $toko->nama_toko }}</strong></p>
            <p class="small mb-1">{{ $toko->alamat }}</p>
            <p class="small mb-1">
                <i class="bi bi-telephone me-1"></i>{{ $toko->telepon }}
                @if($toko->email)
                    <span class="mx-2">|</span>
                    <i class="bi bi-envelope me-1"></i>{{ $toko->email }}
                @endif
            </p>
        @else
            <p class="mb-1"><i class="bi bi-shop me-1"></i> <strong style="color:white">Data Toko</strong></p>
        @endif
        <p class="small mb-0 mt-2 opacity-75">Sistem Manajemen Toko gue ! &mdash; Dibuat dengan bismillah</p>
    </div>
</footer>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Filter by category
function filterKategori(id, el) {
    // Update active button
    document.querySelectorAll('.filter-pill').forEach(b => b.classList.remove('active'));
    el.classList.add('active');

    // Show/hide cards with animation
    const searchValue = document.getElementById('searchInput').value.toLowerCase();
    document.querySelectorAll('.produk-item').forEach((item, index) => {
        const matchCategory = id === 'semua' || item.dataset.kategori === id;
        const matchSearch = searchValue === '' || item.dataset.nama.includes(searchValue);
        
        if (matchCategory && matchSearch) {
            item.style.display = '';
            // Re-trigger animation
            item.style.animation = 'none';
            setTimeout(() => {
                item.style.animation = `cardFadeIn 0.6s ease-out ${index * 0.05}s both`;
            }, 10);
        } else {
            item.style.display = 'none';
        }
    });
    
    playClickSound();
}

// Search functionality
document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchValue = e.target.value.toLowerCase();
    const activeFilter = document.querySelector('.filter-pill.active');
    const activeCategory = activeFilter ? activeFilter.textContent.trim() : 'Semua';
    
    document.querySelectorAll('.produk-item').forEach((item, index) => {
        const matchSearch = searchValue === '' || item.dataset.nama.includes(searchValue);
        const matchCategory = activeCategory === 'Semua' || item.querySelector('.badge-kategori').textContent.trim() === activeCategory;
        
        if (matchSearch && matchCategory) {
            item.style.display = '';
            // Re-trigger animation
            item.style.animation = 'none';
            setTimeout(() => {
                item.style.animation = `cardFadeIn 0.6s ease-out ${index * 0.05}s both`;
            }, 10);
        } else {
            item.style.display = 'none';
        }
    });
});

// Add sound effects
document.querySelectorAll('.filter-pill').forEach(pill => {
    pill.addEventListener('click', function() {
        playClickSound();
    });
    
    pill.addEventListener('mouseenter', function() {
        playHoverSound();
    });
});

// Product card hover sound
document.querySelectorAll('.produk-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        playCardHoverSound();
    });
    
    card.addEventListener('click', function() {
        playCardClickSound();
        createSparkles(this);
    });
});

// Sound functions
function playClickSound() {
    const audioContext = new (window.AudioContext || window.webkitAudioContext)();
    const osc = audioContext.createOscillator();
    const gain = audioContext.createGain();
    osc.connect(gain);
    gain.connect(audioContext.destination);
    
    osc.frequency.value = 800;
    osc.type = 'sine';
    gain.gain.setValueAtTime(0.1, audioContext.currentTime);
    gain.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.1);
    
    osc.start(audioContext.currentTime);
    osc.stop(audioContext.currentTime + 0.1);
}

function playHoverSound() {
    const audioContext = new (window.AudioContext || window.webkitAudioContext)();
    const osc = audioContext.createOscillator();
    const gain = audioContext.createGain();
    osc.connect(gain);
    gain.connect(audioContext.destination);
    
    osc.frequency.value = 600;
    osc.type = 'sine';
    gain.gain.setValueAtTime(0.03, audioContext.currentTime);
    gain.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.05);
    
    osc.start(audioContext.currentTime);
    osc.stop(audioContext.currentTime + 0.05);
}

function playCardHoverSound() {
    const audioContext = new (window.AudioContext || window.webkitAudioContext)();
    const osc = audioContext.createOscillator();
    const gain = audioContext.createGain();
    osc.connect(gain);
    gain.connect(audioContext.destination);
    
    osc.frequency.value = 1000;
    osc.type = 'sine';
    gain.gain.setValueAtTime(0.05, audioContext.currentTime);
    gain.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.08);
    
    osc.start(audioContext.currentTime);
    osc.stop(audioContext.currentTime + 0.08);
}

function playCardClickSound() {
    const audioContext = new (window.AudioContext || window.webkitAudioContext)();
    
    // Happy chime
    const notes = [
        { freq: 523.25, time: 0, duration: 0.1 },
        { freq: 659.25, time: 0.08, duration: 0.1 },
        { freq: 783.99, time: 0.16, duration: 0.15 }
    ];
    
    notes.forEach(note => {
        const osc = audioContext.createOscillator();
        const gain = audioContext.createGain();
        osc.connect(gain);
        gain.connect(audioContext.destination);
        
        osc.frequency.value = note.freq;
        osc.type = 'sine';
        gain.gain.setValueAtTime(0.15, audioContext.currentTime + note.time);
        gain.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + note.time + note.duration);
        
        osc.start(audioContext.currentTime + note.time);
        osc.stop(audioContext.currentTime + note.time + note.duration);
    });
}

// Create sparkles on click
function createSparkles(element) {
    const rect = element.getBoundingClientRect();
    const sparkleCount = 8;
    
    for (let i = 0; i < sparkleCount; i++) {
        const sparkle = document.createElement('div');
        sparkle.innerHTML = ['✨', '⭐', '💫', '🌟'][Math.floor(Math.random() * 4)];
        sparkle.style.position = 'fixed';
        sparkle.style.left = rect.left + rect.width / 2 + 'px';
        sparkle.style.top = rect.top + rect.height / 2 + 'px';
        sparkle.style.fontSize = '1.5rem';
        sparkle.style.pointerEvents = 'none';
        sparkle.style.zIndex = '9999';
        sparkle.style.transition = 'all 1s ease-out';
        
        document.body.appendChild(sparkle);
        
        const angle = (Math.PI * 2 * i) / sparkleCount;
        const distance = 100;
        const x = Math.cos(angle) * distance;
        const y = Math.sin(angle) * distance;
        
        setTimeout(() => {
            sparkle.style.transform = `translate(${x}px, ${y}px) scale(0) rotate(360deg)`;
            sparkle.style.opacity = '0';
        }, 10);
        
        setTimeout(() => {
            sparkle.remove();
        }, 1000);
    }
}

// Welcome sound on page load
window.addEventListener('load', function() {
    setTimeout(() => {
        const audioContext = new (window.AudioContext || window.webkitAudioContext)();
        const notes = [
            { freq: 523.25, time: 0, duration: 0.15 },
            { freq: 659.25, time: 0.15, duration: 0.15 },
            { freq: 783.99, time: 0.3, duration: 0.2 }
        ];
        
        notes.forEach(note => {
            const osc = audioContext.createOscillator();
            const gain = audioContext.createGain();
            osc.connect(gain);
            gain.connect(audioContext.destination);
            
            osc.frequency.value = note.freq;
            osc.type = 'sine';
            gain.gain.setValueAtTime(0.1, audioContext.currentTime + note.time);
            gain.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + note.time + note.duration);
            
            osc.start(audioContext.currentTime + note.time);
            osc.stop(audioContext.currentTime + note.time + note.duration);
        });
    }, 500);
});
</script>
</body>
</html>
