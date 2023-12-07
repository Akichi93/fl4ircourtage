import Token from './Token';
import AppStorage from './AppStorage';
import axios from 'axios';

class User {
    static async responseAfterLogin(res) {
        const { access_token, name, user_id, id_entreprise } = res.data;

        AppStorage.store(access_token, name, user_id, id_entreprise);

        try {
            const headers = { Authorization: `Bearer ${access_token}` };

            const clients = await axios.get('/api/auth/getClient', { headers });
            AppStorage.storeData(AppStorage.CLIENTS_KEY, clients.data);

            const prospects = await axios.get('/api/auth/getProspect', { headers });
            AppStorage.storeData(AppStorage.PROSPECTS_KEY, prospects.data);

            const contracts = await axios.get('/api/auth/getContrat', { headers });
            AppStorage.storeData(AppStorage.CONTRATS_KEY, contracts.data);

            const companies = await axios.get('/api/auth/getCompagnie', { headers });
            AppStorage.storeData(AppStorage.COMPAGNIES_KEY, companies.data);

            const apporteurs = await axios.get('/api/auth/getApporteur', { headers });
            AppStorage.storeData(AppStorage.APPORTEURS_KEY, apporteurs.data);

        } catch (error) {
            if (error.response && error.response.status === 401) {
                console.error('Unauthorized access:', error.message);
            } else {
                console.error('An error occurred:', error.message);
            }
        }
    }

    static hasToken() {
        const storedToken = AppStorage.getToken();
        return storedToken ? Token.isValid(storedToken) : false;
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
