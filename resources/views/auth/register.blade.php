<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - TAGEPE UMKM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
            overflow-y: auto;
        }
        
        /* Split Screen Container */
        .login-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Left Side - Branding */
        .left-side {
            flex: 1;
            background: 
                linear-gradient(135deg, rgba(44, 62, 80, 0.5) 0%, rgba(52, 73, 94, 0.6) 50%, rgba(69, 90, 100, 0.5) 100%),
                url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=1200&q=80') center/cover;
            background-attachment: fixed;
            animation: backgroundZoom 20s ease-in-out infinite alternate;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }
        
        @keyframes backgroundZoom {
            0% { 
                background-size: 100% auto;
            }
            100% { 
                background-size: 110% auto;
            }
        }
        
        /* Animated Background Pattern */
        .left-side::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: 
                repeating-linear-gradient(
                    45deg,
                    transparent,
                    transparent 10px,
                    rgba(255, 255, 255, 0.01) 10px,
                    rgba(255, 255, 255, 0.01) 20px
                ),
                radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
            animation: patternMove 30s linear infinite;
        }
        
        /* Overlay gradient untuk depth */
        .left-side::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 30% 50%, rgba(96, 125, 139, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 70% 70%, rgba(120, 144, 156, 0.2) 0%, transparent 50%),
                linear-gradient(135deg, rgba(0,0,0,0.15) 0%, rgba(0,0,0,0.3) 100%);
            pointer-events: none;
            animation: overlayPulse 8s ease-in-out infinite;
        }
        
        @keyframes overlayPulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        
        @keyframes patternMove {
            0% { transform: translate(0, 0) rotate(0deg); }
            100% { transform: translate(50px, 50px) rotate(360deg); }
        }
        
        /* Floating Shapes - Lebih banyak dan berwarna */
        .shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.25;
            animation: float 15s ease-in-out infinite;
            mix-blend-mode: screen;
        }
        
        .shape:nth-child(1) {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.4) 0%, transparent 70%);
            top: -200px;
            right: -200px;
            animation-delay: 0s;
        }
        
        .shape:nth-child(2) {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(120, 144, 156, 0.4) 0%, transparent 70%);
            bottom: -150px;
            left: -150px;
            animation-delay: 2s;
        }
        
        .shape:nth-child(3) {
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(96, 125, 139, 0.3) 0%, transparent 70%);
            top: 30%;
            left: 5%;
            animation-delay: 4s;
        }
        
        .shape:nth-child(4) {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(69, 90, 100, 0.35) 0%, transparent 70%);
            top: 10%;
            right: 15%;
            animation-delay: 6s;
        }
        
        @keyframes float {
            0%, 100% { 
                transform: translate(0, 0) scale(1) rotate(0deg); 
                opacity: 0.4;
            }
            25% { 
                transform: translate(40px, -40px) scale(1.15) rotate(90deg); 
                opacity: 0.6;
            }
            50% { 
                transform: translate(-30px, 30px) scale(0.85) rotate(180deg); 
                opacity: 0.3;
            }
            75% { 
                transform: translate(50px, 15px) scale(1.1) rotate(270deg); 
                opacity: 0.5;
            }
        }
        
        /* Particles Effect */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }
        
        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            animation: particleFloat 10s linear infinite;
        }
        
        @keyframes particleFloat {
            0% {
                transform: translateY(100vh) translateX(0) scale(0);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) translateX(100px) scale(1);
                opacity: 0;
            }
        }
        
        .particle:nth-child(1) { left: 10%; animation-delay: 0s; animation-duration: 8s; }
        .particle:nth-child(2) { left: 20%; animation-delay: 1s; animation-duration: 10s; }
        .particle:nth-child(3) { left: 30%; animation-delay: 2s; animation-duration: 9s; }
        .particle:nth-child(4) { left: 40%; animation-delay: 0.5s; animation-duration: 11s; }
        .particle:nth-child(5) { left: 50%; animation-delay: 1.5s; animation-duration: 8.5s; }
        .particle:nth-child(6) { left: 60%; animation-delay: 2.5s; animation-duration: 10.5s; }
        .particle:nth-child(7) { left: 70%; animation-delay: 0.8s; animation-duration: 9.5s; }
        .particle:nth-child(8) { left: 80%; animation-delay: 1.8s; animation-duration: 11.5s; }
        .particle:nth-child(9) { left: 90%; animation-delay: 2.8s; animation-duration: 8.8s; }
        .particle:nth-child(10) { left: 15%; animation-delay: 3s; animation-duration: 10.2s; }
        
        /* Light Rays Effect */
        .light-rays {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
            pointer-events: none;
        }
        
        .ray {
            position: absolute;
            width: 2px;
            height: 100%;
            background: linear-gradient(to bottom, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: rayMove 8s linear infinite;
            opacity: 0;
        }
        
        @keyframes rayMove {
            0% {
                transform: translateX(-100px) translateY(-100%);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateX(100px) translateY(100%);
                opacity: 0;
            }
        }
        
        .ray:nth-child(1) { left: 10%; animation-delay: 0s; }
        .ray:nth-child(2) { left: 30%; animation-delay: 2s; }
        .ray:nth-child(3) { left: 50%; animation-delay: 4s; }
        .ray:nth-child(4) { left: 70%; animation-delay: 6s; }
        .ray:nth-child(5) { left: 90%; animation-delay: 1s; }
        
        /* Shimmer Effect */
        .shimmer {
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.1),
                transparent
            );
            animation: shimmerMove 3s ease-in-out infinite;
            pointer-events: none;
        }
        
        @keyframes shimmerMove {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(100%);
            }
        }
        
        /* Logo & Brand */
        .brand-section {
            position: relative;
            z-index: 2;
            animation: slideInLeft 0.8s ease-out;
        }
        
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .logo-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 0;
            margin-top: 20px;
            padding: 10px;
            animation: slideInUp 0.8s ease-out;
        }
        
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .logo-wrapper img {
            width: 60px;
            height: 60px;
            object-fit: contain;
            filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.4));
        }
        
        .brand-name {
            font-size: 1.5rem;
            font-weight: 900;
            color: #ffffff;
            letter-spacing: -0.5px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
            margin-bottom: 0;
            text-align: center;
        }
        
        .brand-tagline {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
            padding-left: 0;
            text-align: center;
        }
        
        /* Background Text Top Right */
        .bg-text-topright {
            position: absolute;
            top: 30px;
            left: 30px;
            font-size: 1.2rem;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.15);
            letter-spacing: 2px;
            text-transform: uppercase;
            z-index: 1;
            animation: fadeIn 0.8s ease-out 0.5s both;
            pointer-events: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .playstore-icon {
            pointer-events: auto;
            color: rgba(255, 255, 255, 0.3);
            font-size: 1.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .playstore-icon:hover {
            color: rgba(255, 255, 255, 0.6);
            transform: scale(1.1);
        }
        
        .main-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 12px;
            line-height: 1.2;
        }
        
        .highlight {
            background: linear-gradient(135deg, #3498db, #2ecc71);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .description {
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.5;
            margin-bottom: 20px;
        }
        
        /* Features List */
        .features {
            list-style: none;
            padding: 0;
            margin-bottom: 15px;
        }
        
        .features li {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 10px;
            font-size: 0.9rem;
            animation: fadeInUp 0.6s ease-out both;
        }
        
        .features li:nth-child(1) { animation-delay: 0.2s; }
        .features li:nth-child(2) { animation-delay: 0.3s; }
        .features li:nth-child(3) { animation-delay: 0.4s; }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .features li i {
            width: 20px;
            height: 20px;
            background: rgba(46, 204, 113, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2ecc71;
            font-size: 0.7rem;
        }
        
        /* Articles Section */
        .articles-section {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            animation: fadeInUp 0.6s ease-out 0.5s both;
        }
        
        .articles-title {
            font-size: 1rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .articles-title i {
            color: #3498db;
            font-size: 1.1rem;
        }
        
        .articles-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .article-item {
            display: flex;
            gap: 12px;
            padding: 12px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .article-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
            border-color: rgba(52, 152, 219, 0.3);
        }
        
        .article-icon {
            flex-shrink: 0;
            width: 35px;
            height: 35px;
            background: rgba(52, 152, 219, 0.2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #3498db;
            font-size: 1rem;
        }
        
        .article-content h4 {
            font-size: 0.85rem;
            font-weight: 600;
            color: #ffffff;
            margin: 0 0 3px 0;
            line-height: 1.3;
        }
        
        .article-content p {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.7);
            margin: 0;
            line-height: 1.3;
        }
        
        /* Info Section */
        .info-section {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            animation: fadeInUp 0.6s ease-out 0.6s both;
        }
        
        .info-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .info-card:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateX(5px);
        }
        
        .info-icon {
            flex-shrink: 0;
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, rgba(52, 152, 219, 0.3) 0%, rgba(41, 128, 185, 0.3) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #3498db;
            font-size: 1.3rem;
        }
        
        .info-text h4 {
            font-size: 0.85rem;
            font-weight: 700;
            color: #ffffff;
            margin: 0 0 2px 0;
        }
        
        .info-text p {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.7);
            margin: 0;
            line-height: 1.2;
        }
        
        /* Right Side - Form */
        .right-side {
            flex: 0 0 500px;
            background: linear-gradient(180deg, #0a0e27 0%, #16213e 50%, #0f3460 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            position: relative;
            overflow: hidden;
        }
        
        /* Form Container Wrapper - Smartphone Shape */
        .right-side > div {
            width: 380px;
            position: relative;
            z-index: 2;
            background: linear-gradient(180deg, #1a1a3e 0%, #0f1b3a 100%);
            border-radius: 45px;
            padding: 40px 35px;
            box-shadow: 
                0 0 0 3px rgba(100, 200, 255, 0.4),
                0 0 20px rgba(100, 200, 255, 0.6),
                0 0 40px rgba(100, 200, 255, 0.4),
                0 0 60px rgba(100, 200, 255, 0.2),
                inset 0 0 60px rgba(100, 200, 255, 0.05);
            animation: phoneGlow 3s ease-in-out infinite;
        }
        
        @keyframes phoneGlow {
            0%, 100% {
                box-shadow: 
                    0 0 0 3px rgba(100, 200, 255, 0.4),
                    0 0 20px rgba(100, 200, 255, 0.6),
                    0 0 40px rgba(100, 200, 255, 0.4),
                    0 0 60px rgba(100, 200, 255, 0.2),
                    inset 0 0 60px rgba(100, 200, 255, 0.05);
            }
            50% {
                box-shadow: 
                    0 0 0 3px rgba(100, 200, 255, 0.6),
                    0 0 30px rgba(100, 200, 255, 0.8),
                    0 0 50px rgba(100, 200, 255, 0.6),
                    0 0 80px rgba(100, 200, 255, 0.3),
                    inset 0 0 80px rgba(100, 200, 255, 0.08);
            }
        }
        
        /* Phone Notch */
        .right-side > div::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 50%;
            transform: translateX(-50%);
            width: 120px;
            height: 25px;
            background: #0a0e27;
            border-radius: 0 0 20px 20px;
            box-shadow: inset 0 -2px 5px rgba(0, 0, 0, 0.5);
            z-index: 10;
        }
        
        /* Camera Dot */
        .right-side > div::after {
            content: '';
            position: absolute;
            top: 23px;
            left: 50%;
            transform: translateX(-50%);
            width: 8px;
            height: 8px;
            background: radial-gradient(circle, #1a3a5a 0%, #0a1a2a 100%);
            border-radius: 50%;
            box-shadow: 
                0 0 3px rgba(100, 200, 255, 0.3),
                inset 0 1px 2px rgba(255, 255, 255, 0.1);
            z-index: 11;
        }
        
        /* Phone Frame Effect */
        .right-side::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 420px;
            height: 90%;
            border: 2px solid rgba(100, 200, 255, 0.15);
            border-radius: 50px;
            pointer-events: none;
            z-index: 1;
        }
        
        /* Stars Background */
        .right-side::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(2px 2px at 20% 30%, white, transparent),
                radial-gradient(2px 2px at 60% 70%, white, transparent),
                radial-gradient(1px 1px at 50% 50%, white, transparent),
                radial-gradient(1px 1px at 80% 10%, white, transparent),
                radial-gradient(2px 2px at 90% 60%, white, transparent),
                radial-gradient(1px 1px at 33% 80%, white, transparent);
            background-size: 200% 200%;
            animation: starsMove 20s linear infinite;
            opacity: 0.5;
        }
        
        @keyframes starsMove {
            0% { background-position: 0% 0%; }
            100% { background-position: 100% 100%; }
        }
        
        .form-header {
            text-align: center;
            margin-bottom: 20px;
            margin-top: 15px;
            animation: fadeIn 0.8s ease-out 0.3s both;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        /* Mascot Phone */
        .phone-mascot {
            text-align: center;
            margin-bottom: 10px;
            animation: float 3s ease-in-out infinite;
        }
        
        .phone-mascot .mascot-icon {
            width: 80px;
            height: 80px;
            display: inline-block;
            object-fit: contain;
            filter: drop-shadow(0 4px 15px rgba(100, 200, 255, 0.5));
        }
        
        .phone-mascot .mascot-text {
            margin-top: 5px;
            font-size: 0.75rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.4);
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }
        
        .form-header h2 {
            font-size: 1.5rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 8px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }
        
        .form-header .emoji {
            display: none;
        }
        
        .form-header p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            margin: 0;
        }
        
        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
            animation: fadeInUp 0.6s ease-out both;
            position: relative;
        }
        
        .form-group:nth-child(1) { animation-delay: 0.4s; }
        .form-group:nth-child(2) { animation-delay: 0.5s; }
        
        .form-label {
            display: none;
        }
        
        .form-control {
            width: 100%;
            padding: 15px 20px 15px 50px;
            border: 2px solid rgba(100, 200, 255, 0.3);
            border-radius: 25px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, rgba(100, 200, 255, 0.2) 0%, rgba(50, 150, 255, 0.3) 100%);
            color: #ffffff;
            display: block;
            position: relative;
            z-index: 1;
        }
        
        .form-control:focus {
            outline: none;
            border-color: rgba(100, 200, 255, 0.6);
            background: linear-gradient(135deg, rgba(100, 200, 255, 0.3) 0%, rgba(50, 150, 255, 0.4) 100%);
            box-shadow: 0 0 20px rgba(100, 200, 255, 0.4);
        }
        
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }
        
        /* Input Icons */
        .form-group i:not(.toggle-password) {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #000000;
            font-size: 1.1rem;
            z-index: 100;
            pointer-events: none;
        }
        
        /* Toggle Password */
        .toggle-password {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #000000 !important;
            font-size: 1.1rem;
            cursor: pointer;
            z-index: 101;
            transition: color 0.3s ease;
            pointer-events: auto !important;
            left: auto !important;
        }
        
        .toggle-password:hover {
            color: #333333 !important;
        }
        
        /* Remember & Forgot */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            margin-top: 0;
            font-size: 0.85rem;
            animation: fadeInUp 0.6s ease-out 0.6s both;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: rgba(255, 255, 255, 0.9);
            cursor: pointer;
        }
        
        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #00d4ff;
        }
        
        .forgot-link {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .forgot-link:hover {
            color: #00d4ff;
        }
        
        /* Submit Button */
        .btn-submit {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #ff9800 0%, #ff6b00 100%);
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 1.1rem;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.6s ease-out 0.7s both;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            box-shadow: 0 4px 15px rgba(255, 152, 0, 0.4);
            margin-top: 0;
            display: block;
        }
        
        .btn-submit::before {
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
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(255, 152, 0, 0.6);
        }
        
        .btn-submit:hover::before {
            width: 400px;
            height: 400px;
        }
        
        .btn-submit:active {
            transform: translateY(0);
        }
        
        /* Register Link */
        .register-section {
            text-align: center;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
            animation: fadeIn 0.8s ease-out 0.8s both;
        }
        
        .register-link {
            color: #ffd700;
            text-decoration: none;
            font-weight: 700;
            margin-left: 5px;
            transition: color 0.3s ease;
        }
        
        .register-link:hover {
            color: #ffed4e;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }
        
        /* Alert */
        .alert {
            padding: 12px 16px;
            border-radius: 15px;
            margin-bottom: 25px;
            border: 2px solid rgba(255, 100, 100, 0.3);
            background: rgba(255, 100, 100, 0.2);
            color: #fff;
            font-size: 0.9rem;
            animation: shake 0.5s, fadeIn 0.4s;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-6px); }
            20%, 40%, 60%, 80% { transform: translateX(6px); }
        }
        
        /* Footer */
        .form-footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.8rem;
            color: #95a5a6;
            animation: fadeIn 0.8s ease-out 0.9s both;
        }
        
        .form-footer i {
            color: #2ecc71;
            margin-right: 5px;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .login-container {
                flex-direction: column;
            }
            
            .left-side {
                flex: 0 0 auto;
                padding: 40px 30px;
                min-height: 40vh;
            }
            
            .right-side {
                flex: 1;
                padding: 40px 20px;
            }
            
            .right-side > div {
                width: 100%;
                max-width: 380px;
            }
            
            .main-title {
                font-size: 2rem;
            }
            
            .features {
                display: none;
            }
            
            .articles-section {
                display: none;
            }
            
            .info-section {
                display: none;
            }
        }
        
        @media (max-width: 576px) {
            .left-side {
                padding: 30px 20px;
            }
            
            .right-side {
                padding: 30px 15px;
            }
            
            .right-side > div {
                width: 100%;
                max-width: 340px;
                padding: 35px 25px;
            }
            
            .main-title {
                font-size: 1.6rem;
            }
            
            .form-header h2 {
                font-size: 1.3rem;
            }
            
            .phone-mascot .mascot-icon {
                width: 90px;
                height: 90px;
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    {{-- Left Side - Branding --}}
    <div class="left-side">
        {{-- Shimmer Effect --}}
        <div class="shimmer"></div>
        
        {{-- Light Rays --}}
        <div class="light-rays">
            <div class="ray"></div>
            <div class="ray"></div>
            <div class="ray"></div>
            <div class="ray"></div>
            <div class="ray"></div>
        </div>
        
        {{-- Particles --}}
        <div class="particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>
        
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        
        {{-- Background Text Top Right --}}
        <div class="bg-text-topright">
            <span class="playstore-icon">
                <i class="bi bi-google-play"></i>
            </span>
            Tagepe-digital UMKM
        </div>
        
        {{-- Content Section --}}
        <div class="brand-section">
            <h1 class="main-title">
                Bergabung bersama kami<br>
                <span class="highlight">Mulai kelola bisnis Anda</span>
            </h1>
            
            <p class="description">
                Daftar sekarang dan nikmati kemudahan mengelola toko dengan sistem POS modern yang powerful dan mudah digunakan.
            </p>
            
            <ul class="features">
                <li>
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Gratis untuk memulai</span>
                </li>
                <li>
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Setup cepat dalam 5 menit</span>
                </li>
                <li>
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Dukungan pelanggan 24/7</span>
                </li>
            </ul>
            
            {{-- Benefits Section --}}
            <div class="articles-section">
                <h3 class="articles-title">
                    <i class="bi bi-gift"></i> Keuntungan Bergabung
                </h3>
                <div class="articles-list">
                    <div class="article-item">
                        <div class="article-icon">
                            <i class="bi bi-rocket-takeoff"></i>
                        </div>
                        <div class="article-content">
                            <h4>Mulai Cepat & Mudah</h4>
                            <p>Tidak perlu pengalaman teknis, langsung bisa digunakan</p>
                        </div>
                    </div>
                    
                    <div class="article-item">
                        <div class="article-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div class="article-content">
                            <h4>Keamanan Terjamin</h4>
                            <p>Data bisnis Anda terenkripsi dan aman</p>
                        </div>
                    </div>
                    
                    <div class="article-item">
                        <div class="article-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="article-content">
                            <h4>Komunitas Aktif</h4>
                            <p>Bergabung dengan ribuan pemilik bisnis lainnya</p>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Additional Info Section --}}
            <div class="info-section">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="bi bi-lightning-charge"></i>
                    </div>
                    <div class="info-text">
                        <h4>Aktivasi Instan</h4>
                        <p>Akun langsung aktif setelah pendaftaran</p>
                    </div>
                </div>
                
                <div class="info-card">
                    <div class="info-icon">
                        <i class="bi bi-phone"></i>
                    </div>
                    <div class="info-text">
                        <h4>Mobile Friendly</h4>
                        <p>Kelola bisnis dari smartphone Anda</p>
                    </div>
                </div>
                
                <div class="info-card">
                    <div class="info-icon">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>
                    <div class="info-text">
                        <h4>Update Berkala</h4>
                        <p>Fitur baru ditambahkan secara rutin</p>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Logo at Bottom Left --}}
        <div class="logo-wrapper">
            <div class="brand-name">TAGEPE UMKM</div>
            <img src="{{ asset('images/logotokotagepe.png') }}" alt="Tagepe UMKM Logo">
            <div class="brand-tagline">Point of Sale System</div>
        </div>
    </div>
    
    {{-- Right Side - Form --}}
    <div class="right-side">
        <div>
            {{-- Phone Mascot --}}
            <div class="phone-mascot">
                <img src="{{ asset('images/logotokotagepe.png') }}" alt="Tagepe Logo" class="mascot-icon">
                <div class="mascot-text">TAGEPE-DIGITAL UMKM</div>
            </div>
            
            <div class="form-header">
                <h2>Daftar Akun Baru</h2>
                <p>Isi data Anda untuk membuat akun</p>
            </div>
            
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <strong>{{ $errors->first() }}</strong>
                </div>
            @endif
            
            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <i class="bi bi-person-fill"></i>
                    <input type="text" 
                           name="name" 
                           class="form-control" 
                           placeholder="Nama Lengkap" 
                           value="{{ old('name') }}" 
                           required 
                           autofocus>
                </div>
                
                <div class="form-group">
                    <i class="bi bi-envelope-fill"></i>
                    <input type="email" 
                           name="email" 
                           class="form-control" 
                           placeholder="Email" 
                           value="{{ old('email') }}" 
                           required>
                </div>
                
                <div class="form-group">
                    <i class="bi bi-lock-fill"></i>
                    <input type="password" 
                           id="password"
                           name="password" 
                           class="form-control" 
                           placeholder="Password (minimal 6 karakter)" 
                           required>
                    <i class="bi bi-eye toggle-password" onclick="togglePassword('password', this)"></i>
                </div>
                
                <div class="form-group">
                    <i class="bi bi-lock-fill"></i>
                    <input type="password" 
                           id="password_confirmation"
                           name="password_confirmation" 
                           class="form-control" 
                           placeholder="Konfirmasi Password" 
                           required>
                    <i class="bi bi-eye toggle-password" onclick="togglePassword('password_confirmation', this)"></i>
                </div>
                
                <button type="submit" class="btn-submit">
                    Daftar Sekarang
                </button>
            </form>
            
            <div class="register-section">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="register-link">Masuk di sini</a>
            </div>
            
            <div class="form-footer">
                <i class="bi bi-shield-fill-check"></i>
                <strong>Sistem Terenkripsi SSL</strong> - Data Anda Aman & Terlindungi
            </div>
        </div>
    </div>
</div>

</body>
</html>


<script>
function togglePassword(inputId, icon) {
    const input = document.getElementById(inputId);
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}
</script>
