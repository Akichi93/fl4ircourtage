class AppStorage {

    constructor() {}

    storeToken(token) {
        localStorage.setItem('token', token);
    }

    storeUser(user) {
        localStorage.setItem('user', user);
    }

    storeId(id) {
        localStorage.setItem('id', id);
    }

    storeEntreprise(entreprise) {
        localStorage.setItem('entreprise', entreprise);
    }

    // storeClients(clients) {
    //     localStorage.setItem('clients', JSON.stringify(clients));
    // }

    store(token, user, id, entreprise) {
        this.storeToken(token);
        this.storeUser(user);
        this.storeId(id);
        this.storeEntreprise(entreprise);
        // this.storeClients(clients);  // Ajoutez cette ligne pour stocker les clients
    }

    clear() {
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        localStorage.removeItem('id');
        localStorage.removeItem('entreprise');
        // localStorage.removeItem('clients');  // Ajoutez cette ligne pour supprimer les clients
    }

    getToken() {
        return localStorage.getItem('token');
    }

    getUser() {
        return localStorage.getItem('user');
    }

    getId() {
        return localStorage.getItem('id');
    }

    getEntreprise() {
        return localStorage.getItem('entreprise');
    }

    getClients() {
        const clients = localStorage.getItem('clients');
        return clients ? JSON.parse(clients) : [];
    }
}

export default AppStorage;