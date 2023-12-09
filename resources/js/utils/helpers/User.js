import Token from './Token'
import axios from 'axios';
import AppStorage from './AppStorage'

class User {
    constructor() {
    }

    static async responseAfterLogin(res) {
        const { access_token, name, user_id, id_entreprise } = res.data;

        AppStorage.store(access_token, name, user_id, id_entreprise);

        const storeDataInIndexedDB = async (endpoint, storageKey, accessToken) => {
            try {
                const response = await axios.get(`/api/auth/${endpoint}`, {
                    headers: { Authorization: `Bearer ${accessToken}` },
                });

                await AppStorage.storeDataInIndexedDB(storageKey, response.data);
            } catch (error) {
                console.error(error);
            }
        };

        const apiCalls = [
            { endpoint: 'getClient', storageKey: 'clients' },
            { endpoint: 'getProspect', storageKey: 'prospects' },
            { endpoint: 'getContrat', storageKey: 'contrats' },
            { endpoint: 'getCompagnie', storageKey: 'compagnies' },
            { endpoint: 'getApporteur', storageKey: 'apporteurs' },
            { endpoint: 'getBranches', storageKey: 'branches' },
        ];

        const promises = apiCalls.map(call =>
            storeDataInIndexedDB(call.endpoint, call.storageKey, access_token)
        );

        try {
            await Promise.all(promises);
            console.log('Toutes les données ont été récupérées et stockées avec succès.');
        } catch (error) {
            console.error('Une erreur s\'est produite lors de la récupération des données :', error);
        }
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
            // Assuming Token class is available
            const payload = Token.payload(localStorage.getItem('user'));
            return payload.sub;
        }
        return false;
    }
}

export default User;


