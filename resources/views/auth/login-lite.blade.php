<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#667eea">
    <title>Login - TAGEPE</title>
    
    <!-- Inline Critical CSS -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 3rem 2.5rem;
            max-width: 400px;
            width: 100%;
        }
        
        .logo {
            text-align: center;
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 1rem;
        }
        
        h2 {
            text-align: center;
            font-size: 1.75rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }
        
        p {
            text-align: center;
            color: #6b7280;
            margin-bottom: 2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        label {
            display: block;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }
        
        input {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            border: 2px solid #e5e7eb;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        
        input:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .btn-login {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 0.875rem;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            font-size: 1rem;
            width: 100%;
            cursor: pointer;
            transition: transform 0.3s;
        }
        
        .btn-login:active {
            transform: scale(0.98);
        }
        
        .links {
            text-align: center;
            margin-top: 1rem;
        }
        
        .links a {
            color: #667eea;
            text-decoration: none;
            font-size: 0.95rem;
        }
        
        .alert {
            padding: 0.875rem 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }
        
        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="logo">🏪</div>
        <h2>TAGEPE</h2>
        <p>Masuk ke akun Anda</p>
        
        @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
        @endif
        
        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="nama@email.com" required autofocus value="{{ old('email') }}">
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required>
            </div>
            
            <button type="submit" class="btn-login">Masuk</button>
        </form>
        
        <div class="links">
            <a href="{{ route('register') }}">Daftar</a> | 
            <a href="{{ route('home') }}">Beranda</a>
        </div>
    </div>
</body>
</html>
