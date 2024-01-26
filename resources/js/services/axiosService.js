import axios from 'axios';
class AppStorage {
    static axiosService;
    constructor() {
        const token = AppStorage.getToken();

        // Configurez les en-têtes de la requête
        const headers = {
            Authorization: "Bearer " + token,
            "x-access-token": token,
        };
        axiosService = axios.create(headers)
    }
}

