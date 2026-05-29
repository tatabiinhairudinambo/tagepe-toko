<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Berhasil - Tagepe-digital UMKM</title>
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
            background: linear-gradient(135deg, #3498db 0%, #2ecc71 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        
        /* Animated Background Particles */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            animation: particleMove 20s ease-in-out infinite;
        }
        
        @keyframes particleMove {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(50px, 50px); }
        }
        
        /* Confetti Animation */
        .confetti {
            position: fixed;
            width: 10px;
            height: 10px;
            background: #f39c12;
            position: absolute;
            animation: confettiFall 3s linear infinite;
        }
        
        .confetti:nth-child(1) { left: 10%; animation-delay: 0s; background: #e74c3c; }
        .confetti:nth-child(2) { left: 20%; animation-delay: 0.5s; background: #3498db; }
        .confetti:nth-child(3) { left: 30%; animation-delay: 1s; background: #2ecc71; }
        .confetti:nth-child(4) { left: 40%; animation-delay: 1.5s; background: #f39c12; }
        .confetti:nth-child(5) { left: 50%; animation-delay: 0.3s; background: #9b59b6; }
        .confetti:nth-child(6) { left: 60%; animation-delay: 0.8s; background: #1abc9c; }
        .confetti:nth-child(7) { left: 70%; animation-delay: 1.2s; background: #e67e22; }
        .confetti:nth-child(8) { left: 80%; animation-delay: 0.6s; background: #e91e63; }
        .confetti:nth-child(9) { left: 90%; animation-delay: 1.8s; background: #00bcd4; }
        .confetti:nth-child(10) { left: 15%; animation-delay: 0.2s; background: #ff5722; }
        .confetti:nth-child(11) { left: 25%; animation-delay: 0.7s; background: #4caf50; }
        .confetti:nth-child(12) { left: 35%; animation-delay: 1.3s; background: #ffeb3b; }
        .confetti:nth-child(13) { left: 45%; animation-delay: 0.4s; background: #ff9800; }
        .confetti:nth-child(14) { left: 55%; animation-delay: 1.1s; background: #03a9f4; }
        .confetti:nth-child(15) { left: 65%; animation-delay: 0.9s; background: #8bc34a; }
        
        @keyframes confettiFall {
            0% {
                transform: translateY(-100vh) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(720deg);
                opacity: 0;
            }
        }
        
        /* Floating Balloons */
        .balloon {
            position: fixed;
            width: 50px;
            height: 60px;
            border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
            animation: balloonFloat 6s ease-in-out infinite;
            bottom: -100px;
        }
        
        .balloon:nth-child(16) { left: 5%; animation-delay: 0s; background: linear-gradient(135deg, #e74c3c, #c0392b); }
        .balloon:nth-child(17) { left: 25%; animation-delay: 1s; background: linear-gradient(135deg, #3498db, #2980b9); }
        .balloon:nth-child(18) { left: 45%; animation-delay: 2s; background: linear-gradient(135deg, #2ecc71, #27ae60); }
        .balloon:nth-child(19) { left: 65%; animation-delay: 0.5s; background: linear-gradient(135deg, #f39c12, #e67e22); }
        .balloon:nth-child(20) { left: 85%; animation-delay: 1.5s; background: linear-gradient(135deg, #9b59b6, #8e44ad); }
        
        @keyframes balloonFloat {
            0% {
                transform: translateY(0) translateX(0) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-120vh) translateX(50px) rotate(20deg);
                opacity: 0;
            }
        }
        
        /* Sparkles */
        .sparkle {
            position: fixed;
            width: 4px;
            height: 4px;
            background: #fff;
            border-radius: 50%;
            box-shadow: 0 0 10px #fff, 0 0 20px #fff;
            animation: sparkleAnimation 2s ease-in-out infinite;
        }
        
        .sparkle:nth-child(21) { top: 20%; left: 10%; animation-delay: 0s; }
        .sparkle:nth-child(22) { top: 40%; left: 30%; animation-delay: 0.3s; }
        .sparkle:nth-child(23) { top: 60%; left: 50%; animation-delay: 0.6s; }
        .sparkle:nth-child(24) { top: 30%; left: 70%; animation-delay: 0.9s; }
        .sparkle:nth-child(25) { top: 50%; left: 90%; animation-delay: 1.2s; }
        .sparkle:nth-child(26) { top: 70%; left: 20%; animation-delay: 0.4s; }
        .sparkle:nth-child(27) { top: 80%; left: 60%; animation-delay: 0.8s; }
        .sparkle:nth-child(28) { top: 10%; left: 80%; animation-delay: 1s; }
        
        @keyframes sparkleAnimation {
            0%, 100% {
                transform: scale(0);
                opacity: 0;
            }
            50% {
                transform: scale(1.5);
                opacity: 1;
            }
        }
        
        /* Stars */
        .star {
            position: fixed;
            font-size: 2rem;
            animation: starTwinkle 3s ease-in-out infinite;
        }
        
        .star:nth-child(29) { top: 15%; left: 15%; animation-delay: 0s; }
        .star:nth-child(30) { top: 25%; left: 85%; animation-delay: 0.5s; }
        .star:nth-child(31) { top: 75%; left: 10%; animation-delay: 1s; }
        .star:nth-child(32) { top: 85%; left: 80%; animation-delay: 1.5s; }
        
        @keyframes starTwinkle {
            0%, 100% {
                transform: scale(0) rotate(0deg);
                opacity: 0;
            }
            50% {
                transform: scale(1.2) rotate(180deg);
                opacity: 1;
            }
        }
        
        /* Card Animation */
        .card { 
            border-radius: 28px;
            border: none;
            animation: cardSlideUp 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        @keyframes cardSlideUp {
            from {
                opacity: 0;
                transform: translateY(100px) scale(0.8);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        .card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(52, 152, 219, 0.05), transparent);
            animation: cardShine 3s linear infinite;
        }
        
        @keyframes cardShine {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Success Icon Animation */
        .success-icon {
            font-size: 5rem;
            animation: 
                successBounce 1s ease-out,
                successRotate 2s ease-in-out 1s infinite,
                successGlow 2s ease-in-out infinite;
            display: inline-block;
            filter: drop-shadow(0 0 20px rgba(255, 215, 0, 0.8));
        }
        
        @keyframes successBounce {
            0% {
                transform: scale(0) rotate(0deg);
                opacity: 0;
            }
            50% {
                transform: scale(1.5) rotate(180deg);
            }
            70% {
                transform: scale(0.9) rotate(360deg);
            }
            100% {
                transform: scale(1) rotate(360deg);
                opacity: 1;
            }
        }
        
        @keyframes successRotate {
            0%, 100% { transform: rotate(0deg) scale(1); }
            25% { transform: rotate(-15deg) scale(1.15); }
            75% { transform: rotate(15deg) scale(1.15); }
        }
        
        @keyframes successGlow {
            0%, 100% {
                filter: drop-shadow(0 0 20px rgba(255, 215, 0, 0.8));
            }
            50% {
                filter: drop-shadow(0 0 40px rgba(255, 215, 0, 1));
            }
        }
        
        /* Title Animation */
        .card h4 {
            animation: titleFadeIn 0.8s ease-out 0.3s both;
        }
        
        @keyframes titleFadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .card p {
            animation: subtitleFadeIn 0.8s ease-out 0.5s both;
        }
        
        @keyframes subtitleFadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Kode Box Animation */
        .kode-box {
            background: linear-gradient(135deg, #3498db, #2ecc71);
            border-radius: 18px;
            padding: 24px;
            color: white;
            text-align: center;
            animation: 
                kodeBoxPulse 2s ease-in-out infinite,
                kodeBoxSlide 0.8s ease-out 0.7s both,
                kodeBoxRainbow 5s linear infinite;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(52, 152, 219, 0.4);
        }
        
        @keyframes kodeBoxSlide {
            from {
                opacity: 0;
                transform: scale(0.8) rotate(-5deg);
            }
            to {
                opacity: 1;
                transform: scale(1) rotate(0deg);
            }
        }
        
        @keyframes kodeBoxPulse {
            0%, 100% {
                box-shadow: 0 8px 24px rgba(52, 152, 219, 0.4);
                transform: scale(1);
            }
            50% {
                box-shadow: 0 12px 40px rgba(52, 152, 219, 0.8), 0 0 60px rgba(46, 204, 113, 0.6);
                transform: scale(1.03);
            }
        }
        
        @keyframes kodeBoxRainbow {
            0% { filter: hue-rotate(0deg); }
            100% { filter: hue-rotate(360deg); }
        }
        
        .kode-box::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
            animation: kodeGlow 3s linear infinite;
        }
        
        @keyframes kodeGlow {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .kode-box::after {
            content: '✨';
            position: absolute;
            font-size: 2rem;
            animation: kodeSparkle 2s ease-in-out infinite;
        }
        
        @keyframes kodeSparkle {
            0% { top: 10%; left: 10%; opacity: 0; transform: scale(0); }
            25% { top: 10%; left: 90%; opacity: 1; transform: scale(1); }
            50% { top: 90%; left: 90%; opacity: 1; transform: scale(1); }
            75% { top: 90%; left: 10%; opacity: 1; transform: scale(1); }
            100% { top: 10%; left: 10%; opacity: 0; transform: scale(0); }
        }
        
        .kode-text { 
            font-size: 1.4rem;
            font-weight: 800;
            letter-spacing: 2px;
            animation: kodeTextPulse 1.5s ease-in-out infinite, kodeTextGlow 2s ease-in-out infinite;
            position: relative;
            z-index: 1;
            text-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            white-space: nowrap;
            word-break: keep-all;
        }
        
        @keyframes kodeTextPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.08); }
        }
        
        @keyframes kodeTextGlow {
            0%, 100% {
                text-shadow: 0 4px 12px rgba(0, 0, 0, 0.3), 0 0 20px rgba(255, 255, 255, 0.5);
            }
            50% {
                text-shadow: 0 4px 12px rgba(0, 0, 0, 0.3), 0 0 40px rgba(255, 255, 255, 0.8);
            }
        }
        
        /* Steps Animation */
        .step { 
            display: flex;
            align-items: flex-start;
            gap: 14px;
            margin-bottom: 14px;
            animation: stepSlideIn 0.6s ease-out both;
            transition: all 0.3s ease;
            padding: 8px;
            border-radius: 10px;
        }
        
        .step:nth-child(1) { animation-delay: 0.9s; }
        .step:nth-child(2) { animation-delay: 1.1s; }
        .step:nth-child(3) { animation-delay: 1.3s; }
        
        @keyframes stepSlideIn {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .step:hover {
            background: rgba(52, 152, 219, 0.05);
            transform: translateX(10px);
        }
        
        .step-num {
            width: 32px;
            height: 32px;
            min-width: 32px;
            background: linear-gradient(135deg, #3498db, #2ecc71);
            border-radius: 50%;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .85rem;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
            animation: stepNumBounce 2s ease-in-out infinite;
        }
        
        @keyframes stepNumBounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        
        .step:nth-child(1) .step-num { animation-delay: 0s; }
        .step:nth-child(2) .step-num { animation-delay: 0.3s; }
        .step:nth-child(3) .step-num { animation-delay: 0.6s; }
        
        /* Summary Box Animation */
        .bg-light {
            animation: summaryFadeIn 0.8s ease-out 1.5s both;
            transition: all 0.3s ease;
        }
        
        @keyframes summaryFadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .bg-light:hover {
            background: rgba(52, 152, 219, 0.05) !important;
            transform: scale(1.02);
        }
        
        /* Item List Animation */
        .bg-light .d-flex {
            animation: itemSlideIn 0.4s ease-out both;
        }
        
        .bg-light .d-flex:nth-child(1) { animation-delay: 1.6s; }
        .bg-light .d-flex:nth-child(2) { animation-delay: 1.7s; }
        .bg-light .d-flex:nth-child(3) { animation-delay: 1.8s; }
        .bg-light .d-flex:nth-child(4) { animation-delay: 1.9s; }
        
        @keyframes itemSlideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        /* Total Price Animation */
        .bg-light .fw-bold span:last-child {
            animation: totalPriceGlow 2s ease-in-out infinite;
            display: inline-block;
        }
        
        @keyframes totalPriceGlow {
            0%, 100% {
                color: #3498db;
                text-shadow: 0 0 10px rgba(52, 152, 219, 0.3);
            }
            50% {
                color: #2ecc71;
                text-shadow: 0 0 20px rgba(46, 204, 113, 0.5);
            }
        }
        
        /* Button Animation */
        .btn {
            animation: buttonFadeIn 0.8s ease-out 1.7s both;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        @keyframes buttonFadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .btn::before {
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
        
        .btn:hover::before {
            width: 300px;
            height: 300px;
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        
        .btn:active {
            transform: translateY(-1px);
        }
        
        .btn i {
            animation: iconWiggle 1s ease-in-out infinite;
        }
        
        @keyframes iconWiggle {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(-10deg); }
            75% { transform: rotate(10deg); }
        }
        
        /* Section Title Animation */
        .fw-semibold.small.text-muted {
            animation: sectionTitleSlide 0.6s ease-out 0.8s both;
        }
        
        @keyframes sectionTitleSlide {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        /* Responsive */
        @media (max-width: 576px) {
            .success-icon { font-size: 4rem; }
            .kode-text { 
                font-size: 1.1rem; 
                letter-spacing: 1px; 
            }
            .kode-box {
                padding: 18px;
            }
        }
    </style>
</head>
<body>

<!-- Confetti -->
<div class="confetti"></div>
<div class="confetti"></div>
<div class="confetti"></div>
<div class="confetti"></div>
<div class="confetti"></div>
<div class="confetti"></div>
<div class="confetti"></div>
<div class="confetti"></div>
<div class="confetti"></div>
<div class="confetti"></div>
<div class="confetti"></div>
<div class="confetti"></div>
<div class="confetti"></div>
<div class="confetti"></div>
<div class="confetti"></div>

<!-- Balloons -->
<div class="balloon"></div>
<div class="balloon"></div>
<div class="balloon"></div>
<div class="balloon"></div>
<div class="balloon"></div>

<!-- Sparkles -->
<div class="sparkle"></div>
<div class="sparkle"></div>
<div class="sparkle"></div>
<div class="sparkle"></div>
<div class="sparkle"></div>
<div class="sparkle"></div>
<div class="sparkle"></div>
<div class="sparkle"></div>

<!-- Stars -->
<div class="star">⭐</div>
<div class="star">✨</div>
<div class="star">💫</div>
<div class="star">🌟</div>
<div class="container py-4">
    <div class="card shadow-lg mx-auto" style="max-width:500px">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <div class="success-icon">🎉</div>
                <h4 class="fw-bold mb-1">Order Berhasil!</h4>
                <p class="text-muted small">Hei <strong>{{ $order->nama_customer }}</strong>, pesananmu sudah masuk!</p>
            </div>

            <div class="kode-box mb-4">
                <div class="small opacity-75 mb-1">Kode Order Kamu</div>
                <div class="kode-text">{{ $order->kode_order }}</div>
                <div class="small opacity-75 mt-1">Simpan kode ini!</div>
            </div>

            <div class="mb-4">
                <div class="fw-semibold small text-muted text-uppercase mb-3" style="letter-spacing:1px">Langkah Selanjutnya</div>
                <div class="step">
                    <div class="step-num">1</div>
                    <div class="small">Tunjukkan kode order ke kasir di cabang <strong>{{ $order->cabang->nama_cabang ?? 'terdekat' }}</strong></div>
                </div>
                <div class="step">
                    <div class="step-num">2</div>
                    <div class="small">Kasir akan memproses pesananmu</div>
                </div>
                <div class="step">
                    <div class="step-num">3</div>
                    <div class="small">Lakukan pembayaran sebesar <strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong></div>
                </div>
            </div>

            <div class="bg-light rounded-3 p-3 mb-4">
                <div class="small fw-semibold mb-2">Ringkasan Pesanan</div>
                @foreach($order->details as $d)
                <div class="d-flex justify-content-between small mb-1">
                    <span>{{ $d->produk->nama }} ×{{ $d->jumlah }}</span>
                    <span>Rp {{ number_format($d->subtotal, 0, ',', '.') }}</span>
                </div>
                @endforeach
                <hr class="my-2">
                <div class="d-flex justify-content-between small fw-bold">
                    <span>Total</span>
                    <span style="color:#667eea">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('order.cek') }}?kode={{ $order->kode_order }}"
                   class="btn btn-outline-secondary flex-fill rounded-3">
                    <i class="bi bi-search me-1"></i> Cek Status
                </a>
                <a href="{{ route('order.index') }}"
                   class="btn flex-fill rounded-3 text-white"
                   style="background:linear-gradient(135deg,#3498db,#2ecc71)">
                    <i class="bi bi-plus me-1"></i> Order Lagi
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// Text-to-Speech: "Orderan Berhasil"
window.addEventListener('load', function() {
    // Check if browser supports Speech Synthesis
    if ('speechSynthesis' in window) {
        setTimeout(() => {
            const utterance = new SpeechSynthesisUtterance('Orderan Berhasil');
            
            // Set voice properties
            utterance.lang = 'id-ID'; // Indonesian language
            utterance.rate = 1.0; // Normal speed
            utterance.pitch = 1.2; // Slightly higher pitch for excitement
            utterance.volume = 1.0; // Full volume
            
            // Try to use Google Indonesian voice if available
            const voices = speechSynthesis.getVoices();
            const indonesianVoice = voices.find(voice => 
                voice.lang === 'id-ID' || 
                voice.lang.startsWith('id') ||
                voice.name.includes('Indonesian') ||
                voice.name.includes('Google')
            );
            
            if (indonesianVoice) {
                utterance.voice = indonesianVoice;
            }
            
            // Speak the text
            speechSynthesis.speak(utterance);
            
            // Optional: Add celebration sound after speech
            utterance.onend = function() {
                playCelebrationSound();
            };
        }, 800);
    } else {
        // Fallback to audio beep if speech not supported
        setTimeout(() => {
            playCelebrationSound();
        }, 800);
    }
    
    // Load voices (some browsers need this)
    if (speechSynthesis.onvoiceschanged !== undefined) {
        speechSynthesis.onvoiceschanged = function() {
            // Voices loaded
        };
    }
    
    // Celebration Sound Effect (as backup/complement)
    function playCelebrationSound() {
        const audioContext = new (window.AudioContext || window.webkitAudioContext)();
        const now = audioContext.currentTime;
        
        // Success chime
        const notes = [
            { freq: 523.25, time: 0, duration: 0.15 },    // C
            { freq: 659.25, time: 0.15, duration: 0.15 }, // E
            { freq: 783.99, time: 0.3, duration: 0.15 },  // G
            { freq: 1046.50, time: 0.45, duration: 0.4 }  // C (high)
        ];
        
        notes.forEach(note => {
            const osc = audioContext.createOscillator();
            const gain = audioContext.createGain();
            osc.connect(gain);
            gain.connect(audioContext.destination);
            
            osc.frequency.value = note.freq;
            osc.type = 'sine';
            gain.gain.setValueAtTime(0.2, now + note.time);
            gain.gain.exponentialRampToValueAtTime(0.01, now + note.time + note.duration);
            
            osc.start(now + note.time);
            osc.stop(now + note.time + note.duration);
        });
    }
    
    // Add click sound to buttons
    document.querySelectorAll('.btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            // Prevent default to allow speech to work
            if ('speechSynthesis' in window) {
                const clickSound = new SpeechSynthesisUtterance('klik');
                clickSound.lang = 'id-ID';
                clickSound.rate = 2.0;
                clickSound.volume = 0.3;
                clickSound.pitch = 1.5;
                
                // Don't block the click, just play sound
                setTimeout(() => {
                    speechSynthesis.speak(clickSound);
                }, 0);
            }
        });
    });
    
    // Hover sound for buttons (subtle beep)
    document.querySelectorAll('.btn').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
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
        });
    });
});
</script>
</body>
</html>
