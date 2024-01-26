var CACHE_NAME = 'web-app-cache-v1';
var OFFLINE_URL = '/offline.html';
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

self.addEventListener('install', function (event) {
    event.waitUntil(
        caches.open(CACHE_NAME).then(function (cache) {
            return cache.addAll(FILES_TO_CACHE.concat(OFFLINE_URL));
        })
    );
});

self.addEventListener('fetch', function (event) {
    event.respondWith(
        caches.match(event.request).then(function (response) {
            return response || fetch(event.request).catch(function () {
                return caches.match(OFFLINE_URL);
            });
        })
    );
});