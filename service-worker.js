self.addEventListener('install', function(event) {
    event.waitUntil(
      caches.open('static-v1').then(function(cache) {
        return cache.addAll([
          '/',
          '/Public/assets/main/css/app.css',
          '/Public/assets/main/css/vendor/bootstrap.min.css',
          '/Public/fav/android-chrome-192x192.png',
          '/Public/fav/android-chrome-512x512.png',
          '/Public/fav/apple-touch-icon.png',
          '/Public/assets/main/js/app.js',
          '/Public/assets/main/js/main.js',
          '/Public/assets/main/js/vendor/bootstrap.min.js',
          '/icons/icon-192x192.png',
          '/icons/icon-512x512.png'
        ]);
      })
    );
  });
  
  self.addEventListener('fetch', function(event) {
    event.respondWith(
      caches.match(event.request).then(function(response) {
        return response || fetch(event.request);
      })
    );
  });
  