import { openDB } from 'idb';

class AppStorage {
    constructor() { }

    static storeToken(token) {
        localStorage.setItem('token', token);
    }

    static storeUser(user) {
        localStorage.setItem('user', user);
    }

    static storeId(id) {
        localStorage.setItem('id', id);
    }

    static storeEntreprise(entreprise) {
        localStorage.setItem('entreprise', entreprise);
    }

    static async storeDataInIndexedDB(key, data) {
        const db = await openDB('your_database_name', 1, {
            upgrade(db) {
                db.createObjectStore('apiData');
            },
        });

        const tx = db.transaction('apiData', 'readwrite');
        const store = tx.objectStore('apiData');
        store.put(data, key);

        return tx.complete;
    }

    static async fetchDataFromIndexedDB(key) {
        const db = await openDB('your_database_name', 1);
        const tx = db.transaction('apiData', 'readonly');
        const store = tx.objectStore('apiData');

        return store.get(key);
    }

    static store(token, user, id, entreprise) {
        this.storeToken(token);
        this.storeUser(user);
        this.storeId(id);
        this.storeEntreprise(entreprise);
    }

    static clear() {
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        localStorage.removeItem('id');
        localStorage.removeItem('entreprise');
        localStorage.removeItem('clients');
        localStorage.removeItem('prospects');
        localStorage.removeItem('contrats');
        localStorage.removeItem('compagnies');
        localStorage.removeItem('apporteurs');
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

    static async storeClients(clients) {
        localStorage.setItem('clients', JSON.stringify(clients));
        await this.storeDataInIndexedDB('clients', clients);
    }

    static async getClients() {
        const indexedDBData = await this.fetchDataFromIndexedDB('clients');

        if (indexedDBData) {
            return indexedDBData;
        }

        const clients = localStorage.getItem('clients');
        return clients ? JSON.parse(clients) : [];
    }

    static async storeProspects(prospects) {
        localStorage.setItem('prospects', JSON.stringify(prospects));
        await this.storeDataInIndexedDB('prospects', prospects);
    }

    static async getProspects() {
        const indexedDBData = await this.fetchDataFromIndexedDB('prospects');

        if (indexedDBData) {
            return indexedDBData;
        }

        const prospects = localStorage.getItem('prospects');
        return prospects ? JSON.parse(prospects) : [];
    }

    static async storeContrats(contrats) {
        localStorage.setItem('contrats', JSON.stringify(contrats));
        await this.storeDataInIndexedDB('contrats', contrats);
    }

    static async getContrats() {
        const indexedDBData = await this.fetchDataFromIndexedDB('contrats');

        if (indexedDBData) {
            return indexedDBData;
        }

        const contrats = localStorage.getItem('contrats');
        return contrats ? JSON.parse(contrats) : [];
    }

    static async storeCompagnies(compagnies) {
        localStorage.setItem('compagnies', JSON.stringify(compagnies));
        await this.storeDataInIndexedDB('compagnies', compagnies);
    }

    static async getCompagnies() {
        const indexedDBData = await this.fetchDataFromIndexedDB('compagnies');

        if (indexedDBData) {
            return indexedDBData;
        }

        const compagnies = localStorage.getItem('compagnies');
        return compagnies ? JSON.parse(compagnies) : [];
    }

    static async storeApporteurs(apporteurs) {
        localStorage.setItem('apporteurs', JSON.stringify(apporteurs));
        await this.storeDataInIndexedDB('apporteurs', apporteurs);
    }

    static async getApporteurs() {
        const indexedDBData = await this.fetchDataFromIndexedDB('apporteurs');

        if (indexedDBData) {
            return indexedDBData;
        }

        const apporteurs = localStorage.getItem('apporteurs');
        return apporteurs ? JSON.parse(apporteurs) : [];
    }

    static async storeBranches(branches) {
        localStorage.setItem('branches', JSON.stringify(branches));
        await this.storeDataInIndexedDB('branches', branches);
    }

    static async getBranches() {
        const indexedDBData = await this.fetchDataFromIndexedDB('branches');

        if (indexedDBData) {
            return indexedDBData;
        }

        const branches = localStorage.getItem('branches');
        return branches ? JSON.parse(branches) : [];
    }
}

export default AppStorage;
