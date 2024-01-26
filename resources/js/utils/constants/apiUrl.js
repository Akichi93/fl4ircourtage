const base_url = '/api/auth';

export const apiUrl = {
    authentification: `${base_url}/login`,
    postcontrat: `${base_url}/postContrat`,
    getcontrat: `${base_url}/getContrats`,
    postapporteur: `${base_url}/postApporteur`,
    getapporteur: `${base_url}/getApporteurs`,
    getcompagnie: `${base_url}/getCompagnies`,
    // setCompagny: (compagnyId) => `/compagnies/${compagnyId}`,
}