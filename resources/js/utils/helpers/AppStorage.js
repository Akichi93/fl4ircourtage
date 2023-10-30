class AppStorage  {

    storeToken(token){
        localStorage.setItem('token',token) 
     }

     storeUser(user){
        localStorage.setItem('user', user);
    }

    storeUser(id){
        localStorage.setItem('id', id);
    }

    storeUser(email){
        localStorage.setItem('email', email);
    }

    storeUser(email){
        localStorage.setItem('email', email);
    }

    storeUser(id_entreprise){
        localStorage.setItem('id_entreprise', id_entreprise);
    }

    store(token,user,id,email,id_entreprise){
        this.storeToken(token)
        this.storeUser(user)
        this.storeUser(id)
        this.storeUser(email)
        this.storeUser(id_entreprise)
    }

    clear(){
        localStorage.removeItem('token')
        localStorage.removeItem('user')
        localStorage.removeItem('id')
        localStorage.removeItem('email')
    }

    getToken () {
         localStorage.getItem(token)
    }

    getUser () {
        localStorage.getItem(user)
    }

    getId () {
        localStorage.getItem(id)
    }

}

export default AppStorage = new AppStorage();