<!-- PWA Meta Tags -->
<meta name="application-name" content="TAGEPE">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="TAGEPE">
<meta name="theme-color" content="#667eea">
<meta name="msapplication-TileColor" content="#667eea">
<meta name="msapplication-navbutton-color" content="#667eea">

<!-- PWA Manifest -->
<link rel="manifest" href="/manifest.json">

<!-- Apple Touch Icons -->
<link rel="apple-touch-icon" sizes="72x72" href="/icons/icon-72x72.png">
<link rel="apple-touch-icon" sizes="96x96" href="/icons/icon-96x96.png">
<link rel="apple-touch-icon" sizes="128x128" href="/icons/icon-128x128.png">
<link rel="apple-touch-icon" sizes="144x144" href="/icons/icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/icons/icon-152x152.png">
<link rel="apple-touch-icon" sizes="192x192" href="/icons/icon-192x192.png">
<link rel="apple-touch-icon" sizes="384x384" href="/icons/icon-384x384.png">
<link rel="apple-touch-icon" sizes="512x512" href="/icons/icon-512x512.png">

<!-- Standard Icons -->
<link rel="icon" type="image/png" sizes="192x192" href="/icons/icon-192x192.png">
<link rel="icon" type="image/png" sizes="512x512" href="/icons/icon-512x512.png">

<!-- Apple Splash Screens (Optional) -->
<link rel="apple-touch-startup-image" href="/icons/icon-512x512.png">

<!-- PWA Script (Disabled for faster loading during development) -->
<!-- <script src="/pwa-register.js" defer></script> -->

<!-- Install Button (Hidden by default) -->
<button id="installBtn" style="display:none; position: fixed; bottom: 20px; right: 20px; z-index: 9999; padding: 12px 24px; background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; border-radius: 50px; box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4); font-weight: 600; cursor: pointer;">
    <i class="bi bi-download"></i> Install App
</button>

<style>
    /* PWA Mode Adjustments */
    .pwa-mode body {
        padding-top: env(safe-area-inset-top);
        padding-bottom: env(safe-area-inset-bottom);
    }
    
    #installBtn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 25px rgba(102, 126, 234, 0.5);
    }
    
    #installBtn:active {
        transform: translateY(0);
    }
</style>
