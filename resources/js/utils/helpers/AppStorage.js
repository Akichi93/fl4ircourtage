// AppStorage.js
import { openDB } from 'idb';

class AppStorage {
    static dbName = 'fl4ir';

    static async storeToken(token) {
        localStorage.setItem('token', token);
    }

    static async storeUser(user) {
        localStorage.setItem('user', user);
    }

    static async storeId(id) {
        localStorage.setItem('id', id);
    }

    static async storeEntreprise(entreprise) {
        localStorage.setItem('entreprise', entreprise);
    }

    static async storeRole(role) {
        localStorage.setItem('role', role);
    }

    static async storeData(key, data) {
        localStorage.setItem(key, JSON.stringify(data));
        await this.storeDataInIndexedDB(key, data);
    }

    static async getData(key) {
        const indexedDBData = await this.fetchDataFromIndexedDB(key);

        if (indexedDBData) {
            return indexedDBData;
        }

        const data = localStorage.getItem(key);
        return data ? JSON.parse(data) : null;
    }

    static async storeDataInIndexedDB(key, data) {
        const db = await openDB(this.dbName, 1, {
            upgrade(db) {
                db.createObjectStore('apiData');
            },
        });

        const tx = db.transaction('apiData', 'readwrite');
        const store = tx.objectStore('apiData');

        const existingData = await store.get(key);

        if (existingData) {
            // Gestion des conflits : fusionner les données existantes avec les nouvelles données
            const mergedData = { ...existingData, ...data };
            await store.put(mergedData, key);
            console.log(`Données fusionnées à apiData dans IndexedDB avec succès`);
        } else {
            // Aucune donnée existante, ajouter simplement les nouvelles données
            await store.put(data, key);
            console.log(`Donnée ajoutée à apiData dans IndexedDB avec succès`);
        }

        // Terminer la transaction
        await tx.complete;
    }

    static async fetchDataFromIndexedDB(key) {
        const db = await openDB(this.dbName, 1);
        const tx = db.transaction('apiData', 'readonly');
        const store = tx.objectStore('apiData');

        return store.get(key);
    }

    static async storeClients(clients) {
        await this.storeData('clients', clients);
    }

    static async getClients() {
        return this.getData('clients') || [];
    }

    static async storeProspects(prospects) {
        await this.storeData('prospects', prospects);
    }

    static async getProspects() {
        return this.getData('prospects') || [];
    }

    static async storeContrats(contrats) {
        await this.storeData('contrats', contrats);
    }

    static async getContrats() {
        return this.getData('contrats') || [];
    }

    static async storeCompagnies(compagnies) {
        await this.storeData('compagnies', compagnies);
    }

    static async getCompagnies() {
        return this.getData('compagnies') || [];
    }

    static async storeApporteurs(apporteurs) {
        await this.storeData('apporteurs', apporteurs);
    }

    static async getApporteurs() {
        return this.getData('apporteurs') || [];
    }

    static async storeBranches(branches) {
        await this.storeData('branches', branches);
    }

    static async getBranches() {
        return this.getData('branches') || [];
    }

    static async storeClientList(clientList) {
        await this.storeData('clientList', clientList);
    }

    static async getClientList() {
        return this.getData('clientList') || [];
    }

    static async storeBranchesList(branchesList) {
        await this.storeData('branchesList', branchesList);
    }

    static async getBranchesList() {
        return this.getData('branchesList') || [];
    }

    static async storeCompagnieList(compagnieList) {
        await this.storeData('compagnieList', compagnieList);
    }

    static async getCompagnieList() {
        return this.getData('compagnieList') || [];
    }

    static async storeApporteurList(apporteurList) {
        await this.storeData('apporteurList', apporteurList);
    }

    static async getApporteurList() {
        return this.getData('apporteurList') || [];
    }

    static async storeContratList(contratList) {
        await this.storeData('contratList', contratList);
    }

    static async getContratList() {
        return this.getData('contratList') || [];
    }

    static async storeProspectList(prospectList) {
        await this.storeData('prospectList', prospectList);
    }

    static async getProspectList() {
        return this.getData('prospectList') || [];
    }


    static async store(token, user, id, entreprise,role) {
        await this.storeToken(token);
        await this.storeUser(user);
        await this.storeId(id);
        await this.storeEntreprise(entreprise);
        await this.storeRole(role);
    }

    static async clear() {
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        localStorage.removeItem('id');
        localStorage.removeItem('entreprise');
        localStorage.removeItem('role');
    }

    static getToken() {
        return localStorage.getItem('token');
    }

    static getUser() {
        return localStorage.getItem('user');
    }

    static getId() {
        return localStorage.getItem('id');
    }

    static getEntreprise() {
        return localStorage.getItem('entreprise');
    }

    static getRole() {
        return localStorage.getItem('role');
    }
}

export default AppStorage;