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
        // localStorage.setItem(key, JSON.stringify(data));
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
            if (Array.isArray(existingData) && Array.isArray(data)) {
                const mergedData = existingData.concat(data);
                await store.put(mergedData, key);
                console.log(`Données fusionnées à apiData dans IndexedDB avec succès`);
            } else {
                console.error('Les données existantes ou les nouvelles données ne sont pas au format de tableau.');
            }
        } else {
            // Aucune donnée existante, ajouter simplement les nouvelles données
            await store.put(data, key);
            console.log(`Donnée ajoutée à apiData dans IndexedDB avec succès`);
        }


        // Terminer la transaction
        await tx.complete;
    }

    static async clearData(key) {
        const db = await openDB(this.dbName, 1, {
            upgrade(db) {
                db.createObjectStore('apiData');
            },
        });

        const tx = db.transaction('apiData', 'readwrite');
        const store = tx.objectStore('apiData');

        // Delete the data for the specified key
        await store.delete(key);

        // Complete the transaction
        await tx.complete;

        console.log(`Data cleared for ${key} in apiData in IndexedDB`);
    }

    static async fetchDataFromIndexedDB(key) {
        const db = await openDB(this.dbName, 1);
        const tx = db.transaction('apiData', 'readonly');
        const store = tx.objectStore('apiData');

        return store.get(key);
    }

    static async deleteIndexedDB() {
        try {
            const dbName = 'fl4ir'; // Nom de la base de données
            indexedDB.deleteDatabase(dbName);
            console.log('IndexedDB deleted successfully');
        } catch (error) {
            console.error('Error deleting IndexedDB:', error);
        }
    }

    static async paginateData(key, pageIndex = 0, pageSize = 10) {
        const allData = await this.getData(key) || [];
        return allData.slice(pageIndex * pageSize, (pageIndex + 1) * pageSize);
    }

    static async storeClients(clients) {
        await this.storeData('clients', clients);
    }

    static async searchClientsByName(name) {
        const allClients = await this.getData('clients') || [];
        const filteredClients = allClients.filter(client => client.nom_client.toLowerCase().includes(name.toLowerCase()));
        return filteredClients;
    }

    static async getClients(pageIndex = 0, pageSize = 10) {
        // return this.getData('clients') || [];
        return this.paginateData('clients', pageIndex, pageSize);
    }

    static async getClientById(clientId) {
        const allClients = await this.getData('clients') || [];
        return allClients.find(client => client.id_client === clientId);
    }

    static async storeProspects(prospects) {
        await this.storeData('prospects', prospects);
    }

    static async getProspects() {
        return this.getData('prospects') || [];
    }

    // Contrats

    static async storeContrats(contrats) {
        await this.storeData('contrats', contrats);
    }

    static async searchContratsByName(name) {
        const allContrats = await this.getData('contrats') || [];
        const filteredContrats = allContrats.filter(contrat => contrat.nom_contrat.toLowerCase().includes(name.toLowerCase()));
        return filteredContrats;
    }

    static async getContrats() {
        return this.getData('contrats') || [];
    }


    // Compagnies
    static async storeCompagnies(compagnies) {
        await this.storeData('compagnies', compagnies);
    }

    static async getCompagnies() {
        return this.getData('compagnies') || [];
    }

    static async searchCompagniesByName(name) {
        const allCompagnies = await this.getData('compagnies') || [];
        const filteredCompagnies = allCompagnies.filter(compagnie => compagnie.nom_compagnie.toLowerCase().includes(name.toLowerCase()));
        return filteredCompagnies;
    }

    static async storeTauxCompagnies(tauxcompagnies) {
        await this.storeData('tauxcompagnies', tauxcompagnies);
    }

    static async getCompanyNameById(idCompagnie) {
        // Convertir l'ID de compagnie en entier
        idCompagnie = +idCompagnie;
        try {
            const compagniesData = await this.getData('compagnies') || [];
            const compagnie = compagniesData.find(compagnie => compagnie.id_compagnie === idCompagnie);

            return compagnie ? compagnie.nom_compagnie : null;
        } catch (error) {
            console.error("Une erreur s'est produite lors de la récupération des données de la compagnie :", error);
            return null;
        }
    }

    static async getTauxCompagnies() {
        return this.getData('tauxcompagnies') || [];
    }

    static async getTauxCompagniesByIdCompagnie(uuidCompagnie) {
        // Convertir l'ID de compagnie en entier
        // uuidCompagnie = +uuidCompagnie; 

        const allTauxCompagnies = await this.fetchDataFromIndexedDB('tauxcompagnies') || [];

        const tauxCompagniesByIdCompagnie = allTauxCompagnies.filter(tauxcompagnie => {

        
            return tauxcompagnie.uuidCompagnie === uuidCompagnie;
        });

        return tauxCompagniesByIdCompagnie;
    }

    static async getTauxCompagnieById(tauxcompagnieId) {
        const allTauxCompagnies = await this.getData('tauxcompagnies') || [];
        return allTauxCompagnies.find(tauxcompagnie => tauxcompagnie.id_tauxcomp === tauxcompagnieId);
    }




    // Apporteurs
    static async storeApporteurs(apporteurs) {
        await this.storeData('apporteurs', apporteurs);
    }

    static async getApporteurs() {
        return this.getData('apporteurs') || [];
    }

    static async searchApporteursByName(name) {
        const allApporteurs = await this.getData('compagnies') || [];
        const filteredApporteurs = allApporteurs.filter(apporteur => apporteur.nom_apporteur.toLowerCase().includes(name.toLowerCase()));
        return filteredApporteurs;
    }

    static async storeTauxApporteurs(tauxapporteurs) {
        await this.storeData('tauxapporteurs', tauxapporteurs);
    }

    static async getTauxApporteurs() {
        return this.getData('tauxapporteurs') || [];
    }

    // Branches
    static async storeBranches(branches) {
        await this.storeData('branches', branches);
    }

    static async searchBranchesByName(name) {
        const allBranches = await this.getData('branches') || [];
        const filteredBranches = allBranches.filter(branche => branche.nom_branche.toLowerCase().includes(name.toLowerCase()));
        return filteredBranches;
    }

    static async getBranches() {
        return this.getData('branches') || [];
    }

    // static async getBranches(pageIndex = 0, pageSize = 10) {
    //     // return this.getData('branches') || [];
    //     return this.paginateData('branches', pageIndex, pageSize);
    // }


    static async store(token, user, id, entreprise, role) {
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

        await this.clearData('clients');
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

    static async clearClients() {
        await this.clearData('clients');
    }

}

export default AppStorage;