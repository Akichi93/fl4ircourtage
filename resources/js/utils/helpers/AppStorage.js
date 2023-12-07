class AppStorage {
    static TOKEN_KEY = 'token';
    static USER_KEY = 'user';
    static ID_KEY = 'id';
    static ENTREPRISE_KEY = 'entreprise';
    static CLIENTS_KEY = 'clients';
    static PROSPECTS_KEY = 'prospects';
    static CONTRATS_KEY = 'contrats';
    static COMPAGNIES_KEY = 'compagnies';
    static APPORTEURS_KEY = 'apporteurs';

    static storeToken(token) {
        localStorage.setItem(AppStorage.TOKEN_KEY, token);
    }

    static storeUser(user) {
        localStorage.setItem(AppStorage.USER_KEY, user);
    }

    static storeId(id) {
        localStorage.setItem(AppStorage.ID_KEY, id);
    }

    static storeEntreprise(entreprise) {
        localStorage.setItem(AppStorage.ENTREPRISE_KEY, entreprise);
    }

    static storeData(key, data, useSessionStorage = false) {
        const storage = useSessionStorage ? sessionStorage : localStorage;
        storage.setItem(key, JSON.stringify(data));
    }

    static store(token, user, id, entreprise) {
        this.storeToken(token);
        this.storeUser(user);
        this.storeId(id);
        this.storeEntreprise(entreprise);
    }

    static clear() {
        const keysToRemove = [
            AppStorage.TOKEN_KEY,
            AppStorage.USER_KEY,
            AppStorage.ID_KEY,
            AppStorage.ENTREPRISE_KEY,
            AppStorage.CLIENTS_KEY,
            AppStorage.PROSPECTS_KEY,
            AppStorage.CONTRATS_KEY,
            AppStorage.COMPAGNIES_KEY,
            AppStorage.APPORTEURS_KEY,
        ];

        keysToRemove.forEach(key => {
            if (localStorage.getItem(key)) {
                localStorage.removeItem(key);
            }
        });
    }

    static getData(key, useSessionStorage = false) {
        const storage = useSessionStorage ? sessionStorage : localStorage;
        try {
            const data = storage.getItem(key);
            return data ? JSON.parse(data) : [];
        } catch (error) {
            console.error(`Error parsing ${key}:`, error.message);
            return [];
        }
    }

    static getToken() {
        return localStorage.getItem(AppStorage.TOKEN_KEY);
    }

    static getUser() {
        return localStorage.getItem(AppStorage.USER_KEY);
    }

    static getId() {
        return localStorage.getItem(AppStorage.ID_KEY);
    }

    static getEntreprise() {
        return localStorage.getItem(AppStorage.ENTREPRISE_KEY);
    }

    static getClients() {
        return this.getData(AppStorage.CLIENTS_KEY, true);
    }

    static getProspects() {
        return this.getData(AppStorage.PROSPECTS_KEY, true);
    }

    static getContrats() {
        return this.getData(AppStorage.CONTRATS_KEY, true);
    }

    static getCompagnies() {
        return this.getData(AppStorage.COMPAGNIES_KEY, true);
    }

    static getApporteurs() {
        return this.getData(AppStorage.APPORTEURS_KEY, true);
    }
}

export default AppStorage;
