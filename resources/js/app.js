require('./bootstrap');

import { createApp } from "vue";
import router from "./routers";
// import login
import login from "../js/pages/auth/login";
import dashboard from "../js/pages/dashboard";
import courtage from "../js/pages/module/courtage";
import listbranche from "../js/pages/branche/listBranche";

import User from '../js/utils/helpers/User';
window.User = User
createApp({
    components: {
        login,
        dashboard,
        courtage,
        listbranche
      
    }
}).use(router)
    .mount('#app');