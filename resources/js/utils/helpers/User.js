import axios from 'axios';
import AppStorage from './AppStorage';
import Token from './Token';

class User {
    static async responseAfterLogin(res) {
        const { access_token, name, user_id, id_entreprise, role } = res.data;

        await AppStorage.store(access_token, name, user_id, id_entreprise, role);

        const apiCalls = [
            { endpoint: 'getclients', storageKey: 'clients' },
            { endpoint: 'getprospects', storageKey: 'prospects' },
            { endpoint: 'getcontrats', storageKey: 'contrats' },
            { endpoint: 'getcompagnies', storageKey: 'compagnies' },
            { endpoint: 'getapporteurs', storageKey: 'apporteurs' },
            { endpoint: 'getbranches', storageKey: 'branches' },
            { endpoint: 'getavenants', storageKey: 'avenants' },

            { endpoint: 'getlocalisations', storageKey: 'localisations' },
            { endpoint: 'getprofessions', storageKey: 'professions' },
            { endpoint: 'getmarques', storageKey: 'marques' },
            { endpoint: 'getenergies', storageKey: 'energies' },
            { endpoint: 'getcouleurs', storageKey: 'couleurs' },
            { endpoint: 'getgenres', storageKey: 'genres' },

            { endpoint: 'getbrancheprospects', storageKey: 'brancheprospects' },

            { endpoint: 'gettauxcompagnies', storageKey: 'tauxcompagnies' },
            { endpoint: 'gettauxapporteurs', storageKey: 'tauxapporteurs' },
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