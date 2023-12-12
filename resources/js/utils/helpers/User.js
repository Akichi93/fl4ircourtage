import axios from 'axios';
import AppStorage from './AppStorage';
import Token from './Token';

class User {
    static async responseAfterLogin(res) {
        const { access_token, name, user_id, id_entreprise } = res.data;

        await AppStorage.store(access_token, name, user_id, id_entreprise);

        const apiCalls = [
            { endpoint: 'getClient', storageKey: 'clients' },
            { endpoint: 'getProspect', storageKey: 'prospects' },
            { endpoint: 'getContrat', storageKey: 'contrats' },
            { endpoint: 'getCompagnie', storageKey: 'compagnies' },
            { endpoint: 'getApporteur', storageKey: 'apporteurs' },
            { endpoint: 'getBranches', storageKey: 'branches' },
            { endpoint: 'clientList', storageKey: 'clientList' },
            { endpoint: 'branchesList', storageKey: 'branchesList' },
            { endpoint: 'apporteurList', storageKey: 'apporteurList' },
            { endpoint: 'compagnieList', storageKey: 'compagnieList' },
            { endpoint: 'contratList', storageKey: 'contratList' },
            { endpoint: 'prospectList', storageKey: 'prospectList' },
        ];

        const accessToken = AppStorage.getToken();

        for (const call of apiCalls) {
            await User.storeDataInIndexedDB(call.endpoint, call.storageKey, accessToken);
        }

        console.log('Toutes les données ont été récupérées et stockées avec succès.');
    }

    static async storeDataInIndexedDB(endpoint, storageKey, accessToken, page = 1) {
        try {
            const response = await axios.get(`/api/auth/${endpoint}?page=${page}`, {
                headers: { Authorization: `Bearer ${accessToken}` },
            });

            await AppStorage.storeData(storageKey, response.data);
        } catch (error) {
            console.error(error);
        }
    }

    static async getClientList(page) {
        const accessToken = AppStorage.getToken();
        await User.storeDataInIndexedDB('clientList', 'clientList', accessToken, page);
    }

    static async getBranchesList(page) {
        const accessToken = AppStorage.getToken();
        await User.storeDataInIndexedDB('branchesList', 'branchesList', accessToken, page);
    }

    static async getApporteurList(page) {
        const accessToken = AppStorage.getToken();
        await User.storeDataInIndexedDB('apporteurList', 'apporteurList', accessToken, page);
    }

    static async getCompagnieList(page) {
        const accessToken = AppStorage.getToken();
        await User.storeDataInIndexedDB('compagnieList', 'compagnieList', accessToken, page);
    }

    static async getContratList(page) {
        const accessToken = AppStorage.getToken();
        await User.storeDataInIndexedDB('contratList', 'contratList', accessToken, page);
    }

    static async getProspectList(page) {
        const accessToken = AppStorage.getToken();
        await User.storeDataInIndexedDB('prospectList', 'prospectList', accessToken, page);
    }

    static hasToken() {
        return AppStorage.getToken() !== null;
    }

    static loggedIn() {
        return this.hasToken();
    }

    static name() {
        return this.loggedIn() ? AppStorage.getUser() : null;
    }

    static id() {
        if (this.loggedIn()) {
            const payload = Token.payload(AppStorage.getUser());
            return payload.sub;
        }
        return null;
    }
}

export default User;