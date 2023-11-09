import { createRouter, createWebHistory } from "vue-router";
import login from "../pages/auth/login";
import logout from "../pages/auth/logout";
import dashboard from "../pages/dashboard";
import courtage from "../pages/module/courtage";
import listbranche from "../pages/branche/listBranche";
import createbranche from "../pages/branche/createbranche";
import listapporteur from "../pages/apporteur/listApporteur";
import createapporteur from "../pages/apporteur/createApporteur";
import tauxapporteur from "../pages/apporteur/tauxapporteur";
import listcompagnie from "../pages/compagnie/listCompagnie";
import createcompagnie from "../pages/compagnie/createCompagnie";
import tauxcompagnie from "../pages/compagnie/tauxcompagnie";
import listprospect from "../pages/prospect/listProspect";
import createprospect from "../pages/prospect/createProspect";
import detailsprospect from "../pages/prospect/detailsProspect";
import listclient from "../pages/clients/listclient";
import listrelance from "../pages/relance/listrelance";
import createrelance from "../pages/relance/createrelance";
import listcontrat from "../pages/contrat/listcontrat";
import createcontrat from "../pages/contrat/createcontrat";
import detailscontrat from "../pages/contrat/detailscontrat";
import avenants from "../pages/contrat/avenants";
import editcontrat from "../pages/contrat/editcontrat";
import listsinistre from "../pages/sinistres/listsinistre";
import createsinistre from "../pages/sinistres/createsinistre";
import editsinistre from "../pages/sinistres/editsinistre";
import voirsinistre from "../pages/sinistres/voirsinistre";
import reglement from "../pages/sinistres/reglement";
import upload from "../pages/uploads/upload";

const routes = [
  {
    path: '/',
    name: 'welcome',
    component: login
  },
  {
    path: '/home',
    name: 'dashboard',
    component: dashboard
  },
  {
    path: '/logout',
    name: 'logout',
    component: logout
  },
  {
    path: '/courtage',
    name: 'courtage',
    component: courtage
  },
  {
    path: '/listbranche',
    name: 'listbranche',
    component: listbranche
  },
  {
    path: '/createbranche',
    name: 'createbranche',
    component: createbranche
  },
  {
    path: '/listapporteur',
    name: 'listapporteur',
    component: listapporteur
  },
  {
    path: '/createapporteur',
    name: 'createapporteur',
    component: createapporteur
  },
  {
    path: '/tauxapporteur/:id_apporteur',
    name: 'tauxapporteur',
    component: tauxapporteur,
    props: true
  },
  {
    path: '/listcompagnie',
    name: 'listcompagnie',
    component: listcompagnie
  },
  {
    path: '/createcompagnie',
    name: 'createcompagnie',
    component: createcompagnie
  },
  {
    path: '/tauxcompagnie/:id_compagnie',
    name: 'tauxcompagnie',
    component: tauxcompagnie,
    props: true
  },
  {
    path: '/listprospect',
    name: 'listprospect',
    component: listprospect
  },
  {
    path: '/createprospect',
    name: 'createprospect',
    component: createprospect
  },
  {
    path: '/detailsprospect/:id_prospect',
    name: 'detailsprospect',
    component: detailsprospect,
    props: true
  },
  {
    path: '/listclient',
    name: 'listclient',
    component: listclient
  },
  {
    path: '/listrelance',
    name: 'listrelance',
    component: listrelance
  },
  {
    path: '/createrelance',
    name: 'createrelance',
    component: createrelance
  },
  {
    path: '/listcontrat',
    name: 'listcontrat',
    component: listcontrat
  },
  {
    path: '/createcontrat',
    name: 'createcontrat',
    component: createcontrat
  },
  {
    path: '/detailscontrat/:id_contrat',
    name: 'detailscontrat',
    component: detailscontrat,
    props: true
  },
  {
    path: '/avenants/:id_contrat',
    name: 'avenants',
    component: avenants,
    props: true
  },
  {
    path: '/editcontrat/:id_contrat',
    name: 'editcontrat',
    component: editcontrat,
    props: true
  },
  {
    path: '/listsinistre',
    name: 'listsinistre',
    component: listsinistre
  },
  {
    path: '/createsinistre',
    name: 'createsinistre',
    component: createsinistre
  },
  {
    path: '/editsinistre/:id_sinistre',
    name: 'editsinistre',
    component: editsinistre,
    props: true
  },
  {
    path: '/voirsinistre/:id_sinistre',
    name: 'voirsinistre',
    component: voirsinistre,
    props: true
  },
  {
    path: '/reglement/:id_sinistre',
    name: 'reglement',
    component: reglement,
    props: true
  },
  {
    path: '/upload',
    name: 'upload',
    component: upload
  },
];




const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;