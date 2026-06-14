<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tagepe UMKM - Digital Platform MSME Management</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary: #6366f1;
            --secondary: #a855f7;
            --accent: #06b6d4;
            --dark-bg: #0f172a;
            --card-bg: #1e293b;
            --text-primary: #f1f5f9;
            --text-secondary: #cbd5e1;
        }
        html { scroll-behavior: smooth; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: var(--dark-bg);
            color: var(--text-primary);
            line-height: 1.6;
        }
        
        .navbar {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.8), rgba(30, 41, 59, 0.8));
            backdrop-filter: blur(10px);
            padding: 20px 0;
            border-bottom: 1px solid rgba(99, 102, 241, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        @media (max-width: 768px) {
            .navbar { padding: 16px 0; }
        }
        @media (max-width: 640px) {
            .navbar { padding: 12px 0; }
        }
        .navbar-inner {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 40px;
        }
        .navbar-brand {
            font-size: 26px;
            font-weight: 900;
            background: linear-gradient(135deg, #6366f1, #a855f7, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .nav-menu { display: flex; gap: 30px; align-items: center; flex: 0; margin-left: 0; }
        .nav-link {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.3s;
            cursor: pointer;
            position: relative;
        }
        .nav-link:hover { color: #6366f1; }
        .nav-link.active { color: #6366f1; }
        .dropdown-menu {
            position: relative;
            display: inline-block;
        }
        .dropdown-toggle { display: flex; align-items: center; gap: 6px; }
        .dropdown-toggle::after {
            content: '▼';
            font-size: 10px;
            transition: transform 0.3s;
        }
        .dropdown-menu:hover .dropdown-toggle::after { transform: rotate(180deg); }
        .dropdown-content {
            position: absolute;
            top: 100%;
            left: 0;
            background: rgba(30, 41, 59, 0.95);
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 8px;
            padding: 12px 0;
            min-width: 200px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s;
            margin-top: 8px;
            backdrop-filter: blur(10px);
            z-index: 1001;
        }
        .dropdown-menu:hover .dropdown-content {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .dropdown-content a {
            display: block;
            padding: 12px 20px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        .dropdown-content a:hover {
            color: #6366f1;
            background: rgba(99, 102, 241, 0.1);
            border-left-color: #6366f1;
        }
        .nav-buttons { display: flex; gap: 16px; margin-left: auto; }
        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-outline {
            border: 2px solid #6366f1;
            color: #6366f1;
            background: transparent;
        }
        .btn-outline:hover { background: rgba(99, 102, 241, 0.1); transform: translateY(-2px); }
        .btn-primary {
            background: linear-gradient(135deg, #6366f1, #a855f7);
            color: white;
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 12px 24px rgba(99, 102, 241, 0.4); }
        .container { max-width: 1400px; margin: 0 auto; padding: 0 40px; }
        section { padding: 100px 0; position: relative; }
        
        .hero {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05), rgba(168, 85, 247, 0.05));
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 1000px;
            height: 1000px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.1), transparent);
            border-radius: 50%;
            animation: float 20s ease-in-out infinite;
        }
        .hero::after {
            content: '';
            position: absolute;
            bottom: -50%;
            left: -50%;
            width: 1000px;
            height: 1000px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.1), transparent);
            border-radius: 50%;
            animation: float 25s ease-in-out infinite reverse;
        }
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(30px); } }
        .hero-content {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }
        @media (max-width: 1024px) {
            .hero-content { gap: 40px; }
        }
        @media (max-width: 768px) {
            .hero-content { grid-template-columns: 1fr; gap: 30px; }
        }
        .hero h1 {
            font-size: 54px;
            font-weight: 900;
            line-height: 1.2;
            margin-bottom: 24px;
            background: linear-gradient(135deg, #f1f5f9, #cbd5e1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero p {
            font-size: 18px;
            color: var(--text-secondary);
            margin-bottom: 40px;
            line-height: 1.8;
        }
        .hero-buttons { display: flex; gap: 16px; flex-wrap: wrap; }
        .hero-buttons .btn { padding: 14px 32px; font-size: 16px; }
        
        .dashboard-preview {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.15), rgba(168, 85, 247, 0.15));
            border: 2px solid rgba(6, 182, 212, 0.5);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 0 40px rgba(99, 102, 241, 0.3), inset 0 0 40px rgba(99, 102, 241, 0.05);
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }
        .dashboard-preview::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(6, 182, 212, 0.3), transparent);
            border-radius: 50%;
            animation: float 15s ease-in-out infinite;
        }
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(99, 102, 241, 0.2);
            position: relative;
            z-index: 1;
        }
        .dashboard-logo { display: flex; align-items: center; gap: 10px; font-weight: 700; }
        .logo-icon { width: 24px; height: 24px; background: linear-gradient(135deg, #6366f1, #a855f7); border-radius: 6px; }
        .dashboard-actions { display: flex; gap: 10px; }
        .action-icon { width: 24px; height: 24px; background: rgba(99, 102, 241, 0.2); border-radius: 6px; }
        .dashboard-menu {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }
        .menu-item {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(99, 102, 241, 0.05));
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 8px;
            padding: 12px;
            min-height: 120px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .menu-item.active { border-color: #06b6d4; background: linear-gradient(135deg, rgba(6, 182, 212, 0.15), rgba(6, 182, 212, 0.05)); }
        .menu-item-title { font-size: 12px; font-weight: 600; margin-bottom: 12px; }
        .chart-placeholder {
            flex: 1;
            background: linear-gradient(90deg, transparent, rgba(6, 182, 212, 0.2), transparent);
            border-radius: 4px;
            position: relative;
        }
        .chart-bar {
            position: absolute;
            bottom: 0;
            background: linear-gradient(180deg, rgba(99, 102, 241, 0.4), rgba(99, 102, 241, 0.2));
            border-radius: 2px;
        }
        .pie-chart {
            width: 80px;
            height: 80px;
            background: conic-gradient(#6366f1 0deg 90deg, #a855f7 90deg 180deg, #06b6d4 180deg 240deg, #ec4899 240deg 360deg);
            border-radius: 50%;
            margin: 0 auto;
        }
        .stats-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
        .stat-box {
            background: rgba(99, 102, 241, 0.05);
            border: 1px solid rgba(99, 102, 241, 0.1);
            border-radius: 8px;
            padding: 12px;
        }
        .stat-label { font-size: 11px; color: var(--text-secondary); margin-bottom: 4px; }
        .stat-value { font-size: 16px; font-weight: 700; }
        
        .features {
            position: relative;
        }
        .section-title {
            text-align: center;
            font-size: 42px;
            font-weight: 900;
            margin-bottom: 60px;
            background: linear-gradient(135deg, #f1f5f9, #cbd5e1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .features-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
        .feature-card {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05), rgba(168, 85, 247, 0.05));
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 12px;
            padding: 32px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, #6366f1, #a855f7, #06b6d4, transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .feature-card:hover {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(168, 85, 247, 0.1));
            border-color: rgba(99, 102, 241, 0.4);
            transform: translateY(-8px);
        }
        .feature-card:hover::before { opacity: 1; }
        .feature-icon { font-size: 40px; margin-bottom: 16px; }
        .feature-card h3 { font-size: 20px; font-weight: 700; margin-bottom: 12px; }
        .feature-card p { font-size: 14px; color: var(--text-secondary); line-height: 1.6; }
        
        .cta {
            background: linear-gradient(135deg, #6366f1, #a855f7, #06b6d4);
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            padding: 80px 40px;
            text-align: center;
            margin: 100px 0;
        }
        .cta::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 1000px;
            height: 1000px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1), transparent);
            border-radius: 50%;
            animation: float 20s ease-in-out infinite;
        }
        .cta-content { position: relative; z-index: 1; }
        .cta h2 { font-size: 42px; font-weight: 900; margin-bottom: 20px; color: white; }
        .cta p { font-size: 18px; margin-bottom: 40px; color: rgba(255, 255, 255, 0.9); }
        .cta .btn { background: white; color: #6366f1; padding: 14px 40px; font-size: 16px; }
        .cta .btn:hover { background: rgba(255, 255, 255, 0.9); transform: translateY(-2px); }
        
        footer {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.5), rgba(30, 41, 59, 0.5));
            border-top: 1px solid rgba(99, 102, 241, 0.1);
            padding: 60px 0 20px;
        }
        .footer-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 40px; margin-bottom: 40px; }
        .footer-col h4 { font-size: 16px; font-weight: 700; margin-bottom: 20px; color: var(--text-primary); }
        .footer-col p { font-size: 14px; color: var(--text-secondary); line-height: 1.8; margin: 0; }
        .footer-col ul { list-style: none; }
        .footer-col ul li { margin-bottom: 12px; }
        .footer-col ul li a { font-size: 14px; color: var(--text-secondary); text-decoration: none; transition: color 0.3s; }
        .footer-col ul li a:hover { color: #6366f1; }
        .responsive-grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; }
        .responsive-grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
        .responsive-grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }
        .responsive-grid-1 { display: grid; grid-template-columns: 1fr; gap: 16px; }
        
        .blog-card {
            background-size: cover;
            background-position: center;
            border-radius: 12px;
            overflow: hidden;
            min-height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            color: white;
            padding: 24px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            position: relative;
        }
        .blog-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 32px rgba(99, 102, 241, 0.3);
        }
        
        @media (max-width: 1024px) {
            .responsive-grid-4 { grid-template-columns: repeat(2, 1fr); gap: 20px; }
            .responsive-grid-3 { grid-template-columns: repeat(2, 1fr); gap: 20px; }
        }
        @media (max-width: 768px) {
            .responsive-grid-4 { grid-template-columns: 1fr; gap: 16px; }
            .responsive-grid-3 { grid-template-columns: 1fr; gap: 16px; }
            .responsive-grid-2 { grid-template-columns: 1fr; gap: 16px; }
            .blog-card { min-height: 250px; padding: 20px; }
            .blog-card h3 { font-size: 16px; }
            .blog-card p { font-size: 12px; }
        }
        @media (max-width: 640px) {
            .responsive-grid-4 { gap: 12px; }
            .responsive-grid-3 { gap: 12px; }
            .responsive-grid-2 { gap: 12px; }
            .responsive-grid-1 { gap: 12px; }
            .blog-card { min-height: 200px; padding: 16px; }
            .blog-card h3 { font-size: 14px; margin-bottom: 8px; }
            .blog-card p { font-size: 11px; margin-bottom: 8px; }
        }
        
        @media (max-width: 768px) {
            .container { padding: 0 20px; }
            section { padding: 60px 0; }
            .hero-content { grid-template-columns: 1fr; gap: 40px; }
            .hero h1 { font-size: 36px; }
            .dashboard-menu { grid-template-columns: 1fr; }
            .features-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
            .navbar-inner { padding: 0 20px; flex-direction: column; gap: 20px; justify-content: center; }
            .nav-menu { margin-left: 0; flex-direction: column; gap: 12px; width: 100%; }
            .nav-buttons { margin-left: 0; width: 100%; justify-content: center; }
            .dropdown-content { position: static; opacity: 1; visibility: visible; transform: none; background: rgba(99, 102, 241, 0.05); margin-top: 8px; }
        }
        
        @media (max-width: 1024px) {
            .container { padding: 0 30px; }
            section { padding: 80px 0; }
            .navbar-inner { padding: 0 30px; gap: 30px; }
            .nav-menu { gap: 20px; }
            .hero h1 { font-size: 48px; }
            .hero p { font-size: 16px; }
            .dashboard-menu { grid-template-columns: 1fr 1fr; }
            .features-grid { grid-template-columns: repeat(2, 1fr); gap: 20px; }
            .section-title { font-size: 36px; margin-bottom: 40px; }
            .footer-grid { grid-template-columns: repeat(2, 1fr); gap: 30px; }
            .cta { padding: 60px 30px; }
            .cta h2 { font-size: 36px; }
        }
        
        @media (max-width: 640px) {
            .container { padding: 0 16px; }
            section { padding: 40px 0; }
            .navbar-inner { padding: 0 16px; gap: 16px; }
            .navbar-brand { font-size: 22px; }
            .nav-link { font-size: 13px; }
            .btn { padding: 10px 16px; font-size: 12px; }
            .hero { padding-top: 20px; }
            .hero h1 { font-size: 28px; margin-bottom: 16px; }
            .hero p { font-size: 14px; margin-bottom: 24px; }
            .hero-buttons { gap: 12px; }
            .dashboard-preview { padding: 16px; border-radius: 12px; }
            .dashboard-header { margin-bottom: 16px; padding-bottom: 12px; }
            .dashboard-menu { gap: 12px; margin-bottom: 16px; }
            .menu-item { padding: 10px; min-height: 100px; }
            .menu-item-title { font-size: 11px; margin-bottom: 8px; }
            .chart-bar { width: 20px !important; }
            .pie-chart { width: 60px; height: 60px; }
            .stat-label { font-size: 10px; }
            .stat-value { font-size: 14px; }
            .stats-grid { gap: 8px; }
            .stat-box { padding: 8px; }
            .section-title { font-size: 28px; margin-bottom: 30px; }
            .feature-card { padding: 20px; }
            .feature-icon { font-size: 32px; margin-bottom: 12px; }
            .feature-card h3 { font-size: 16px; margin-bottom: 8px; }
            .feature-card p { font-size: 13px; }
            .dropdown-content { min-width: 160px; padding: 8px 0; }
            .dropdown-content a { padding: 10px 16px; font-size: 13px; }
            .cta { padding: 40px 20px; margin: 60px 0; border-radius: 8px; }
            .cta h2 { font-size: 24px; margin-bottom: 16px; }
            .cta p { font-size: 14px; margin-bottom: 24px; }
            .cta .btn { padding: 12px 24px; font-size: 14px; }
            .footer-col h4 { font-size: 14px; margin-bottom: 16px; }
            .footer-col p { font-size: 12px; }
            .footer-col ul li a { font-size: 12px; }
            .footer-bottom { font-size: 11px; }
        }
        
        @media (max-width: 480px) {
            .container { padding: 0 12px; }
            section { padding: 30px 0; }
            .navbar-inner { padding: 0 12px; gap: 12px; }
            .navbar-brand { font-size: 20px; }
            .nav-menu { gap: 8px; }
            .nav-link { font-size: 12px; }
            .nav-buttons { gap: 8px; }
            .btn { padding: 8px 12px; font-size: 11px; }
            .hero h1 { font-size: 24px; }
            .hero p { font-size: 13px; }
            .hero-buttons { flex-direction: column; gap: 10px; }
            .hero-buttons .btn { width: 100%; padding: 12px; }
            .dashboard-menu { grid-template-columns: 1fr; }
            .menu-item { min-height: 80px; }
            .chart-placeholder { min-height: 60px; }
            .pie-chart { width: 50px; height: 50px; }
            .section-title { font-size: 22px; margin-bottom: 20px; }
            .features-grid { grid-template-columns: 1fr; gap: 16px; }
            .feature-card { padding: 16px; }
            .feature-icon { font-size: 28px; }
            .cta h2 { font-size: 20px; }
            .cta p { font-size: 13px; }
            .dropdown-content { min-width: 140px; }
            .footer-grid { grid-template-columns: 1fr; gap: 20px; }
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="navbar-inner">
        <div class="navbar-brand">Tagepe UMKM</div>
        <div class="nav-menu">
            <a href="#fitur" class="nav-link">Fitur</a>
            <a href="#harga" class="nav-link">Harga</a>
            <div class="dropdown-menu">
                <span class="nav-link dropdown-toggle">Tentang</span>
                <div class="dropdown-content">
                    <a href="#tentang">Tentang Kami</a>
                    <a href="#blog">Blog & Resources</a>
                    <a href="#kontak">Hubungi Kami</a>
                </div>
            </div>
            <a href="#faq" class="nav-link">FAQ</a>
        </div>
        <div class="nav-buttons">
            <a href="/login" class="btn btn-outline">Login</a>
            <a href="/register" class="btn btn-primary">Daftar Gratis</a>
        </div>
    </div>
</nav>

<section class="hero">
    <div class="container">
        <div class="hero-content">
            <div>
                <h1>Platform Digital UMKM Modern</h1>
                <p>Mengelola toko dengan cerdas, efisien, dan profesional. Bangun bisnis UMKM Anda dengan teknologi terkini yang dirancang khusus untuk memenuhi kebutuhan bisnis Indonesia.</p>
                <div class="hero-buttons">
                    <a href="/register" class="btn btn-primary">Mulai Sekarang</a>
                    <a href="#" class="btn btn-outline">Pelajari Lebih</a>
                </div>
            </div>
            <div class="dashboard-preview">
                <div class="dashboard-header">
                    <div class="dashboard-logo">
                        <div class="logo-icon"></div>
                        <div>
                            <div style="font-size: 14px;">SaaS Dashboard</div>
                            <div style="font-size: 12px; color: var(--text-secondary);">MSME Management App</div>
                        </div>
                    </div>
                    <div class="dashboard-actions">
                        <div class="action-icon"></div>
                        <div class="action-icon"></div>
                        <div class="action-icon"></div>
                    </div>
                </div>
                
                <div class="dashboard-menu">
                    <div class="menu-item active">
                        <div class="menu-item-title">Sales Chart</div>
                        <div class="chart-placeholder">
                            <div class="chart-bar" style="width: 30%; height: 40%; left: 10%;"></div>
                            <div class="chart-bar" style="width: 35%; height: 50%; left: 45%;"></div>
                            <div class="chart-bar" style="width: 40%; height: 60%; right: 10%;"></div>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-title">Prevene Charts</div>
                        <div style="flex: 1; display: flex; align-items: center; justify-content: center;">
                            <div class="pie-chart"></div>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-title">Business Statistics</div>
                        <div class="stats-grid">
                            <div class="stat-box">
                                <div class="stat-label">Revenue</div>
                                <div class="stat-value" style="color: #06b6d4;">$1,690.72</div>
                            </div>
                            <div class="stat-box">
                                <div class="stat-label">Active Users</div>
                                <div class="stat-value" style="color: #6366f1;">133</div>
                            </div>
                            <div class="stat-box">
                                <div class="stat-label">AI Insights</div>
                                <div class="stat-value" style="color: #a855f7;">12</div>
                            </div>
                            <div class="stat-box">
                                <div class="stat-label">Growth</div>
                                <div class="stat-value" style="color: #06b6d4;">+47.3%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section style="padding: 100px 0;">
    <div class="container">
        <h2 class="section-title">Cara Kerja Platform</h2>
        
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px;">
            <div style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(99, 102, 241, 0.05)); border: 1px solid rgba(99, 102, 241, 0.2); border-radius: 12px; padding: 32px; text-align: center; position: relative;">
                <div style="position: absolute; top: -20px; left: 50%; transform: translateX(-50%); width: 40px; height: 40px; background: linear-gradient(135deg, #6366f1, #a855f7); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; font-weight: 700;">1</div>
                <h4 style="font-size: 18px; font-weight: 700; margin: 20px 0 12px;">Daftar Akun</h4>
                <p style="font-size: 14px; color: var(--text-secondary); line-height: 1.6;">Buat akun gratis dan lengkapi profil bisnis Anda dalam beberapa menit tanpa perlu kartu kredit.</p>
            </div>
            
            <div style="background: linear-gradient(135deg, rgba(168, 85, 247, 0.1), rgba(168, 85, 247, 0.05)); border: 1px solid rgba(168, 85, 247, 0.2); border-radius: 12px; padding: 32px; text-align: center; position: relative;">
                <div style="position: absolute; top: -20px; left: 50%; transform: translateX(-50%); width: 40px; height: 40px; background: linear-gradient(135deg, #a855f7, #06b6d4); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; font-weight: 700;">2</div>
                <h4 style="font-size: 18px; font-weight: 700; margin: 20px 0 12px;">Setup Produk</h4>
                <p style="font-size: 14px; color: var(--text-secondary); line-height: 1.6;">Tambahkan produk/layanan Anda dengan foto, harga, dan deskripsi yang menarik untuk pelanggan.</p>
            </div>
            
            <div style="background: linear-gradient(135deg, rgba(6, 182, 212, 0.1), rgba(6, 182, 212, 0.05)); border: 1px solid rgba(6, 182, 212, 0.2); border-radius: 12px; padding: 32px; text-align: center; position: relative;">
                <div style="position: absolute; top: -20px; left: 50%; transform: translateX(-50%); width: 40px; height: 40px; background: linear-gradient(135deg, #06b6d4, #0891b2); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; font-weight: 700;">3</div>
                <h4 style="font-size: 18px; font-weight: 700; margin: 20px 0 12px;">Terima Pesanan</h4>
                <p style="font-size: 14px; color: var(--text-secondary); line-height: 1.6;">Pelanggan membeli melalui dashboard Anda dan pembayaran otomatis masuk ke rekening Anda.</p>
            </div>
            
            <div style="background: linear-gradient(135deg, rgba(236, 72, 153, 0.1), rgba(236, 72, 153, 0.05)); border: 1px solid rgba(236, 72, 153, 0.2); border-radius: 12px; padding: 32px; text-align: center; position: relative;">
                <div style="position: absolute; top: -20px; left: 50%; transform: translateX(-50%); width: 40px; height: 40px; background: linear-gradient(135deg, #ec4899, #db2777); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; font-weight: 700;">4</div>
                <h4 style="font-size: 18px; font-weight: 700; margin: 20px 0 12px;">Kembangkan Bisnis</h4>
                <p style="font-size: 14px; color: var(--text-secondary); line-height: 1.6;">Gunakan insights dan analytics untuk meningkatkan penjualan dan scale bisnis Anda dengan cepat.</p>
            </div>
        </div>
    </div>
