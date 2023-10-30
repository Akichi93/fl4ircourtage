<template>
    <div class="header">

        <div class="header-left">
            <a href="/home" class="logo">
                <img src="" width="100" height="80" alt="">
            </a>
        </div>

        <div class="header-center">
            <h1>Courtage</h1>
        </div>
        <a id="toggle_btn" href="javascript:void(0);">
            <span class="bar-icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a>

        <ul class="header-new-menu">
            <li>
                <a href="#" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Courtages</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="">Contrats</a>
                    <a class="dropdown-item" href="">Sinistres</a>
                    <a class="dropdown-item" href="">Relances</a>
                    <a class="dropdown-item" href="">Compagnies</a>
                    <a class="dropdown-item" href="">Branches</a>
                    <a class="dropdown-item" href="">Apporteurs</a>
                    <a class="dropdown-item" href="">Prospects</a>
                    <a class="dropdown-item" href="">Clients</a>
                    <a class="dropdown-item" href="">Upload des bases</a>
                </div>
            </li>
            <li>
                <a href="#" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">RH</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="">Utilisateurs</a>
                    <a class="dropdown-item" href="">Salaires</a>
                    <a class="dropdown-item" href="">Dépenses</a>
                    <a class="dropdown-item" href="">Catégories dépenses</a>
                    <a class="dropdown-item" href="">Catégories types</a>
                    <a class="dropdown-item" href="">Types de depenses</a>
                </div>
            </li>
            <li>
                <a href="#" data-bs-toggle="dropdown" role="button" aria-haspopup="true"
                    aria-expanded="false">Statistiques</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="">Statistiques utilisateurs</a>
                    <a class="dropdown-item" href="">Statistiques clients</a>
                    <a class="dropdown-item" href="">Statistiques contrats</a>
                    <a class="dropdown-item" href="">Statistiques sinistres</a>
                    <a class="dropdown-item" href="">Statistiques dépenses</a>
                    <a class="dropdown-item" href="">Statistiques salariés</a>
                    <a class="dropdown-item" href="">Statistiques apporteurs</a>
                </div>
            </li>

        </ul>

        <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

        <ul class="nav user-menu">
            <li>
                <a href="#" class="report-btn">
                    <span class="material-icons-outlined">
                        text_snippet
                    </span>
                </a>
            </li>
            <li>

                <div class="page-title-box">
                    <div class="top-nav-search">
                        <a href="javascript:void(0);" class="responsive-search">
                            <i class="fa fa-search"></i>
                        </a>
                        <form action="search.html">

                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Recherche">
                                <button class="btn btn-outline-secondary" type="button">
                                    <span class="material-icons-outlined">
                                        search
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </li>

            <li class="nav-item dropdown">
                <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                    <i class="far fa-bell"></i> <span class="badge rounded-pill">3</span>
                </a>
                <div class="dropdown-menu notifications">
                    <div class="topnav-dropdown-header">
                        <span class="notification-title">Notifications</span>
                        <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                    </div>
                    <div class="noti-content">
                        <ul class="notification-list">
                            <li class="notification-message">
                                <a href="activities.html">
                                    <div class="media d-flex">
                                        <span class="avatar flex-shrink-0">
                                            <img alt="" src="assets/img/profiles/avatar-02.jpg">
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details"><span class="noti-title">John Doe</span> added
                                                new task <span class="noti-title">Patient appointment booking</span>
                                            </p>
                                            <p class="noti-time"><span class="notification-time">4 mins ago</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="notification-message">
                                <a href="activities.html">
                                    <div class="media d-flex">
                                        <span class="avatar flex-shrink-0">
                                            <img alt="" src="assets/img/profiles/avatar-03.jpg">
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details"><span class="noti-title">Tarah Shropshire</span>
                                                changed the task name <span class="noti-title">Appointment booking
                                                    with payment gateway</span></p>
                                            <p class="noti-time"><span class="notification-time">6 mins ago</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="notification-message">
                                <a href="activities.html">
                                    <div class="media d-flex">
                                        <span class="avatar flex-shrink-0">
                                            <img alt="" src="assets/img/profiles/avatar-06.jpg">
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details"><span class="noti-title">Misty Tison</span>
                                                added <span class="noti-title">Domenic Houston</span> and <span
                                                    class="noti-title">Claire Mapes</span> to project <span
                                                    class="noti-title">Doctor available module</span></p>
                                            <p class="noti-time"><span class="notification-time">8 mins ago</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="notification-message">
                                <a href="activities.html">
                                    <div class="media d-flex">
                                        <span class="avatar flex-shrink-0">
                                            <img alt="" src="assets/img/profiles/avatar-17.jpg">
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details"><span class="noti-title">Rolland Webber</span>
                                                completed task <span class="noti-title">Patient and Doctor video
                                                    conferencing</span></p>
                                            <p class="noti-time"><span class="notification-time">12 mins ago</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="notification-message">
                                <a href="activities.html">
                                    <div class="media d-flex">
                                        <span class="avatar flex-shrink-0">
                                            <img alt="" src="assets/img/profiles/avatar-13.jpg">
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details"><span class="noti-title">Bernardo Galaviz</span>
                                                added new task <span class="noti-title">Private chat module</span>
                                            </p>
                                            <p class="noti-time"><span class="notification-time">2 days ago</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="activities.html">View all Notifications</a>
                    </div>
                </div>
            </li>


            <li class="nav-item dropdown has-arrow main-drop">
                <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                    <span class="user-img"><img src="assets/img/profiles/avatar-21.jpg" alt></span>
                    <span>{{ user.name }}</span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="profile.html">Mon profile</a>
                    <a class="dropdown-item" href="settings.html">Parametre</a>
                    <router-link to="/logout" class="dropdown-item">Se deconnecter</router-link>
                </div>
            </li>
        </ul>


        <div class="dropdown mobile-user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i
                    class="fa fa-ellipsis-v"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="profile.html">Mon profile</a>
                <router-link to="/logout" class="dropdown-item">Se deconnecter</router-link>

            </div>
        </div>

    </div>
</template>
<script>
export default {
    data() {
        return {
            loading: true,
            user: '',
            error: null,
        };
    },
    methods: {
        info() {
            const token = localStorage.getItem("token");

            // Configurez les en-têtes de la requête
            const headers = {
                Authorization: "Bearer " + token,
                "x-access-token": token,
            };

            axios
                .get("/api/auth/me" , { headers })
                .then((response) => (
                    this.user = response.data))
                .catch((error) => console.log(error));
        },

        logout() {
            localStorage.removeItem('token');
            localStorage.removeItem('user');
            axios.post('/api/auth/logout').then(() => {
                this.$router.push({ name: "welcome" });
            })
        }
    },
    created() {
        this.info()
    },
    name: "Header"
}
</script>

<style scoped></style>



