require('./bootstrap');

import { createApp } from "vue";
import router from "./routers";
// import login
import login from "../js/pages/auth/login";
import dashboard from "../js/pages/dashboard";

import User from '../js/utils/helpers/User';
window.User = User
createApp({
    components: {
        login,
        dashboard
      
    }
}).use(router)
    .mount('#app');