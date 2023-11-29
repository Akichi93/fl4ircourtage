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

    static storeProspects(prospects) {
        localStorage.setItem('prospects', JSON.stringify(prospects));
    }

    static storeContrats(contrats) {
        localStorage.setItem('contrats', JSON.stringify(contrats));
    }

    static storeCompagnies(compagnies) {
        localStorage.setItem('compagnies', JSON.stringify(compagnies));
    }

    static storeApporteurs(apporteurs) {
        localStorage.setItem('apporteurs', JSON.stringify(apporteurs));
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
        localStorage.removeItem('clients');   
        localStorage.removeItem('prospects');  
        localStorage.removeItem('contrats');   
        localStorage.removeItem('compagnies');  
        localStorage.removeItem('apporteurs');  
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

    static getProspects() {
        const prospects = localStorage.getItem('prospects');
        return prospects ? JSON.parse(prospects) : [];
    }

    static getContrats() {
        const contrats = localStorage.getItem('contrats');
        return contrats ? JSON.parse(contrats) : [];
    }

    static getCompagnies() {
        const compagnies = localStorage.getItem('compagnies');
        return compagnies ? JSON.parse(compagnies) : [];
    }

    static getApporteurs() {
        const apporteurs = localStorage.getItem('apporteurs');
        return apporteurs ? JSON.parse(apporteurs) : [];
    }
}

export default AppStorage;