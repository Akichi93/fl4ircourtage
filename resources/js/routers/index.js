import { createRouter, createWebHistory } from "vue-router";
import login from "../pages/auth/login";
import logout from "../pages/auth/logout";
import dashboard from "../pages/dashboard";
import courtage from "../pages/module/courtage";
import listbranche from "../pages/branche/listBranche";
import createbranche from "../pages/branche/createbranche";
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
];




const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;