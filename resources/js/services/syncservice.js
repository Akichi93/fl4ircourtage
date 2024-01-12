// SyncService.js
import AppStorage from '../utils/helpers/AppStorage';

export default {
  async checkAndSyncData() {
    const dataTypes = ['clients', 'prospects', 'branches', 'compagnies', 'apporteurs', 'contrats'];

    for (const dataType of dataTypes) {
      const dataToSync = await this[`get${capitalize(dataType)}ToSync`]();
      if (dataToSync.length > 0) {
        await this.syncData(`/api/auth/sync-${dataType}`, dataToSync, dataType);
      }
    }
  },

  async getClientsToSync() {
    return this.getToSync('clients');
  },

  async getProspectsToSync() {
    return this.getToSync('prospects');
  },

  async getBranchesToSync() {
    return this.getToSync('branches');
  },

  async getCompagniesToSync() {
    return this.getToSync('compagnies');
  },

  async getApporteursToSync() {
    return this.getToSync('apporteurs');
  },

  async getContratsToSync() {
    return this.getToSync('contrats');
  },

  async getToSync(dataType) {
    const queue = await AppStorage[`get${capitalize(dataType)}`]();
    return queue.filter(dataItem => dataItem.sync === 0);
  },

  async syncData(endpoint, dataToSync, dataType) {
    try {
      // Retrieve token from local storage
      const token = AppStorage.getToken(); // Replace 'yourTokenKey' with your actual key

      const response = await fetch(endpoint, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${token}`, // Include the token in the header
        },
        body: JSON.stringify(dataToSync),
      });

      if (response.ok) {
        // AppStorage.clearSyncedData(dataType);
        console.log("Merci");
      } else {
        console.error(`La synchronisation des ${dataType} a échoué. Statut : ${response.status}`);
      }
    } catch (error) {
      console.error(`Erreur lors de la synchronisation des ${dataType} :`, error.message || error);
    }
  },
};

function capitalize(str) {
  return str.charAt(0).toUpperCase() + str.slice(1);
}