</section>

<section style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.08), rgba(168, 85, 247, 0.08)); padding: 100px 0;">
    <div class="container">
        <h2 class="section-title">Apa Kala Memberikan</h2>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px;">
            <div style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.15), rgba(168, 85, 247, 0.15)); border: 1px solid rgba(99, 102, 241, 0.2); border-radius: 12px; padding: 32px; text-align: center;">
                <div style="display: flex; justify-content: center; gap: 8px; margin-bottom: 16px;">
                    <span style="font-size: 20px;">⭐</span>
                    <span style="font-size: 20px;">⭐</span>
                    <span style="font-size: 20px;">⭐</span>
                    <span style="font-size: 20px;">⭐</span>
                    <span style="font-size: 20px;">⭐</span>
                </div>
                <p style="font-size: 14px; color: var(--text-primary); margin-bottom: 16px; line-height: 1.8;">
                    "Tagepe UMKM telah mengubah cara saya mengelola bisnis. Penjualan meningkat 150% dalam 3 bulan pertama. Tim support mereka sangat responsif dan membantu!"
                </p>
                <div style="font-weight: 700; color: var(--text-primary); font-size: 14px;">Budi Santoso</div>
                <div style="font-size: 12px; color: var(--text-secondary);">Pemilik Toko Fashion, Jakarta</div>
            </div>

            <div style="background: linear-gradient(135deg, rgba(168, 85, 247, 0.15), rgba(168, 85, 247, 0.15)); border: 1px solid rgba(168, 85, 247, 0.2); border-radius: 12px; padding: 32px; text-align: center;">
                <div style="display: flex; justify-content: center; gap: 8px; margin-bottom: 16px;">
                    <span style="font-size: 20px;">⭐</span>
                    <span style="font-size: 20px;">⭐</span>
                    <span style="font-size: 20px;">⭐</span>
                    <span style="font-size: 20px;">⭐</span>
                    <span style="font-size: 20px;">⭐</span>
                </div>
                <p style="font-size: 14px; color: var(--text-primary); margin-bottom: 16px; line-height: 1.8;">
                    "Sistem pembayaran otomatis membuat kami hemat waktu hingga 10 jam per minggu. Fitur reporting juga sangat membantu dalam membuat keputusan bisnis."
                </p>
                <div style="font-weight: 700; color: var(--text-primary); font-size: 14px;">Siti Nurhaliza</div>
                <div style="font-size: 12px; color: var(--text-secondary);">Owner Toko Kosmetik, Surabaya</div>
            </div>

            <div style="background: linear-gradient(135deg, rgba(6, 182, 212, 0.15), rgba(6, 182, 212, 0.15)); border: 1px solid rgba(6, 182, 212, 0.2); border-radius: 12px; padding: 32px; text-align: center;">
                <div style="display: flex; justify-content: center; gap: 8px; margin-bottom: 16px;">
                    <span style="font-size: 20px;">⭐</span>
                    <span style="font-size: 20px;">⭐</span>
                    <span style="font-size: 20px;">⭐</span>
                    <span style="font-size: 20px;">⭐</span>
                    <span style="font-size: 20px;">⭐</span>
                </div>
                <p style="font-size: 14px; color: var(--text-primary); margin-bottom: 16px; line-height: 1.8;">
                    "Dashboard yang intuitif membuat staff saya langsung paham tanpa perlu training lama. Efisiensi operasional meningkat drastis dalam sebulan pertama."
                </p>
                <div style="font-weight: 700; color: var(--text-primary); font-size: 14px;">Riyan Wijaya</div>
                <div style="font-size: 12px; color: var(--text-secondary);">CEO Toko Elektronik, Bandung</div>
            </div>

            <div style="background: linear-gradient(135deg, rgba(236, 72, 153, 0.15), rgba(236, 72, 153, 0.15)); border: 1px solid rgba(236, 72, 153, 0.2); border-radius: 12px; padding: 32px; text-align: center;">
                <div style="display: flex; justify-content: center; gap: 8px; margin-bottom: 16px;">
                    <span style="font-size: 20px;">⭐</span>
                    <span style="font-size: 20px;">⭐</span>
                    <span style="font-size: 20px;">⭐</span>
                    <span style="font-size: 20px;">⭐</span>
                    <span style="font-size: 20px;">⭐</span>
                </div>
                <p style="font-size: 14px; color: var(--text-primary); margin-bottom: 16px; line-height: 1.8;">
                    "Fitur multi-cabang sangat memudahkan saya mengelola 5 toko sekaligus. Data real-time membantu pengambilan keputusan yang lebih cepat dan akurat."
                </p>
                <div style="font-weight: 700; color: var(--text-primary); font-size: 14px;">Dewi Lestari</div>
                <div style="font-size: 12px; color: var(--text-secondary);">Franchise Owner, Medan</div>
            </div>

            <div style="background: linear-gradient(135deg, rgba(34, 197, 94, 0.15), rgba(34, 197, 94, 0.15)); border: 1px solid rgba(34, 197, 94, 0.2); border-radius: 12px; padding: 32px; text-align: center;">
                <div style="display: flex; justify-content: center; gap: 8px; margin-bottom: 16px;">
                    <span style="font-size: 20px;">⭐</span>
                    <span style="font-size: 20px;">⭐</span>
                    <span style="font-size: 20px;">⭐</span>
                    <span style="font-size: 20px;">⭐</span>
                    <span style="font-size: 20px;">⭐</span>
                </div>
                <p style="font-size: 14px; color: var(--text-primary); margin-bottom: 16px; line-height: 1.8;">
                    "Investasi terbaik untuk bisnis saya! ROI tercapai dalam 2 bulan dan sekarang fokus berkembang. Support team yang responsif membuat saya merasa aman."
                </p>
                <div style="font-weight: 700; color: var(--text-primary); font-size: 14px;">Ahmad Rahman</div>
                <div style="font-size: 12px; color: var(--text-secondary);">Pemilik Toko Furniture, Yogyakarta</div>
            </div>
        </div>
    </div>
