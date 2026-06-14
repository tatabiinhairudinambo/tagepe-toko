<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - TAGEPE UMKM</title>
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
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Main Container */
        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            padding: 40px 20px;
        }
        
        /* Background Effects */
        .register-container::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 1000px;
            height: 1000px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.15), transparent);
            border-radius: 50%;
            animation: float 20s ease-in-out infinite;
        }
        
        .register-container::after {
            content: '';
            position: absolute;
            bottom: -50%;
            left: -50%;
            width: 1000px;
            height: 1000px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.15), transparent);
            border-radius: 50%;
            animation: float 25s ease-in-out infinite reverse;
        }
        
        @keyframes float { 
            0%, 100% { transform: translateY(0px); } 
            50% { transform: translateY(30px); } 
        }
        
        /* Form Card */
        .register-card {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05), rgba(168, 85, 247, 0.05));
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 16px;
            padding: 48px;
            box-shadow: 0 0 40px rgba(99, 102, 241, 0.3), inset 0 0 40px rgba(99, 102, 241, 0.05);
            backdrop-filter: blur(10px);
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 420px;
            animation: slideUp 0.6s ease-out;
        }
        
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Form Header */
        .form-header {
            text-align: center;
            margin-bottom: 32px;
        }
        
        .form-header h1 {
            font-size: 28px;
            font-weight: 900;
            margin-bottom: 8px;
            background: linear-gradient(135deg, #f1f5f9, #cbd5e1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .form-header p {
            font-size: 14px;
            color: var(--text-secondary);
        }
        
        /* Form Group */
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 16px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(99, 102, 241, 0.05));
            border: 2px solid rgba(99, 102, 241, 0.2);
            border-radius: 8px;
            color: var(--text-primary);
            font-size: 14px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .form-control::placeholder {
            color: rgba(241, 245, 249, 0.5);
        }
        
        .form-control:focus {
            outline: none;
            border-color: rgba(99, 102, 241, 0.6);
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.15), rgba(99, 102, 241, 0.1));
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.2);
        }
        
        /* Form Error */
        .form-error {
            color: #ef4444;
            font-size: 12px;
            margin-top: 6px;
            display: none;
        }
        
        .form-group.error .form-error {
            display: block;
        }
        
        .form-group.error .form-control {
            border-color: rgba(239, 68, 68, 0.4);
        }
        
        /* Password Strength */
        .password-strength {
            margin-top: 8px;
            height: 3px;
            background: rgba(99, 102, 241, 0.1);
            border-radius: 2px;
            overflow: hidden;
            display: none;
        }
        
        .password-strength-bar {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
        }
        
        /* Submit Button */
        .btn {
            width: 100%;
            padding: 12px 24px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 20px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #6366f1, #a855f7);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(99, 102, 241, 0.4);
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        /* Footer Link */
        .form-footer {
            text-align: center;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid rgba(99, 102, 241, 0.2);
            font-size: 14px;
            color: var(--text-secondary);
        }
        
        .form-footer a {
            color: #6366f1;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }
        
        .form-footer a:hover {
            color: #a855f7;
        }
        
        /* Alert */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-size: 13px;
            display: none;
        }
        
        .alert.show {
            display: block;
        }
        
        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }
        
        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #86efac;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .register-card {
                padding: 32px;
                border-radius: 12px;
            }
            
            .form-header h1 {
                font-size: 24px;
            }
            
            .form-header p {
                font-size: 13px;
            }
        }
        
        @media (max-width: 640px) {
            .register-container {
                padding: 20px;
            }
            
            .register-card {
                padding: 24px;
                max-width: 100%;
            }
            
            .form-header h1 {
                font-size: 20px;
                margin-bottom: 4px;
            }
            
            .form-header p {
                font-size: 12px;
            }
            
            .form-group {
                margin-bottom: 16px;
            }
            
            .form-label {
                font-size: 12px;
                margin-bottom: 6px;
            }
            
            .form-control {
                padding: 10px 14px;
                font-size: 13px;
            }
            
            .btn {
                padding: 11px 20px;
                font-size: 13px;
                margin-top: 16px;
            }
            
            .form-footer {
                margin-top: 16px;
                padding-top: 16px;
                font-size: 12px;
            }
        }
        
        @media (max-width: 480px) {
            .register-card {
                padding: 20px;
            }
            
            .form-header h1 {
                font-size: 18px;
            }
            
            .form-header p {
                font-size: 11px;
            }
        }
    </style>
</head>
<body>

<div class="register-container">
    <div class="register-card">
        <div class="form-header">
            <h1>Buat Akun Baru</h1>
            <p>Bergabung dengan TAGEPE UMKM dan kelola bisnis Anda dengan mudah</p>
        </div>
        
        @if ($errors->any())
            <div class="alert alert-danger show">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        
        <form action="{{ route('register') }}" method="POST" id="registerForm">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap Anda" value="{{ old('name') }}" required>
                @error('name')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan alamat email Anda" value="{{ old('email') }}" required>
                @error('email')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Kata Sandi</label>
                <input type="password" name="password" class="form-control" placeholder="Buat kata sandi yang kuat" required>
                @error('password')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Konfirmasi Kata Sandi</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi kata sandi Anda" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Daftar Sekarang</button>
        </form>
        
        <div class="form-footer">
            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
        </div>
    </div>
</div>

</body>
</html>