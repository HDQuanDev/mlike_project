importScripts('https://storage.googleapis.com/workbox-cdn/releases/5.1.2/workbox-sw.js');

const CACHE = "pwabuilder-page";
const offlineFallbackPage = "offline.html";

var FILES_TO_CACHE = [
    '/assets/css/vendors/font-awesome.css',
    '/assets/css/vendors/icofont.css',
    '/assets/css/vendors/themify.css',
    '/assets/css/vendors/flag-icon.css',
    '/assets/css/vendors/feather-icon.css',
    '/assets/css/vendors/bootstrap.css',
    '/assets/css/style.css',
    '/assets/css/responsive.css',
    '/assets/css/color-1.css',
    '/offline.html'
];

self.addEventListener("message", (event) => {
    if (event.data && event.data.type === "SKIP_WAITING") {
        self.skipWaiting();
    }
});

self.addEventListener('install', async (event) => {
    event.waitUntil(
        caches.open(CACHE)
        .then((cache) => cache.addAll(FILES_TO_CACHE.concat(offlineFallbackPage)))
    );
});

if (workbox.navigationPreload.isSupported()) {
    workbox.navigationPreload.enable();
}

self.addEventListener('fetch', (event) => {
    if (event.request.mode === 'navigate') {
        event.respondWith((async () => {
            try {
                const preloadResp = await event.preloadResponse;

                if (preloadResp) {
                    return preloadResp;
                }

                const networkResp = await fetch(event.request);
                return networkResp;
            } catch (error) {

                const cache = await caches.open(CACHE);
                const cachedResp = await cache.match(offlineFallbackPage);
                return cachedResp;
            }
        })());
    }
});