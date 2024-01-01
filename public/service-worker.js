// service-worker.js

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request).then(response => {
      // Intercepter les requêtes sortantes et répondre avec une réponse en cache
      return response || fetch(event.request);
    })
  );
});

self.addEventListener('sync', event => {
  if (event.tag === 'syncSelectiveData') {
    event.waitUntil(checkConnectionAndSync());
  }
});

function checkConnectionAndSync() {
  return fetch('/api/check-connection')
    .then(response => {
      if (response.ok) {
        return syncSelectiveData();
      } else {
        console.error('No internet connection available');
      }
    })
    .catch(error => {
      console.error('Connection check error:', error);
    });
}

async function syncSelectiveData() {
  try {
    // Récupération et envoi des données clients
    await syncClients();

    // Récupération et envoi des données prospects
    await syncProspects();

    // ... et ainsi de suite pour d'autres ensembles de données

  } catch (error) {
    console.error('Selective sync error:', error);
  }
}

// Fonction pour synchroniser les données clients
async function syncClients() {
  try {
    const clientsData = await AppStorage.fetchDataFromIndexedDB('clients');
    if (clientsData) {
      const clientsResponse = await fetch('/api/synchronize-clients', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(clientsData),
      });

      if (clientsResponse.ok) {
        console.log('Données clients synchronisées avec succès');
        await AppStorage.clearData('clients');
        console.log('Données clients supprimées de IndexedDB après synchronisation');
      } else {
        console.error('Échec de la synchronisation des données clients');
        throw new Error('Échec de la synchronisation des données clients');
      }
    }
  } catch (error) {
    console.error('Erreur lors de la synchronisation des données clients:', error);
    throw error; // Propagation de l'erreur pour gérer dans syncSelectiveData()
  }
}

// Fonction pour synchroniser les données prospects
async function syncProspects() {
  try {
    const prospectsData = await AppStorage.fetchDataFromIndexedDB('prospects');
    if (prospectsData) {
      const prospectsResponse = await fetch('/api/synchronize-prospects', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(prospectsData),
      });

      if (prospectsResponse.ok) {
        console.log('Données prospects synchronisées avec succès');
        await AppStorage.clearData('prospects');
        console.log('Données prospects supprimées de IndexedDB après synchronisation');
      } else {
        console.error('Échec de la synchronisation des données prospects');
        throw new Error('Échec de la synchronisation des données prospects');
      }
    }
  } catch (error) {
    console.error('Erreur lors de la synchronisation des données prospects:', error);
    throw error; // Propagation de l'erreur pour gérer dans syncSelectiveData()
  }
}