</section>

<section class="features" id="fitur">
    <div class="container">
        <h2 class="section-title">Fitur Unggulan Platform</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h3>Dashboard Modern</h3>
                <p>Visualisasi data bisnis Anda dengan dashboard yang intuitif dan responsif untuk semua perangkat modern.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">💳</div>
                <h3>Sistem Pembayaran</h3>
                <p>Terima pembayaran dari berbagai metode dengan keamanan tingkat enterprise dan settlement real-time.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📈</div>
                <h3>Analytics & Insights</h3>
                <p>Dapatkan insight mendalam tentang performa bisnis dengan laporan komprehensif dan analisis prediktif.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🛒</div>
                <h3>E-Commerce Ready</h3>
                <p>Kelola toko online dan offline dari satu platform yang terintegrasi sempurna dan mudah digunakan.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">👥</div>
                <h3>Manajemen Tim</h3>
                <p>Kelola tim dengan sistem role-based access control dan activity logging yang transparan dan aman.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🔒</div>
                <h3>Keamanan Enterprise</h3>
                <p>Perlindungan data dengan enkripsi end-to-end dan compliance dengan standar internasional terbaru.</p>
            </div>
        </div>
    </div>
</section>

<section style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.08), rgba(168, 85, 247, 0.08)); padding: 100px 0;">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
            <div>
                <h2 style="font-size: 42px; font-weight: 900; margin-bottom: 20px; background: linear-gradient(135deg, #f1f5f9, #cbd5e1); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Dashboard Premium</h2>
                <p style="font-size: 16px; color: var(--text-secondary); margin-bottom: 24px; line-height: 1.8;">Visualisasi data yang intuitif untuk kepemimpinan bisnis Anda dengan laporan yang lebih detail dan komprehensif.</p>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 32px;">
                    <div style="background: linear-gradient(135deg, rgba(6, 182, 212, 0.15), rgba(6, 182, 212, 0.05)); border: 1px solid rgba(6, 182, 212, 0.2); border-radius: 12px; padding: 20px;">
                        <div style="font-size: 24px; margin-bottom: 8px;">Rp 45.280.000</div>
                        <div style="font-size: 12px; color: var(--text-secondary);">Total Pendapatan</div>
                        <div style="margin-top: 8px; font-size: 12px; color: #10b981;">↑ 41.1%</div>
                    </div>
                    <div style="background: linear-gradient(135deg, rgba(168, 85, 247, 0.15), rgba(168, 85, 247, 0.05)); border: 1px solid rgba(168, 85, 247, 0.2); border-radius: 12px; padding: 20px;">
                        <div style="font-size: 18px; margin-bottom: 8px;">Produk Terdaftar</div>
                        <div style="font-size: 28px; font-weight: 700;">324 Item</div>
                        <div style="margin-top: 8px; font-size: 12px; color: var(--text-secondary);">Stok aktif</div>
                    </div>
                    <div style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.15), rgba(99, 102, 241, 0.05)); border: 1px solid rgba(99, 102, 241, 0.2); border-radius: 12px; padding: 20px;">
                        <div style="font-size: 18px; margin-bottom: 8px;">Pelanggan Terdaftar</div>
                        <div style="font-size: 28px; font-weight: 700;">98 Orang</div>
                        <div style="margin-top: 8px; font-size: 12px; color: var(--text-secondary);">Aktif bulan ini</div>
                    </div>
                    <div style="background: linear-gradient(135deg, rgba(236, 72, 153, 0.15), rgba(236, 72, 153, 0.05)); border: 1px solid rgba(236, 72, 153, 0.2); border-radius: 12px; padding: 20px;">
                        <div style="font-size: 18px; margin-bottom: 8px;">Performa Toko</div>
                        <div style="font-size: 28px; font-weight: 700;">Sangat Baik</div>
                        <div style="margin-top: 8px; font-size: 12px; color: var(--text-secondary);">Rating: 4.8/5</div>
                    </div>
                </div>
                
                <a href="/register" class="btn btn-primary" style="display: inline-block;">Coba Dashboard Premium</a>
            </div>
            
            <div style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.15), rgba(168, 85, 247, 0.15)); border: 2px solid rgba(6, 182, 212, 0.5); border-radius: 16px; padding: 32px; box-shadow: 0 0 40px rgba(99, 102, 241, 0.3), inset 0 0 40px rgba(99, 102, 241, 0.05); backdrop-filter: blur(10px); position: relative; overflow: hidden;">
                <div style="position: absolute; top: -50%; right: -50%; width: 300px; height: 300px; background: radial-gradient(circle, rgba(6, 182, 212, 0.3), transparent); border-radius: 50%; animation: float 15s ease-in-out infinite;"></div>
                
                <div style="position: relative; z-index: 1;">
                    <div style="text-align: center; margin-bottom: 24px;">
                        <div style="font-size: 32px; margin-bottom: 8px;">📊</div>
                        <h3 style="font-size: 20px; font-weight: 700; margin-bottom: 8px;">Grafik Pendapatan</h3>
                        <p style="font-size: 13px; color: var(--text-secondary);">Tren penjualan 6 bulan terakhir</p>
                    </div>
                    
                    <div style="display: flex; align-items: flex-end; justify-content: space-around; height: 200px; gap: 8px; margin-bottom: 16px;">
                        <div style="width: 30px; height: 60px; background: linear-gradient(180deg, #6366f1, #4f46e5); border-radius: 4px;"></div>
                        <div style="width: 30px; height: 80px; background: linear-gradient(180deg, #a855f7, #9333ea); border-radius: 4px;"></div>
                        <div style="width: 30px; height: 100px; background: linear-gradient(180deg, #06b6d4, #0891b2); border-radius: 4px;"></div>
                        <div style="width: 30px; height: 120px; background: linear-gradient(180deg, #6366f1, #4f46e5); border-radius: 4px;"></div>
                        <div style="width: 30px; height: 140px; background: linear-gradient(180deg, #a855f7, #9333ea); border-radius: 4px;"></div>
                        <div style="width: 30px; height: 160px; background: linear-gradient(180deg, #06b6d4, #0891b2); border-radius: 4px;"></div>
                    </div>
                    
                    <div style="text-align: center; font-size: 12px; color: var(--text-secondary);">
                        <div>Jan</div>
                        <div style="margin-top: 4px;">Pertumbuhan Konsisten</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section style="padding: 100px 0;">
    <div class="container">
        <h2 class="section-title">Manfaat Untuk Bisnis Anda</h2>
        
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
            <div style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.08), rgba(99, 102, 241, 0.02)); border: 1px solid rgba(99, 102, 241, 0.2); border-radius: 12px; padding: 32px;">
                <div style="font-size: 48px; margin-bottom: 16px;">⚡</div>
                <h3 style="font-size: 20px; font-weight: 700; margin-bottom: 12px;">Efisiensi Operasional</h3>
                <p style="font-size: 14px; color: var(--text-secondary); line-height: 1.6;">Otomasi proses bisnis mengurangi beban kerja manual hingga 70% dan meningkatkan produktivitas tim.</p>
            </div>
            
            <div style="background: linear-gradient(135deg, rgba(168, 85, 247, 0.08), rgba(168, 85, 247, 0.02)); border: 1px solid rgba(168, 85, 247, 0.2); border-radius: 12px; padding: 32px;">
                <div style="font-size: 48px; margin-bottom: 16px;">💰</div>
                <h3 style="font-size: 20px; font-weight: 700; margin-bottom: 12px;">Peningkatan Penjualan</h3>
                <p style="font-size: 14px; color: var(--text-secondary); line-height: 1.6;">Dengan insight real-time, tingkatkan revenue hingga 200% dalam 6 bulan dengan strategi pricing yang tepat.</p>
            </div>
            
            <div style="background: linear-gradient(135deg, rgba(6, 182, 212, 0.08), rgba(6, 182, 212, 0.02)); border: 1px solid rgba(6, 182, 212, 0.2); border-radius: 12px; padding: 32px;">
                <div style="font-size: 48px; margin-bottom: 16px;">�</div>
                <h3 style="font-size: 20px; font-weight: 700; margin-bottom: 12px;">Akses Dimana Saja</h3>
                <p style="font-size: 14px; color: var(--text-secondary); line-height: 1.6;">Kelola bisnis dari mana saja dengan aplikasi mobile yang user-friendly dan response time cepat.</p>
            </div>
        </div>
    </div>
