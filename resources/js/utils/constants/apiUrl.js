const base_url = '/api/auth';

export const apiUrl = {
    authentification: `${base_url}/login`,
    postcontrat: `${base_url}/postcontrat`,
    getcontrat: `${base_url}/getcontrats`,
    postapporteur: `${base_url}/postapporteur`,
    getapporteur: `${base_url}/getapporteurs`,
    gettauxapporteur: `${base_url}/gettauxapporteurs`,
    postcompagnie: `${base_url}/postcompagnie`,
    gettauxcompagnie: `${base_url}/gettauxcompagnies`,
    getcompagnie: `${base_url}/getcompagnies`,
    getprospect: `${base_url}/getprospects`,
    postprospect: `${base_url}/postprospect`,
    postbrancheprospect: `${base_url}/postbrancheprospect`,
    getavenant: `${base_url}/getavenants`,
    getbranche: `${base_url}/getbranches`,
    postbranche: `${base_url}/postbranche`,
    getclient: `${base_url}/getclients`,
    postclient: `${base_url}/postclient`,
    getlocalisation: `${base_url}/getlocalisations`,
    postlocalisation: `${base_url}/postlocalisations`,
    getprofession: `${base_url}/getprofessions`,
    postprofession: `${base_url}/postprofessions`,
    getmarque: `${base_url}/getmarques`,
    postmarque: `${base_url}/postmarques`,
    getenergie: `${base_url}/getenergies`,
    postenergie: `${base_url}/postenergies`,
    getcouleur: `${base_url}/getcouleurs`,
    postcouleur: `${base_url}/postcouleurs`,
    getgenre: `${base_url}/getgenres`,
    postgenre: `${base_url}/postgenres`,
    // settauxCompagny: (compagnyId) => `/gettauxcompagnie/${compagnyId}`,
}