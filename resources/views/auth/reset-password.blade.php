<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - TAGEPE UMKM</title>
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
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1a2332 0%, #2c3e50 50%, #34495e 100%);
            position: relative;
            overflow: hidden;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(52, 152, 219, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: patternMove 20s linear infinite;
        }
        
        @keyframes patternMove {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }
        
        .reset-card {
            background: white;
            border-radius: 20px;
            padding: 50px;
            max-width: 480px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 2;
            animation: slideUp 0.6s ease-out;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .icon-wrapper {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #3498db, #2ecc71);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            font-size: 2.5rem;
        }
        
        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .form-header h2 {
            font-size: 1.8rem;
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        
        .form-header p {
            color: #7f8c8d;
            font-size: 0.95rem;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e0e6ed;
            border-radius: 10px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #3498db;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1);
        }
        
        .btn-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #3498db, #2ecc71);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(52, 152, 219, 0.4);
        }
        
        .back-link {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e0e6ed;
        }
        
        .back-link a {
            color: #3498db;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .back-link a:hover {
            color: #2980b9;
        }
        
        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: none;
        }
        
        .alert-danger {
            background: #fee;
            color: #c33;
        }
        
        @media (max-width: 576px) {
            .reset-card {
                padding: 30px 25px;
                margin: 20px;
            }
            
            .form-header h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

<div class="reset-card">
    <div class="icon-wrapper">
        🔑
    </div>
    
    <div class="form-header">
        <h2>Reset Password</h2>
        <p>Masukkan password baru Anda</p>
    </div>
    
    @if($errors->any())
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>{{ $errors->first() }}</strong>
        </div>
    @endif
    
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">
        
        <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" 
                   class="form-control" 
                   value="{{ $email }}" 
                   readonly>
        </div>
        
        <div class="form-group">
            <label class="form-label">Password Baru</label>
            <input type="password" 
                   name="password" 
                   class="form-control" 
                   placeholder="Minimal 6 karakter" 
                   required 
                   autofocus>
        </div>
        
        <div class="form-group">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" 
                   name="password_confirmation" 
                   class="form-control" 
                   placeholder="Ulangi password baru" 
                   required>
        </div>
        
        <button type="submit" class="btn-submit">
            Reset Password
        </button>
    </form>
    
    <div class="back-link">
        <a href="{{ route('login') }}">
            <i class="bi bi-arrow-left me-1"></i>
            Kembali ke Login
        </a>
    </div>
</div>

</body>
</html>