</section>

<section class="cta">
    <div class="cta-content">
        <h2>Mulai Transformasi Digital UMKM Anda Hari Ini</h2>
        <p>Bergabunglah dengan ribuan UMKM yang telah berkembang bersama Tagepe UMKM Digital Platform</p>
        <a href="/register" class="btn btn-primary">Daftar Sekarang - Gratis 30 Hari</a>
    </div>
</section>

<section style="padding: 100px 0;" id="harga">
    <div class="container">
        <h2 class="section-title">Pilihan harga paket</h2>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
            <!-- Paket Starter -->
            <div style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.08), rgba(99, 102, 241, 0.02)); border: 1px solid rgba(99, 102, 241, 0.2); border-radius: 12px; padding: 28px; display: flex; flex-direction: column;">
                <div style="font-size: 40px; margin-bottom: 12px;">🥉</div>
                <h3 style="font-size: 20px; font-weight: 700; margin-bottom: 4px;">Paket Starter</h3>
                <p style="font-size: 24px; font-weight: 900; color: #6366f1; margin-bottom: 2px;">Rp 99.000</p>
                <p style="font-size: 11px; color: var(--text-secondary); margin-bottom: 14px;">/ bulan</p>
                <p style="font-size: 12px; color: var(--text-secondary); margin-bottom: 18px; line-height: 1.5;">Cocok untuk UMKM yang baru memulai digitalisasi bisnis.</p>
                <div style="border-top: 1px solid rgba(99, 102, 241, 0.2); padding-top: 14px; flex-grow: 1; margin-bottom: 14px;">
                    <p style="font-size: 11px; font-weight: 700; margin-bottom: 10px; color: var(--text-primary);">Fitur:</p>
                    <ul style="list-style: none;">
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ Dashboard Penjualan</li>
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ Maksimal 100 Produk</li>
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ 1 Pengguna</li>
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ Pencatatan Transaksi</li>
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ Monitoring Stok Dasar</li>
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ Laporan Penjualan</li>
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ Backup Data Harian</li>
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ Dukungan Email</li>
                    </ul>
                </div>
                <a href="/register" class="btn btn-outline" style="width: 100%; text-align: center; padding: 10px;">Mulai Gratis</a>
            </div>

            <!-- Paket Growth -->
            <div style="background: linear-gradient(135deg, #6366f1, #a855f7); border-radius: 12px; padding: 28px; display: flex; flex-direction: column; position: relative; transform: scale(1.03);">
                <div style="position: absolute; top: -14px; left: 50%; transform: translateX(-50%); background: linear-gradient(135deg, #a855f7, #06b6d4); color: white; padding: 5px 12px; border-radius: 20px; font-size: 10px; font-weight: 700;">⭐ PALING POPULER</div>
                <div style="font-size: 40px; margin-bottom: 12px;">🥈</div>
                <h3 style="font-size: 20px; font-weight: 700; margin-bottom: 4px; color: white;">Paket Growth</h3>
                <p style="font-size: 24px; font-weight: 900; color: white; margin-bottom: 2px;">Rp 249.000</p>
                <p style="font-size: 11px; color: rgba(255,255,255,0.8); margin-bottom: 14px;">/ bulan</p>
                <p style="font-size: 12px; color: rgba(255,255,255,0.9); margin-bottom: 18px; line-height: 1.5;">Untuk UMKM yang sedang berkembang dan membutuhkan fitur lebih lengkap.</p>
                <div style="border-top: 1px solid rgba(255,255,255,0.2); padding-top: 14px; flex-grow: 1; margin-bottom: 14px;">
                    <p style="font-size: 11px; font-weight: 700; margin-bottom: 10px; color: white;">Fitur:</p>
                    <ul style="list-style: none; color: white;">
                        <li style="padding: 5px 0; font-size: 12px;">✓ Semua Fitur Starter</li>
                        <li style="padding: 5px 0; font-size: 12px;">✓ Produk Tanpa Batas</li>
                        <li style="padding: 5px 0; font-size: 12px;">✓ Hingga 5 Pengguna</li>
                        <li style="padding: 5px 0; font-size: 12px;">✓ Manajemen Pelanggan</li>
                        <li style="padding: 5px 0; font-size: 12px;">✓ Laporan Keuangan Lengkap</li>
                        <li style="padding: 5px 0; font-size: 12px;">✓ Analitik Penjualan</li>
                        <li style="padding: 5px 0; font-size: 12px;">✓ Notifikasi Stok Menipis</li>
                        <li style="padding: 5px 0; font-size: 12px;">✓ Export PDF & Excel</li>
                        <li style="padding: 5px 0; font-size: 12px;">✓ Priority Support</li>
                    </ul>
                </div>
                <a href="/register" class="btn btn-primary" style="width: 100%; text-align: center; background: white; color: #6366f1; border: none; padding: 10px;">Pilih Paket</a>
            </div>

            <!-- Paket Business -->
            <div style="background: linear-gradient(135deg, rgba(168, 85, 247, 0.08), rgba(168, 85, 247, 0.02)); border: 1px solid rgba(168, 85, 247, 0.2); border-radius: 12px; padding: 28px; display: flex; flex-direction: column;">
                <div style="font-size: 40px; margin-bottom: 12px;">🥇</div>
                <h3 style="font-size: 20px; font-weight: 700; margin-bottom: 4px;">Paket Business</h3>
                <p style="font-size: 24px; font-weight: 900; color: #a855f7; margin-bottom: 2px;">Rp 499.000</p>
                <p style="font-size: 11px; color: var(--text-secondary); margin-bottom: 14px;">/ bulan</p>
                <p style="font-size: 12px; color: var(--text-secondary); margin-bottom: 18px; line-height: 1.5;">Untuk bisnis yang memiliki banyak transaksi dan tim.</p>
                <div style="border-top: 1px solid rgba(168, 85, 247, 0.2); padding-top: 14px; flex-grow: 1; margin-bottom: 14px;">
                    <p style="font-size: 11px; font-weight: 700; margin-bottom: 10px; color: var(--text-primary);">Fitur:</p>
                    <ul style="list-style: none;">
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ Semua Fitur Growth</li>
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ Hingga 20 Pengguna</li>
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ Multi Cabang</li>
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ Multi Gudang</li>
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ Approval Transaksi</li>
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ Manajemen Karyawan</li>
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ Dashboard Kustom</li>
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ Integrasi WhatsApp</li>
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ API Access</li>
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ Support Prioritas</li>
                    </ul>
                </div>
                <a href="/register" class="btn btn-primary" style="width: 100%; text-align: center; padding: 10px;">Mulai Sekarang</a>
            </div>

            <!-- Paket Enterprise -->
            <div style="background: linear-gradient(135deg, rgba(34, 197, 94, 0.08), rgba(34, 197, 94, 0.02)); border: 1px solid rgba(34, 197, 94, 0.2); border-radius: 12px; padding: 28px; display: flex; flex-direction: column;">
                <div style="font-size: 40px; margin-bottom: 12px;">🏢</div>
                <h3 style="font-size: 20px; font-weight: 700; margin-bottom: 4px;">Paket Enterprise</h3>
                <p style="font-size: 24px; font-weight: 900; color: #22c55e; margin-bottom: 2px;">Hubungi Kami</p>
                <p style="font-size: 11px; color: var(--text-secondary); margin-bottom: 14px;">Penawaran Khusus</p>
                <p style="font-size: 12px; color: var(--text-secondary); margin-bottom: 18px; line-height: 1.5;">Untuk perusahaan atau UMKM skala besar dengan kebutuhan khusus.</p>
                <div style="border-top: 1px solid rgba(34, 197, 94, 0.2); padding-top: 14px; flex-grow: 1; margin-bottom: 14px;">
                    <p style="font-size: 11px; font-weight: 700; margin-bottom: 10px; color: var(--text-primary);">Fitur:</p>
                    <ul style="list-style: none;">
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ Semua Fitur Business</li>
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ Pengguna Tanpa Batas</li>
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ Cabang Tanpa Batas</li>
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ Custom Integrasi</li>
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ Dedicated Account Manager</li>
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ Training Tim</li>
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ SLA 99.9%</li>
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ Server Dedicated</li>
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ Keamanan Enterprise</li>
                        <li style="padding: 5px 0; font-size: 12px; color: var(--text-secondary);">✓ Dukungan 24/7</li>
                    </ul>
                </div>
                <a href="#" class="btn btn-primary" style="width: 100%; text-align: center; background: #22c55e; color: white; border: none; padding: 10px;">Hubungi Sales</a>
            </div>
        </div>
    </div>
