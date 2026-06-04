<!-- Splash Screen -->
<div id="splashScreen" style="
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    z-index: 99999;
    transition: opacity 0.5s ease;
">
    <div style="text-align: center; color: white;">
        <!-- Logo Icon -->
        <div style="
            width: 120px;
            height: 120px;
            background: white;
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            animation: bounceIn 0.8s ease;
        ">
            <i class="bi bi-shop" style="font-size: 4rem; color: #667eea;"></i>
        </div>
        
        <!-- App Name -->
        <h1 style="
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            animation: fadeInUp 0.8s ease 0.2s both;
        ">TAGEPE</h1>
        
        <!-- Tagline -->
        <p style="
            font-size: 1rem;
            opacity: 0.9;
            margin-bottom: 3rem;
            animation: fadeInUp 0.8s ease 0.4s both;
        ">Sistem POS untuk UMKM</p>
        
        <!-- Loading Spinner -->
        <div style="animation: fadeInUp 0.8s ease 0.6s both;">
            <div class="spinner-border text-white" role="status" style="width: 3rem; height: 3rem;">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes bounceIn {
        0% {
            transform: scale(0.3);
            opacity: 0;
        }
        50% {
            transform: scale(1.05);
        }
        70% {
            transform: scale(0.9);
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
    // Hide splash screen after page load
    window.addEventListener('load', () => {
        setTimeout(() => {
            const splash = document.getElementById('splashScreen');
            if (splash) {
                splash.style.opacity = '0';
                setTimeout(() => {
                    splash.style.display = 'none';
                }, 500);
            }
        }, 800); // Show for 0.8 seconds
    });
</script>
