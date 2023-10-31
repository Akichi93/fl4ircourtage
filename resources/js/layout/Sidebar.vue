<template>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-left slimscroll">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <router-link class="nav-link menu active" to="/home" id="home" role="tab" aria-controls="v-pills-dashboard"
                    aria-selected="true">
                    <span class="material-icons-outlined">
                        home
                    </span>
                </router-link>

                <router-link to="/courtage" class="nav-link menu" id="modulecourtage" title="Courtage" role="tab"
                    aria-controls="v-pills-apps" aria-selected="false">
                    <span class="material-icons-outlined">
                        dashboard
                    </span>
                </router-link>

                <router-link to="/rh" class="nav-link menu" id="modulerh" title="RH" role="tab" aria-controls="v-pills-apps"
                    aria-selected="false">
                    <span class="material-icons-outlined">
                        people
                    </span>
                </router-link>

                <router-link to="/statistiques" class="nav-link menu" id="modulestat" title="Statistiques" role="tab"
                    aria-controls="v-pills-apps" aria-selected="false">
                    <span class="material-icons-outlined">
                        leaderboard
                    </span>
                </router-link>



                <a class="nav-link menu" title="Settings" id="enterprise" href="" role="tab" aria-selected="true">
                    <span class="material-icons-outlined">
                        settings
                    </span>
                </a>



            </div>
        </div>

    </div>
</template>