</section>

<section style="padding: 100px 0;">
    <div class="container">
        <h2 class="section-title">Blog & Tips Bisnis</h2>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px; margin-bottom: 40px;">
            <div style="background: linear-gradient(135deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1552664730-d307ca884978?w=500&h=300&fit=crop'); background-size: cover; background-position: center; border-radius: 12px; overflow: hidden; min-height: 300px; display: flex; flex-direction: column; justify-content: flex-end; color: white; padding: 24px; transition: transform 0.3s ease;">
                <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 12px;">Strategi Pricing yang Efektif untuk UMKM</h3>
                <p style="font-size: 13px; color: rgba(255,255,255,0.9); margin-bottom: 12px;">Pelajari cara menentukan harga produk yang kompetitif tanpa mengorbankan keuntungan bisnis Anda.</p>
                <div style="font-size: 12px; color: rgba(255,255,255,0.7);">5 min read • Marketing</div>
            </div>

            <div style="background: linear-gradient(135deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1460925895917-adf4e565db20?w=500&h=300&fit=crop'); background-size: cover; background-position: center; border-radius: 12px; overflow: hidden; min-height: 300px; display: flex; flex-direction: column; justify-content: flex-end; color: white; padding: 24px; transition: transform 0.3s ease;">
                <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 12px;">Maksimalkan E-Commerce untuk Penjualan Online</h3>
                <p style="font-size: 13px; color: rgba(255,255,255,0.9); margin-bottom: 12px;">Tips dan trik meningkatkan penjualan online Anda dengan strategi digital marketing yang terbukti efektif.</p>
                <div style="font-size: 12px; color: rgba(255,255,255,0.7);">7 min read • E-Commerce</div>
            </div>

            <div style="background: linear-gradient(135deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=500&h=300&fit=crop'); background-size: cover; background-position: center; border-radius: 12px; overflow: hidden; min-height: 300px; display: flex; flex-direction: column; justify-content: flex-end; color: white; padding: 24px; transition: transform 0.3s ease;">
                <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 12px;">Manajemen Inventory yang Optimal</h3>
                <p style="font-size: 13px; color: rgba(255,255,255,0.9); margin-bottom: 12px;">Hindari stock out dan overstock dengan sistem inventory management yang terukur dan efisien.</p>
                <div style="font-size: 12px; color: rgba(255,255,255,0.7);">6 min read • Operasional</div>
            </div>

            <div style="background: linear-gradient(135deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1460925895917-adf4e565db20?w=500&h=300&fit=crop'); background-size: cover; background-position: center; border-radius: 12px; overflow: hidden; min-height: 300px; display: flex; flex-direction: column; justify-content: flex-end; color: white; padding: 24px; transition: transform 0.3s ease;">
                <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 12px;">Customer Retention Strategy untuk UMKM</h3>
                <p style="font-size: 13px; color: rgba(255,255,255,0.9); margin-bottom: 12px;">Ciptakan program loyalitas yang membuat pelanggan Anda kembali lagi dan lagi.</p>
                <div style="font-size: 12px; color: rgba(255,255,255,0.7);">8 min read • Customer Service</div>
            </div>

            <div style="background: linear-gradient(135deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1552664730-d307ca884978?w=500&h=300&fit=crop'); background-size: cover; background-position: center; border-radius: 12px; overflow: hidden; min-height: 300px; display: flex; flex-direction: column; justify-content: flex-end; color: white; padding: 24px; transition: transform 0.3s ease;">
                <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 12px;">Transformasi Digital untuk UMKM Indonesia</h3>
                <p style="font-size: 13px; color: rgba(255,255,255,0.9); margin-bottom: 12px;">Panduan lengkap cara mengadopsi teknologi digital untuk mengakselerasi pertumbuhan bisnis Anda.</p>
                <div style="font-size: 12px; color: rgba(255,255,255,0.7);">10 min read • Digital</div>
            </div>

            <div style="background: linear-gradient(135deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=500&h=300&fit=crop'); background-size: cover; background-position: center; border-radius: 12px; overflow: hidden; min-height: 300px; display: flex; flex-direction: column; justify-content: flex-end; color: white; padding: 24px; transition: transform 0.3s ease;">
                <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 12px;">Data Analytics untuk Keputusan Bisnis</h3>
                <p style="font-size: 13px; color: rgba(255,255,255,0.9); margin-bottom: 12px;">Gunakan data untuk membuat keputusan bisnis yang lebih tepat dan meningkatkan ROI Anda.</p>
                <div style="font-size: 12px; color: rgba(255,255,255,0.7);">9 min read • Analytics</div>
            </div>

            <div style="background: linear-gradient(135deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1552664730-d307ca884978?w=500&h=300&fit=crop'); background-size: cover; background-position: center; border-radius: 12px; overflow: hidden; min-height: 300px; display: flex; flex-direction: column; justify-content: flex-end; color: white; padding: 24px; transition: transform 0.3s ease;">
                <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 12px;">Meningkatkan Branding dan Visibilitas Online</h3>
                <p style="font-size: 13px; color: rgba(255,255,255,0.9); margin-bottom: 12px;">Strategi membangun brand awareness di media sosial dan platform digital untuk menjangkau pelanggan lebih luas.</p>
                <div style="font-size: 12px; color: rgba(255,255,255,0.7);">8 min read • Branding</div>
            </div>

            <div style="background: linear-gradient(135deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1460925895917-adf4e565db20?w=500&h=300&fit=crop'); background-size: cover; background-position: center; border-radius: 12px; overflow: hidden; min-height: 300px; display: flex; flex-direction: column; justify-content: flex-end; color: white; padding: 24px; transition: transform 0.3s ease;">
                <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 12px;">Ekspansi Bisnis Multi-Channel Terpadu</h3>
                <p style="font-size: 13px; color: rgba(255,255,255,0.9); margin-bottom: 12px;">Pelajari cara mengembangkan bisnis Anda ke berbagai channel penjualan dengan sistem terintegrasi yang efisien.</p>
                <div style="font-size: 12px; color: rgba(255,255,255,0.7);">11 min read • Strategi</div>
            </div>
        </div>

        <div style="text-align: center;">
            <a href="#" class="btn btn-primary" style="padding: 14px 40px; font-size: 16px;">Lihat Selengkapnya</a>
        </div>
    </div>
