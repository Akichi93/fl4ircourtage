import Token from './Token'
import AppStorage from './AppStorage'

class User {
    responseAfterLogin(res) {
        const access_token = res.data.access_token
        const username = res.data.name
        const userId = res.data.user_id
        const email = res.data.email
        const entrepriseId = res.data.id_entreprise
        if (Token.isValid(access_token)) {
            AppStorage.store(access_token,username,userId,email,entrepriseId)
        }
    }

    hasToken() { 
        const storedToken = localStorage.getItem('token');
        if (storedToken) {
            return Token.isValid(storedToken) ? true : false
        }
        false
    }

    loggedIn() {
        return this.hasToken()
    }


    name() {
        if (this.loggedIn()) {
            return localStorage.getItem('user')
        }
    }

    id() {
        if (this.loggedIn()) {
            const payload = Token.payload(localStorage.getItem('user'))
            return payload.sub
        }
        return false
    }

   

}

export default User = new User();