<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #1a2535, #2c3e50); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .error-card { background: white; border-radius: 20px; padding: 50px 40px; text-align: center; max-width: 480px; box-shadow: 0 30px 80px rgba(0,0,0,.3); }
        .error-code { font-size: 6rem; font-weight: 900; background: linear-gradient(135deg, #e74c3c, #c0392b); -webkit-background-clip: text; -webkit-text-fill-color: transparent; line-height: 1; }
        .error-icon { font-size: 3rem; color: #e74c3c; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="error-card">
        <div class="error-icon"><i class="bi bi-shield-lock-fill"></i></div>
        <div class="error-code">403</div>
        <h4 class="fw-bold mt-3 mb-2">Akses Ditolak</h4>
        <p class="text-muted mb-4">{{ $exception->getMessage() ?: 'Kamu tidak punya izin untuk mengakses halaman ini.' }}</p>
        <div class="d-flex gap-2 justify-content-center">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                <i class="bi bi-speedometer2 me-1"></i> Dashboard
            </a>
        </div>
    </div>
</body>
</html>
