import { createRouter, createWebHistory } from "vue-router";
import { useClientFileStore } from '../store/clientfile';
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({
  /* options */
});
import login from "../pages/auth/login";
import register from "../pages/auth/register";
import forgot from "../pages/auth/forgot";
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
import statistique from "../pages/module/statistique";
import statcontrat from "../pages/statistiques/statcontrat";
import statsinistre from "../pages/statistiques/statsinistre";
import statclient from "../pages/statistiques/statclient";
import infoclient from "../pages/statistiques/infoclient";
import infocontrat from "../pages/statistiques/infocontrat";
import statapporteur from "../pages/statistiques/statapporteur";
import infoapporteur from "../pages/statistiques/infoapporteur";
import statsupprime from "../pages/statistiques/statsupprime";
import rh from "../pages/module/rh";
import listuser from "../pages/users/listuser";
import profil from "../pages/users/profil";
import entreprise from "../pages/parametre/entreprise";
import upload from "../pages/uploads/upload";
import reporting from "../pages/statistiques/reporting";

const routes = [
  {
    path: '/',
    name: 'welcome',
    component: login,
    meta: { requiresAuth: false },
  },
  {
    path: '/register',
    name: 'register',
    component: register,
    meta: { requiresAuth: false }
  },
  {
    path: '/forgot',
    name: 'forgot',
    component: forgot,
    meta: { requiresAuth: false }
  },
  {
    path: '/home',
    name: 'dashboard',
    component: dashboard,
    meta: { requiresAuth: true },
  },
  {
    path: '/logout',
    name: 'logout',
    component: logout,
    meta: { requiresAuth: true }
  },
  {
    path: '/courtage',
    name: 'courtage',
    component: courtage,
    meta: { requiresAuth: true }
  },
  {
    path: '/listbranche',
    name: 'listbranche',
    component: listbranche,
    meta: { requiresAuth: true }
  },
  {
    path: '/createbranche',
    name: 'createbranche',
    component: createbranche,
    meta: { requiresAuth: true }
  },
  {
    path: '/listapporteur',
    name: 'listapporteur',
    component: listapporteur,
    meta: { requiresAuth: true },
  },
  {
    path: '/createapporteur',
    name: 'createapporteur',
    component: createapporteur,
    meta: { requiresAuth: true }
  },
  {
    path: '/tauxapporteur/:id_apporteur',
    name: 'tauxapporteur',
    component: tauxapporteur,
    props: true,
    meta: { requiresAuth: true }
  },
  {
    path: '/listcompagnie',
    name: 'listcompagnie',
    component: listcompagnie,
    meta: { requiresAuth: true }
  },
  {
    path: '/createcompagnie',
    name: 'createcompagnie',
    component: createcompagnie,
    meta: { requiresAuth: true }
  },
  {
    path: '/tauxcompagnie/:id_compagnie',
    name: 'tauxcompagnie',
    component: tauxcompagnie,
    props: true,
    meta: { requiresAuth: true }
  },
  {
    path: '/listprospect',
    name: 'listprospect',
    component: listprospect,
    meta: { requiresAuth: true }
  },
  {
    path: '/createprospect',
    name: 'createprospect',
    component: createprospect,
    meta: { requiresAuth: true }
  },
  {
    path: '/detailsprospect/:id_prospect',
    name: 'detailsprospect',
    component: detailsprospect,
    props: true,
    meta: { requiresAuth: true }
  },
  {
    path: '/listclient',
    name: 'listclient',
    component: listclient,
    meta: { requiresAuth: true }
  },
  {
    path: '/listrelance',
    name: 'listrelance',
    component: listrelance,
    meta: { requiresAuth: true }
  },
  {
    path: '/createrelance',
    name: 'createrelance',
    component: createrelance,
    meta: { requiresAuth: true }
  },
  {
    path: '/listcontrat',
    name: 'listcontrat',
    component: listcontrat,
    meta: { requiresAuth: true }
  },
  {
    path: '/createcontrat',
    name: 'createcontrat',
    component: createcontrat,
    meta: { requiresAuth: true }
  },
  {
    path: '/detailscontrat/:id_contrat',
    name: 'detailscontrat',
    component: detailscontrat,
    props: true,
    meta: { requiresAuth: true }
  },
  {
    path: '/avenants/:id_contrat',
    name: 'avenants',
    component: avenants,
    props: true,
    meta: { requiresAuth: true }
  },
  {
    path: '/editcontrat/:id_contrat',
    name: 'editcontrat',
    component: editcontrat,
    props: true,
    meta: { requiresAuth: true }
  },
  {
    path: '/listsinistre',
    name: 'listsinistre',
    component: listsinistre,
    meta: { requiresAuth: true }
  },
  {
    path: '/createsinistre',
    name: 'createsinistre',
    component: createsinistre,
    meta: { requiresAuth: true }
  },
  {
    path: '/editsinistre/:id_sinistre',
    name: 'editsinistre',
    component: editsinistre,
    props: true,
    meta: { requiresAuth: true }
  },
  {
    path: '/voirsinistre/:id_sinistre',
    name: 'voirsinistre',
    component: voirsinistre,
    props: true,
    meta: { requiresAuth: true }
  },
  {
    path: '/reglement/:id_sinistre',
    name: 'reglement',
    component: reglement,
    props: true,
    meta: { requiresAuth: true }
  },
  {
    path: '/statistique',
    name: 'statistique',
    component: statistique,
    meta: { requiresAuth: true }
  },
  {
    path: '/statcontrat',
    name: 'statcontrat',
    component: statcontrat,
    meta: { requiresAuth: true }
  },
  {
    path: '/statsinistre',
    name: 'statsinistre',
    component: statsinistre,
    meta: { requiresAuth: true }
  },
  {
    path: '/statclient',
    name: 'statclient',
    component: statclient,
    meta: { requiresAuth: true }
  },
  {
    path: '/statclient/details/:id_client',
    name: 'infoclient',
    component: infoclient,
    props: true,
    meta: { requiresAuth: true }
  },
  {
    path: '/statclient/detailcontrats/:id_contrat',
    name: 'infocontrat',
    component: infocontrat,
    props: true,
    meta: { requiresAuth: true }
  },
  {
    path: '/statapporteur',
    name: 'statapporteur',
    component: statapporteur,
    meta: { requiresAuth: true }
  },
  {
    path: '/statapporteur/details/:id_apporteur',
    name: 'infoapporteur',
    component: infoapporteur,
    props: true,
    meta: { requiresAuth: true }
  },
  {
    path: '/statsupprime',
    name: 'statsupprime',
    component: statsupprime,
    meta: { requiresAuth: true }
  },
  {
    path: '/rh',
    name: 'rh',
    component: rh,
    meta: { requiresAuth: true }
  },
  {
    path: '/listuser',
    name: 'listuser',
    component: listuser,
    meta: { requiresAuth: true }
  },
  {
    path: '/profil',
    name: 'profil',
    component: profil,
    meta: { requiresAuth: true }
  },
  {
    path: '/entreprise',
    name: 'entreprise',
    component: entreprise,
    meta: { requiresAuth: true }
  },
  {
    path: '/upload',
    name: 'upload',
    component: upload,
    meta: { requiresAuth: true }
  },
  {
    path: '/reporting',
    name: 'reporting',
    component: reporting,
    meta: { requiresAuth: true }
  },
];


const router = createRouter({
  history: createWebHistory(),
  routes
});


// Navigation guard
router.beforeEach(async (to, from, next) => {
  if (to.meta.requiresAuth && !User.loggedIn()) {
    next({ name: 'welcome' }); // Redirect to welcome page if not logged in
  } else if (!to.meta.requiresAuth && User.loggedIn()) {
    next({ name: 'dashboard' }); // Redirect to dashboard if logged in and trying to access a non-authenticated route
  } else {
    const clientFileStore = useClientFileStore();

    if (clientFileStore.isLoadingFile) {
      // Si le fichier est en cours de chargement, empêcher la navigation
      await toaster.warning("Base des clients en cours de chargement. Veuillez patienter.", {
        position: "top-right",
      });
      next(false);
    } else {
      // Sinon, permettre la navigation
      next();
    }

    //else
    next(); // Proceed with the navigation
  }
});



export default router;