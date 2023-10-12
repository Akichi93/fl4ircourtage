import { createRouter, createWebHistory } from "vue-router";
import login from "../pages/auth/login";
import logout from "../pages/auth/logout";
import dashboard from "../pages/dashboard"
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
];




const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;