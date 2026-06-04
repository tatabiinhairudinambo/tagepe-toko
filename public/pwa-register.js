// Register Service Worker (Lazy Load)
if ('serviceWorker' in navigator) {
  // Delay registration sampai page load selesai
  window.addEventListener('load', () => {
    setTimeout(() => {
      navigator.serviceWorker.register('/sw.js')
        .then(registration => {
          console.log('✅ Service Worker registered:', registration.scope);
        })
        .catch(error => {
          console.error('❌ Service Worker registration failed:', error);
        });
    }, 2000); // Delay 2 detik setelah page load
  });
}

// Show update notification
function showUpdateNotification() {
  if (confirm('Versi baru tersedia! Muat ulang aplikasi?')) {
    window.location.reload();
  }
}

// Install prompt
let deferredPrompt;

window.addEventListener('beforeinstallprompt', (e) => {
  console.log('💾 Install prompt ready');
  e.preventDefault();
  deferredPrompt = e;
  
  // Show custom install button
  showInstallButton();
});

function showInstallButton() {
  const installBtn = document.getElementById('installBtn');
  if (installBtn) {
    installBtn.style.display = 'block';
    installBtn.addEventListener('click', installApp);
  }
}

async function installApp() {
  if (!deferredPrompt) {
    console.log('Install prompt not available');
    return;
  }
  
  deferredPrompt.prompt();
  const { outcome } = await deferredPrompt.userChoice;
  console.log(`User response: ${outcome}`);
  
  deferredPrompt = null;
  
  const installBtn = document.getElementById('installBtn');
  if (installBtn) {
    installBtn.style.display = 'none';
  }
}

// Detect if app is running as PWA
function isPWA() {
  return window.matchMedia('(display-mode: standalone)').matches 
    || window.navigator.standalone 
    || document.referrer.includes('android-app://');
}

if (isPWA()) {
  console.log('✅ Running as PWA');
  document.body.classList.add('pwa-mode');
}

// Online/Offline detection
window.addEventListener('online', () => {
  console.log('✅ Online');
  showOnlineNotification();
});

window.addEventListener('offline', () => {
  console.log('❌ Offline');
  showOfflineNotification();
});

function showOnlineNotification() {
  const notification = document.createElement('div');
  notification.className = 'alert alert-success position-fixed top-0 start-50 translate-middle-x mt-3';
  notification.style.zIndex = '9999';
  notification.innerHTML = '<i class="bi bi-wifi"></i> Koneksi kembali normal';
  document.body.appendChild(notification);
  setTimeout(() => notification.remove(), 3000);
}

function showOfflineNotification() {
  const notification = document.createElement('div');
  notification.className = 'alert alert-warning position-fixed top-0 start-50 translate-middle-x mt-3';
  notification.style.zIndex = '9999';
  notification.innerHTML = '<i class="bi bi-wifi-off"></i> Mode offline - Beberapa fitur terbatas';
  document.body.appendChild(notification);
  setTimeout(() => notification.remove(), 5000);
}

// Log PWA capabilities
console.log('PWA Capabilities:', {
  serviceWorker: 'serviceWorker' in navigator,
  notifications: 'Notification' in window,
  sync: 'sync' in ServiceWorkerRegistration.prototype,
  pushManager: 'PushManager' in window
});
