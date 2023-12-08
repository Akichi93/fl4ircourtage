import Token from './Token'
import AppStorage from './AppStorage'

class User {
    constructor() {
    }
    static responseAfterLogin(res) {
        const { access_token, name, user_id, id_entreprise } = res.data;

        AppStorage.store(access_token, name, user_id, id_entreprise)

        // Fonction générique pour effectuer un appel API et stocker les données dans le localStorage
        const fetchDataAndStore = (endpoint, storageKey, accessToken) => {
            return axios.get(`/api/auth/${endpoint}`, { headers: { Authorization: `Bearer ${accessToken}` } })
                .then(response => {
                    AppStorage[storageKey](response.data);
                })
                .catch(error => {
                    console.error(error);
                });
        };

        // Liste des appels API à effectuer
        const apiCalls = [
            { endpoint: 'getClient', storageKey: 'storeClients' },
            { endpoint: 'getProspect', storageKey: 'storeProspects' },
            { endpoint: 'getContrat', storageKey: 'storeContrats' },
            { endpoint: 'getCompagnie', storageKey: 'storeCompagnies' },
            { endpoint: 'getApporteur', storageKey: 'storeApporteurs' },
        ];

        // Promesse pour traiter toutes les requêtes en parallèle
        const promises = apiCalls.map(call => fetchDataAndStore(call.endpoint, call.storageKey, access_token));

        // Exécute toutes les promesses en parallèle
        Promise.all(promises)
            .then(() => {
                console.log('Toutes les données ont été récupérées et stockées avec succès.');
            })
            .catch(error => {
                console.error('Une erreur s\'est produite lors de la récupération des données :', error);
            });


    }

    static hasToken() {
        const storedToken = localStorage.getItem('token');
        if (storedToken) {
            return Token.isValid(storedToken) ? true : false
        }
        false
    }

    static loggedIn() {
        return this.hasToken()
    }


    static name() {
        if (this.loggedIn()) {
            return localStorage.getItem('user')
        }
    }

    static id() {
        if (this.loggedIn()) {
            const payload = Token.payload(localStorage.getItem('user'))
            return payload.sub
        }
        return false
    }



}

export default User;

