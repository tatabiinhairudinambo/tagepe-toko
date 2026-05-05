<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Data Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .login-header {
            background: #ffffff;
            border-radius: 16px 16px 0 0;
            padding: 40px 32px;
            text-align: center;
            color: #2c3e50;
        }
        .login-header .icon {
            font-size: 3rem;
            margin-bottom: 8px;
        }
        .login-header .logo-container {
            margin-bottom: 20px;
        }
        .login-header .logo-container img {
            max-height: 180px;
            max-width: 100%;
            object-fit: contain;
        }
        
        /* Responsive untuk HP */
        @media (max-width: 576px) {
            body {
                padding: 15px;
            }
            .login-card {
                max-width: 100%;
            }
            .login-header {
                padding: 32px 24px;
            }
            .login-header .logo-container img {
                max-height: 140px;
            }
            .login-header h4 {
                font-size: 1.1rem;
            }
            .login-header p {
                font-size: 0.8rem;
            }
            .btn-primary {
                padding: 12px !important;
                font-size: 0.95rem !important;
            }
        }
    </style>
</head>
<body>
    <div class="login-card bg-white">
        <div class="login-header">
            @php $toko = \App\Models\Toko::first(); @endphp
            
            {{-- Logo Toko --}}
            <div class="logo-container">
                @if($toko && $toko->logo)
                    @if(str_starts_with($toko->logo, 'http'))
                        <img src="{{ $toko->logo }}" alt="Logo">
                    @else
                        <img src="{{ asset('storage/' . $toko->logo) }}" alt="Logo">
                    @endif
                @else
                    <img src="{{ asset('images/logo.png') }}" alt="Tagepe Toko Logo">
                @endif
            </div>

            <h4 class="mb-2 fw-bold">Dashboard {{ $toko->nama_toko ?? 'Tagepe Toko' }}</h4>
            <p class="mb-0 opacity-75 small">Welcome bro! Silakan login untuk melanjutkan.</p>
        </div>
        <div class="p-4">
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-circle"></i> {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label text-muted small fw-semibold">EMAIL</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control"
                               placeholder="Masukkan email" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label text-muted small fw-semibold">PASSWORD</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control"
                               placeholder="Masukkan password" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-3 fw-semibold" style="font-size:1rem">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                </button>
            </form>
        </div>
    </div>
</body>
</html>
