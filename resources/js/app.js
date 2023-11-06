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
        createcompagnie
      
    }
}).use(router)
    .mount('#app');