import axios from 'axios';
import AppStorage from '../utils/helpers/AppStorage';

class AxiosService {
    constructor() {
        const token = AppStorage.getToken();

        // Configure request headers
        const headers = {
            Authorization: "Bearer " + token,
            "x-access-token": token,
        };

        // Create an Axios instance with custom headers
        this.axiosService = axios.create({
            headers,
        });
    }

    // Example method for making a GET request
    // async fetchData(url) {
    //     try {
    //         const response = await this.axiosService.get(url);
    //         return response.data;
    //     } catch (error) {
    //         // Handle error appropriately
    //         console.error("Error fetching data:", error);
    //         throw error;
    //     }
    // }
}

export default new AxiosService();
