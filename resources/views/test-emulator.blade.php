<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#667eea">
    <title>Test - TAGEPE</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            padding: 20px;
        }
        .box {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }
        h1 { font-size: 3rem; margin-bottom: 1rem; }
        p { font-size: 1.2rem; opacity: 0.9; margin-bottom: 0.5rem; }
        .status { 
            font-size: 2rem; 
            font-weight: bold; 
            color: #4ade80; 
            margin-top: 20px;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .btn {
            display: inline-block;
            margin-top: 30px;
            padding: 15px 40px;
            background: white;
            color: #667eea;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s;
        }
        .btn:active { transform: scale(0.95); }
        .info {
            margin-top: 30px;
            font-size: 0.9rem;
            opacity: 0.7;
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>🎉</h1>
        <h1>TAGEPE</h1>
        <p>Emulator terhubung!</p>
        <p>Server Laravel berjalan dengan baik</p>
        <div class="status">✓ SUKSES</div>
        
        <a href="{{ route('login') }}" class="btn">Ke Halaman Login</a>
        
        <div class="info">
            <p>Time: {{ now()->format('H:i:s') }}</p>
            <p>Server: {{ request()->server('SERVER_ADDR') }}</p>
        </div>
    </div>
</body>
</html>
