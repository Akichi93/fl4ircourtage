<template>
  <div class="sidebar" id="sidebar">
    <div class="sidebar-left slimscroll">
      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <router-link v-if="roleactif == 'ADMIN' ||
          roleactif == 'SUPERADMIN' ||
          roleactif == 'COURTIER' ||
          roleactif == 'COMMERCIAL'
          " class="nav-link menu" to="/home" title="Accueil" role="tab" aria-controls="v-pills-dashboard"
          aria-selected="false" :class="{ active: $route.path === '/home' }">
          <span class="material-icons-outlined"> home </span>
        </router-link>

        <router-link v-if="roleactif == 'ADMIN' ||
          roleactif == 'SUPERADMIN' ||
          roleactif == 'COURTIER' ||
          roleactif == 'COMMERCIAL'
          " to="/courtage" class="nav-link menu" title="Courtage" role="tab" aria-controls="v-pills-apps"
          aria-selected="false" :class="{ active: $route.path === '/courtage' }" :replace="true">
          <span class="material-icons-outlined"> dashboard </span>
        </router-link>

        <router-link v-if="roleactif == 'ADMIN' ||
          roleactif == 'SUPERADMIN' ||
          roleactif == 'RH'
          " to="/rh" class="nav-link menu" title="RH" role="tab" aria-controls="v-pills-apps" aria-selected="false"
          :class="{ active: $route.path === '/rh' }" :replace="true">
          <span class="material-icons-outlined"> people </span>
        </router-link>

        <router-link to="/statistique" class="nav-link menu" id="modulestat" title="Statistiques" role="tab"
          aria-controls="v-pills-apps" aria-selected="false" :class="{ active: $route.path === '/statistique' }"
          :replace="true">
          <span class="material-icons-outlined"> leaderboard </span>
        </router-link>

        <router-link v-if="roleactif == 'SUPERADMIN'
          " to="entreprise" class="nav-link menu" title="Settings" id="enterprise" role="tab" aria-selected="false"
          :class="{ active: $route.path === '/entreprise' }" :replace="true">
          <span class="material-icons-outlined"> settings </span>
        </router-link>
      </div>
    </div>
  </div>
</template>
<script>
import { getRoleActif } from "../services/roleservice";
export default {
  data() {
    return {
      isHovered: false,
      roleactif: ""
    };
  },
  async created() {
    await this.getRoleconnect();
  },
  methods: {
    async getRoleconnect() {
      this.roleactif = await getRoleActif();
    },
  }
};
</script>

<style scoped>
/* Improved styles for the hovered class and animation */
.material-icons-outlined {
  transition: transform 0.3s ease-in-out, color 0.3s ease-in-out;
}

.material-icons-outlined.hovered {
  transform: scale(1.1);
  color: #007bff;
  /* Change to your preferred color */
}
</style>