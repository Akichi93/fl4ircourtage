require('./bootstrap');

import { createApp } from "vue";
import router from "./routers";
import VueHtmlToPaper from 'vue-html-to-paper';

import BootstrapVue3 from 'bootstrap-vue-3'
// import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue-3/dist/bootstrap-vue-3.css'
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
import listsinistre from "../js/pages/sinistres/listsinistre";
import createsinistre from "../js/pages/sinistres/createsinistre";
import editsinistre from '../js/pages/sinistres/editsinistre';
import voirsinistre from '../js/pages/sinistres/voirsinistre';
import reglement from '../js/pages/sinistres/reglement';
import upload from "../js/pages/uploads/upload";
import statistique from "../js/pages/module/statistique";
import statcontrat from "../js/pages/statistiques/statcontrat";
import statsinitre from "../js/pages/statistiques/statsinistre";
import statclient from "../js/pages/statistiques/statclient";
import infoclient from "../js/pages/statistiques/infoclient";
import statsupprime from "../js/pages/statistiques/statsupprime";
import statapporteur from "../js/pages/statistiques/statapporteur";
import infoapporteur from "../js/pages/statistiques/infoapporteur";

const options = {
    name: '_blank',
    specs: [
        'fullscreen=yes',
        'titlebar=yes',
        'scrollbars=yes'
    ],
    "styles": [
        "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css",
        "https://unpkg.com/kidlat-css/css/kidlat.css",
        "public/landscape.css"
    ],
    timeout: 1000, // default timeout before the print window appears
    autoClose: true, // if false, the window will not close after printing
    windowTitle: window.document.title, // override the window title
}

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
        editcontrat,
        listsinistre,
        createsinistre,
        editsinistre,
        voirsinistre,
        reglement,
        upload,
        statistique,
        statcontrat,
        statsinitre,
        statclient,
        infoclient,
        statapporteur,
        statsupprime,
        infoapporteur
    }
}).use(router)
    .use(BootstrapVue3)
    .use(VueHtmlToPaper, options)
    .mount('#app');