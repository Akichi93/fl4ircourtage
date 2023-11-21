<template>
  <div class="sidebar" id="sidebar">
    <div class="sidebar-left slimscroll">
      <div
        class="nav flex-column nav-pills"
        id="v-pills-tab"
        role="tablist"
        aria-orientation="vertical"
      >
        <router-link
          class="nav-link menu"
          to="/home"
          title="Accueil"
          role="tab"
          aria-controls="v-pills-dashboard"
          aria-selected="false"
          :class="{ active: $route.path === '/home' }"
        >
          <span class="material-icons-outlined"> home </span>
        </router-link>

        <router-link
          to="/courtage"
          class="nav-link menu"
          title="Courtage"
          role="tab"
          aria-controls="v-pills-apps"
          aria-selected="false"
          :class="{ active: $route.path === '/courtage' }"
        >
          <span class="material-icons-outlined"> dashboard </span>
        </router-link>

        <router-link
          to="/rh"
          class="nav-link menu"
          title="RH"
          role="tab"
          aria-controls="v-pills-apps"
          aria-selected="false"
          :class="{ active: $route.path === '/rh' }"
        >
          <span class="material-icons-outlined"> people </span>
        </router-link>

        <router-link
          to="/statistique"
          class="nav-link menu"
          id="modulestat"
          title="Statistiques"
          role="tab"
          aria-controls="v-pills-apps"
          aria-selected="false"
          :class="{ active: $route.path === '/statistique' }"
        >
          <span class="material-icons-outlined"> leaderboard </span>
        </router-link>

        <router-link
          to="entreprise"
          class="nav-link menu"
          title="Settings"
          id="enterprise"
          role="tab"
          aria-selected="false"
          :class="{ active: $route.path === '/entreprise' }"
        >
          <span class="material-icons-outlined"> settings </span>
        </router-link>
      </div>
    </div>
  </div>
</template>