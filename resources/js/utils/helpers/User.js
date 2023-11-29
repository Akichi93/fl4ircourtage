import Token from './Token'
import AppStorage from './AppStorage'

class User {
    constructor() {
    }
    static responseAfterLogin(res) {
        const { access_token, name, user_id, id_entreprise } = res.data;

        AppStorage.store(access_token, name, user_id, id_entreprise)

        // Récupérer les clients de l'utilisateur après la connexion
        axios.get('/api/auth/getClient', { headers: { Authorization: `Bearer ${access_token}` } })
            .then(response => {
                // Stocker les clients dans le localStorage
                AppStorage.storeClients(response.data);
            })
            .catch(error => {
                console.error(error);
            });

        // Récupérer les prospects de l'utilisateur après la connexion
        axios.get('/api/auth/getProspect', { headers: { Authorization: `Bearer ${access_token}` } })
            .then(response => {
                // Stocker les prospects dans le localStorage 
                AppStorage.storeProspects(response.data);
            })
            .catch(error => {
                console.error(error);
            });

        // Récupérer les contrats de l'utilisateur après la connexion
        axios.get('/api/auth/getContrat', { headers: { Authorization: `Bearer ${access_token}` } })
            .then(response => {
                // Stocker les contrat dans le localStorage 
                AppStorage.storeContrats(response.data);
            })
            .catch(error => {
                console.error(error);
            });

        // Récupérer les compagnies de l'utilisateur après la connexion
        axios.get('/api/auth/getCompagnie', { headers: { Authorization: `Bearer ${access_token}` } })
            .then(response => {
                // Stocker les compagnies dans le localStorage 
                AppStorage.storeCompagnies(response.data);
            })
            .catch(error => {
                console.error(error);
            });


        // Récupérer les apporteurs de l'utilisateur après la connexion
        axios.get('/api/auth/getApporteur', { headers: { Authorization: `Bearer ${access_token}` } })
            .then(response => {
                // Stocker les apporteurs dans le localStorage 
                AppStorage.storeApporteurs(response.data);
            })
            .catch(error => {
                console.error(error);
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