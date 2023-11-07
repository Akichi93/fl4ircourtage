require('./bootstrap');

import { createApp } from "vue";
import router from "./routers";
// import login
import login from "../js/pages/auth/login";
import dashboard from "../js/pages/dashboard";
import courtage from "../js/pages/module/courtage";
import listbranche from "../js/pages/branche/listBranche";
import createbranche from "../js/pages/branche/createbranche";
import listapporteur from "../js/pages/apporteur/listApporteur";
import createapporteur from "../js/pages/apporteur/createApporteur";
import tauxapporteur from "../js/pages/apporteur/tauxapporteur";
import listcompagnie from "../js/pages/compagnie/listCompagnie";
import createcompagnie from "../js/pages/compagnie/createCompagnie";
import tauxcompagnie from "../js/pages/compagnie/tauxcompagnie";
import listprospect from "../js/pages/prospect/listProspect";
import createprospect from "../js/pages/prospect/createProspect";
import detailsprospect from "../js/pages/prospect/detailsProspect";
import listclient from "../js/pages/clients/listclient";
import listrelance from "../js/pages/relance/listrelance";
import createrelance from "../js/pages/relance/createrelance";
import listcontrat from "../js/pages/contrat/listcontrat";
import createcontrat from "../js/pages/contrat/createcontrat";
import detailscontrat from "../js/pages/contrat/detailscontrat";
import avenants from "../js/pages/contrat/avenants";
import editcontrat from "../js/pages/contrat/editcontrat";

import User from '../js/utils/helpers/User';
window.User = User


createApp({
    components: {
        login,
        dashboard,
        courtage,
        listbranche,
        createbranche,
        listapporteur,
        createapporteur,
        tauxapporteur,
        listcompagnie,
        createcompagnie,
        tauxcompagnie,
        listprospect,
        createprospect,
        detailsprospect,
        listclient,
        listrelance,
        createrelance,
        listcontrat,
        createcontrat,
        detailscontrat,
        avenants,
        editcontrat
      
    }
}).use(router)
    .mount('#app');