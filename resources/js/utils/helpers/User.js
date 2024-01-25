import axios from 'axios';
import AppStorage from './AppStorage';
import Token from './Token';

class User {
    static async responseAfterLogin(res) {
        const { access_token, name, user_id, id_entreprise, role } = res.data;

        await AppStorage.store(access_token, name, user_id, id_entreprise, role);

        const apiCalls = [
            { endpoint: 'getClients', storageKey: 'clients' },
            { endpoint: 'getProspects', storageKey: 'prospects' },
            { endpoint: 'getContrats', storageKey: 'contrats' },
            { endpoint: 'getCompagnies', storageKey: 'compagnies' },
            { endpoint: 'getApporteurs', storageKey: 'apporteurs' },
            { endpoint: 'getBranches', storageKey: 'branches' },
            { endpoint: 'getAvenants', storageKey: 'avenants' },

            { endpoint: 'getTauxCompagnies', storageKey: 'tauxcompagnies' },
            { endpoint: 'getTauxApporteurs', storageKey: 'tauxapporteurs' },
        ];

        const accessToken = AppStorage.getToken();

        for (const call of apiCalls) {
            await User.storeDataInIndexedDB(call.endpoint, call.storageKey, accessToken);
        }

        console.log('Toutes les données ont été récupérées et stockées avec succès.');
    }

    static async storeDataInIndexedDB(endpoint, storageKey, accessToken) {
        try {
            const response = await axios.get(`/api/auth/${endpoint}`, {
                headers: { Authorization: `Bearer ${accessToken}` },
            });

            await AppStorage.storeData(storageKey, response.data);
        } catch (error) {
            console.error(error);
        }
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