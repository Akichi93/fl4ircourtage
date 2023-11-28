import Token from './Token'
import AppStorage from './AppStorage'

class User {
    constructor() {
    }
    static responseAfterLogin(res) {
        const access_token = res.data.access_token
        const username = res.data.name
        const id = res.data.user_id
        const entreprise = res.data.id_entreprise
        if (Token.isValid(access_token)) {
            const appStorage = new AppStorage()
            appStorage.store(access_token, username, id, entreprise)

            // Récupérer les clients de l'utilisateur après la connexion
            // axios.get('/api/auth/getClient', { headers: { Authorization: `Bearer ${access_token}` } })
            //     .then(response => {
            //         // Stocker les projets dans le localStorage ou où vous le souhaitez
            //         AppStorage.storeClients(response.data);
            //     })
            //     .catch(error => {
            //         console.error(error);
            //     });
        }
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