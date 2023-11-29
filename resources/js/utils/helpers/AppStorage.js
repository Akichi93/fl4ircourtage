class AppStorage {

    constructor() { }

    static storeToken(token) {
        localStorage.setItem('token', token);
    }

    static storeUser(user) {
        localStorage.setItem('user', user);
    }

    static storeId(id) {
        localStorage.setItem('id', id);
    }

    static storeEntreprise(entreprise) {
        localStorage.setItem('entreprise', entreprise);
    }

    static storeClients(clients) {
        localStorage.setItem('clients', JSON.stringify(clients));
    }

    static store(token, user, id, entreprise) {
        this.storeToken(token);
        this.storeUser(user);
        this.storeId(id);
        this.storeEntreprise(entreprise);
    }

    static clear() {
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        localStorage.removeItem('id');
        localStorage.removeItem('entreprise');
        localStorage.removeItem('clients');  // Ajoutez cette ligne pour supprimer les clients
    }

    static getToken() {
        return localStorage.getItem('token');
    }

    static getUser() {
        return localStorage.getItem('user');
    }

    static getId() {
        return localStorage.getItem('id');
    }

    static getEntreprise() {
        return localStorage.getItem('entreprise');
    }

    static getClients() {
        const clients = localStorage.getItem('clients');
        return clients ? JSON.parse(clients) : [];
    }
}

export default AppStorage;