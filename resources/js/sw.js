// Dans votre fichier sw.js
self.addEventListener('fetch', function(event) {
    // Vérifier si le navigateur est en ligne
    if (navigator.onLine) {
      // Faire quelque chose si le navigateur est en ligne
      console.log('Le navigateur est en ligne!');
    } else {
      // Faire quelque chose si le navigateur est hors ligne
      console.log('Le navigateur est hors ligne!');
    }
  });