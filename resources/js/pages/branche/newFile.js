// User.js
import axios from 'axios';
import AppStorage from './AppStorage';
import Token from './Token';

class User {
  constructor() {}

  static async responseAfterLogin(res) {
    const { access_token, name, user_id, id_entreprise } = res.data;

    AppStorage.store(access_token, name, user_id, id_entreprise);

    const apiCalls = [
      { endpoint: 'getClient', storageKey: 'clients' },
      { endpoint: 'getProspect', storageKey: 'prospects' },
      { endpoint: 'getContrat', storageKey: 'contrats' },
      { endpoint: 'getCompagnie', storageKey: 'compagnies' },
      { endpoint: 'getApporteur', storageKey: 'apporteurs' },
      { endpoint: 'getBranches', storageKey: 'branches' },
      { endpoint: 'clientList', storageKey: 'clientList' },
      { endpoint: 'branchesList', storageKey: 'branchesList' },
    ];

    const promises = apiCalls.map(call =>
      User.storeDataInIndexedDB(call.endpoint, call.storageKey, access_token)
    );

    try {
      await Promise.all(promises);
      console.log('Toutes les données ont été récupérées et stockées avec succès.');
    } catch (error) {
      console.error('Une erreur s\'est produite lors de la récupération des données :', error);
    }
  }

  static async fetchDataAndStore(endpoint, storageKey, accessToken, page = 1) {
    try {
      const response = await axios.get(`/api/auth/${endpoint}?page=${page}`, {
        headers: { Authorization: `Bearer ${accessToken}` },
      });

      await AppStorage.storeDataInIndexedDB(storageKey, response.data);

      console.log(`Données pour ${endpoint} récupérées et stockées avec succès.`);
      return response.data;  // Si vous souhaitez retourner les données récupérées
    } catch (error) {
      console.error(`Une erreur s'est produite lors de la récupération des données pour ${endpoint}:`, error);
      throw error;  // Vous pouvez choisir de gérer l'erreur ici ou la propager vers le code appelant
    }
  }

  static async getClientList(page) {
    return User.fetchDataAndStore('clientList', 'clientList', localStorage.getItem('token'), page);
  }

  static async getBranchesList(page) {
    return User.fetchDataAndStore('branchesList', 'branchesList', localStorage.getItem('token'), page);
  }

  static async storeDataInIndexedDB(endpoint, storageKey, accessToken) {
    await User.fetchDataAndStore(endpoint, storageKey, accessToken);
  }

  static hasToken() {
    const storedToken = localStorage.getItem('token');
    return storedToken ? true : false;
  }

  static loggedIn() {
    return this.hasToken();
  }

  static name() {
    if (this.loggedIn()) {
      return localStorage.getItem('user');
    }
  }

  static id() {
    if (this.loggedIn()) {
      const payload = Token.payload(localStorage.getItem('user'));
      return payload.sub;
    }
    return false;
  }
}

export default User;
