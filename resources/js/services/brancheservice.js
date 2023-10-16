import axios from "axios";


export async function getBranchesList(page = 1) {

    const token = localStorage.getItem("token");

    // Configurez les en-têtes de la requête
    const headers = {
        Authorization: "Bearer " + token,
        "x-access-token": token,
    };

    const response = await axios.get("/api/auth/branchesList?page=" + page, { headers })
    return response.data.data;

}

export async function postBranche(rcv_data) {

    const token = localStorage.getItem("token");

    // Configurez les en-têtes de la requête
    const headers = {
        Authorization: "Bearer " + token,
        "x-access-token": token,
    };

    const response = await axios.post(`/api/auth/postBranches `, rcv_data, { headers })
    return response.data;

}

export async function getBranches(id_branche, rcv_data) {
    const response = await axios
        .get("/editBranche/" + id_branche, rcv_data)
    return response.data.user;

}

