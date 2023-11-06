class AppStorage  {

    storeToken(token){
        localStorage.setItem('token',token) 
     }

     storeUser(user){
        localStorage.setItem('user', user);
    }

    storeId(id){
        localStorage.setItem('id', id);
    }

    storeEntreprise(entreprise){
        localStorage.setItem('entreprise', entreprise);
    }

    store(token,user,id,entreprise){
        this.storeToken(token)
        this.storeUser(user)
        this.storeId(id)
        // this.storeEmail(email)
        this.storeEntreprise(entreprise)
    }

    clear(){
        localStorage.removeItem('token')
        localStorage.removeItem('user')
        localStorage.removeItem('id')
        // localStorage.removeItem('email')
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

    getEntreprise () {
        localStorage.getItem(entreprise)
    }

}

export default AppStorage = new AppStorage();