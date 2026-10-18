const CACHE_NAME = 'gemasmart-cache-v1';
const STATIC_ASSETS = [
    '/',
    '/login',
    '/gemas.jpg',
    '/icon-192.png',
    '/icon-512.png',
    '/manifest.json',
    'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap',
    'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200'
];

// Install: Pre-cache static assets
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            return cache.addAll(STATIC_ASSETS).catch((err) => {
                console.warn('[SW] Some assets failed to precache:', err);
            });
        }).then(() => self.skipWaiting())
    );
});

// Activate: Clean up old caches
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((keys) => {
            return Promise.all(
                keys.map((key) => {
                    if (key !== CACHE_NAME) {
                        return caches.delete(key);
                    }
                })
            );
        }).then(() => self.clients.claim())
    );
});

// Fetch: Network first with cache fallback for pages, Cache first for assets
self.addEventListener('fetch', (event) => {
    const request = event.request;

    // Only handle GET requests
    if (request.method !== 'GET') {
        return;
    }

    const url = new URL(request.url);

    // Navigation requests (HTML pages): Network-first, fallback to cache
    if (request.mode === 'navigate') {
        event.respondWith(
            fetch(request)
                .then((response) => {
                    if (response.status === 200) {
                        const copy = response.clone();
                        caches.open(CACHE_NAME).then((cache) => cache.put(request, copy));
                    }
                    return response;
                })
                .catch(async () => {
                    const cachedResponse = await caches.match(request);
                    if (cachedResponse) {
                        return cachedResponse;
                    }
                    // Try to return cached dashboard or login
                    const dashboardCached = await caches.match('/penerima/dashboard');
                    if (dashboardCached) return dashboardCached;
                    const loginCached = await caches.match('/login');
                    if (loginCached) return loginCached;

                    return new Response(
                        `<!DOCTYPE html>
                        <html lang="id">
                        <head>
                            <meta charset="utf-8"/>
                            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
                            <title>Gema Smart - Mode Offline</title>
                            <style>
                                body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; background: #f8fafc; color: #1e293b; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; padding: 20px; box-sizing: border-box; text-align: center; }
                                .card { background: white; border-radius: 16px; padding: 32px 24px; max-width: 440px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); border: 1px solid #e2e8f0; }
                                .badge { display: inline-block; background: #fef3c7; color: #92400e; font-size: 12px; font-weight: bold; padding: 4px 12px; border-radius: 9999px; margin-bottom: 16px; }
                                h1 { font-size: 20px; color: #00450d; margin: 0 0 12px; }
                                p { font-size: 14px; color: #64748b; line-height: 1.6; margin: 0 0 20px; }
                                .btn { display: inline-block; background: #00450d; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; }
                            </style>
                        </head>
                        <body>
                            <div class="card">
                                <span class="badge">📡 Sedang Di Luar Jangkauan Sinyal</span>
                                <h1>Mode Offline Gema Smart</h1>
                                <p>Perangkat Anda sedang tidak terhubung ke jaringan internet. Halaman ini memerlukan koneksi internet awal untuk dimuat.</p>
                                <a href="javascript:location.reload()" class="btn">Muat Ulang Saat Ada Sinyal</a>
                            </div>
                        </body>
                        </html>`,
                        { headers: { 'Content-Type': 'text/html; charset=utf-8' } }
                    );
                })
        );
        return;
    }

    // Static assets: Cache first, then network
    event.respondWith(
        caches.match(request).then((cachedResponse) => {
            if (cachedResponse) {
                // Fetch in background to update cache
                fetch(request).then((networkResponse) => {
                    if (networkResponse.status === 200) {
                        caches.open(CACHE_NAME).then((cache) => cache.put(request, networkResponse));
                    }
                }).catch(() => {});
                return cachedResponse;
            }
            return fetch(request).then((response) => {
                if (response.status === 200 && (url.origin === location.origin || url.hostname.includes('googleapis') || url.hostname.includes('gstatic'))) {
                    const copy = response.clone();
                    caches.open(CACHE_NAME).then((cache) => cache.put(request, copy));
                }
                return response;
            });
        })
    );
});
