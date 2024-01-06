// // sw.js

// // Écouter l'événement 'install' pour installer le Service Worker
// self.addEventListener('install', event => {
//     console.log('Service Worker installed');
//   });
  
//   // Écouter l'événement 'activate' pour activer le Service Worker
//   self.addEventListener('activate', event => {
//     console.log('Service Worker activated');
//   });
  
// //   // Écouter l'événement 'fetch' pour intercepter les requêtes réseau
// //   self.addEventListener('fetch', event => {
// //     // console.log('Fetching:', event.request.url);
  
// //     // Vérification de la connexion à l'API
// //     if (event.request.url.includes('/api/check-internet-connection')) {
// //       event.respondWith(
// //         fetch(event.request)
// //           .then(response => {
// //             // Synchronisation des données si la connexion est établie
// //             // Exemple : Sync data from API
// //             // fetch('votre_api_url/sync-data');
// //              console.log('Fetching:');
// //             return response;
// //           })
// //           .catch(error => {
// //             console.error('Error fetching:', error);
// //             return new Response('Offline');
// //           })
// //       );
// //     }
// //   });

//   self.addEventListener('fetch', event => {
//     // console.log('Fetching:', event.request.url);
  
//     // Vérification de la connexion à l'API
//     if (event.request.url.includes('/api/check-internet-connection')) {
//       // Logique de vérification de connexion ici
//       console.log('Verification request intercepted');
//       // ...
//     }
//     // Autres logiques de gestion des requêtes fetch
//   });
  
  