</section>

<section style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.08), rgba(168, 85, 247, 0.08)); padding: 100px 0;" id="faq">
        
        <div style="max-width: 800px; margin: 0 auto;">
            <div style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(99, 102, 241, 0.05)); border: 1px solid rgba(99, 102, 241, 0.2); border-radius: 12px; padding: 24px; margin-bottom: 16px;">
                <h4 style="font-size: 16px; font-weight: 700; margin-bottom: 8px; cursor: pointer;">Bagaimana cara memulai?</h4>
                <p style="font-size: 14px; color: var(--text-secondary);">Cukup daftar akun gratis, setup profil toko Anda, dan mulai kelola bisnis dalam hitungan menit dengan panduan lengkap dari kami.</p>
            </div>
            
            <div style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(99, 102, 241, 0.05)); border: 1px solid rgba(99, 102, 241, 0.2); border-radius: 12px; padding: 24px; margin-bottom: 16px;">
                <h4 style="font-size: 16px; font-weight: 700; margin-bottom: 8px; cursor: pointer;">Apakah data saya aman?</h4>
                <p style="font-size: 14px; color: var(--text-secondary);">Ya, kami menggunakan enkripsi tingkat bank, backup otomatis, dan compliance dengan standar keamanan internasional ISO 27001.</p>
            </div>
            
            <div style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(99, 102, 241, 0.05)); border: 1px solid rgba(99, 102, 241, 0.2); border-radius: 12px; padding: 24px; margin-bottom: 16px;">
                <h4 style="font-size: 16px; font-weight: 700; margin-bottom: 8px; cursor: pointer;">Apakah ada biaya tersembunyi?</h4>
                <p style="font-size: 14px; color: var(--text-secondary);">Tidak ada. Harga yang tertera adalah harga final, semua fitur sudah termasuk. Tidak ada biaya setup atau tambahan lainnya.</p>
            </div>
            
            <div style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(99, 102, 241, 0.05)); border: 1px solid rgba(99, 102, 241, 0.2); border-radius: 12px; padding: 24px; margin-bottom: 16px;">
                <h4 style="font-size: 16px; font-weight: 700; margin-bottom: 8px; cursor: pointer;">Bagaimana jika saya butuh bantuan?</h4>
                <p style="font-size: 14px; color: var(--text-secondary);">Tim support kami siap 24/7 melalui chat, email, dan video call untuk membantu Anda mengatasi masalah dengan cepat.</p>
            </div>
        </div>
    </div>
</section>

<footer id="tentang">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-col">
                <h4>Tagepe UMKM</h4>
                <p>Platform digital modern untuk UMKM Indonesia yang ingin berkembang dan bersaing di era digital.</p>
            </div>
            <div class="footer-col">
                <h4>Produk</h4>
                <ul>
                    <li><a href="#">Fitur</a></li>
                    <li><a href="#">Harga</a></li>
                    <li><a href="#">Demo</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Perusahaan</h4>
                <ul>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Kontak</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Legal</h4>
                <ul>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Syarat & Ketentuan</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>Copyright 2026 Tagepe UMKM. Semua hak dilindungi. Desain digital untuk masa depan UMKM Indonesia.</p>
        </div>
    </div>
</footer>

</body>
</html>

