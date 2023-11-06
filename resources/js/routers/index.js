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
];




const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;