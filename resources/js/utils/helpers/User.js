import Token from './Token'
import AppStorage from './AppStorage'

class User {
    constructor() {
    }
    static responseAfterLogin(res) {
        const {access_token, name, user_id, id_entreprise} = res.data;
        console.log(res.data)
        
            AppStorage.store(access_token, name, user_id, id_entreprise)

            // Récupérer les clients de l'utilisateur après la connexion
            axios.get('/api/auth/getClient', { headers: { Authorization: `Bearer ${access_token}` } })
                .then(response => {
                    // Stocker les projets dans le localStorage ou où vous le souhaitez
                    AppStorage.storeClients(response.data);
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