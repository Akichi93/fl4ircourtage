<template>
    <div class="main-wrapper">
        <Header />

        <Sidebar />

        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Profile</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"> <router-link to="/home">Tableau de bord</router-link></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card mb-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="profile-view">
                                    <div class="profile-img-wrap">
                                        <div class="profile-img">
                                            <a href="#"><img src="" alt="User Image"></a>
                                        </div>
                                    </div>
                                    <div class="profile-basic">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="profile-info-left">
                                                    <h3 class="user-name m-t-0 mb-0" v-text="user.name"></h3>
                                                    <h6 class="text-muted">UI/UX Design Team</h6>

                                                    <div class="staff-msg"><a class="btn btn-custom"
                                                            data-bs-target="#profile_info" data-bs-toggle="modal">Changer
                                                            mot de passe
                                                        </a></div>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <ul class="personal-info">
                                                    <li>
                                                        <div class="title">Contact:</div>
                                                        <div class="text" v-text="user.contact"></div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Email:</div>
                                                        <div class="text" v-text="user.email"></div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Anniversaire:</div>
                                                        <div class="text" v-text="user.anniversaire"></div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Adresse:</div>
                                                        <div class="text" v-text="user.adresse"></div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Sexe:</div>
                                                        <div class="text" v-text="user.sexe"></div>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div id="profile_info" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Modification de mon mot de passe</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Mot de passe actuel</label>
                                            <input type="password" class="form-control" v-model="oldpassword">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Nouveau mot de passe</label>
                                            <input type="password" class="form-control" v-model="newpassword">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="input-block mb-3">
                                            <label class="col-form-label">Rétapez le nouveau mot de passe</label>
                                            <input type="password" class="form-control" v-model="confirmPassword"
                                                @input="validateForm">
                                        </div>
                                    </div>
                                    <p v-if="errorMessage" style="color:red">{{ errorMessage }}</p>




                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" @click="updatePassword">Modifier</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Header from "../../layout/Header";
import Sidebar from "../../layout/Sidebar";
import AppStorage from "../../utils/helpers/AppStorage";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({
  /* options */
});
export default {
    components: { Header, Sidebar },
    data() {
        return {
            loading: true,
            user: "",
            confirmPassword: "",
            newpassword: "",
            oldpassword: "",
            errorMessage: ''
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
                .get("/api/auth/me", { headers })
                .then((response) => (this.user = response.data))
                .catch((error) => console.log(error));
        },
        validateForm() {
            if (this.newpassword !== this.confirmPassword) {
                this.errorMessage = 'Passwords do not match';
                return false;
            }
            this.errorMessage = '';
            return true;
        },

        updatePassword() {
            const token = AppStorage.getToken();

            // Configurez les en-têtes de la requête
            const headers = {
                Authorization: "Bearer " + token,
                "x-access-token": token,
            };

            axios
                .post("/api/auth/changepassword", {
                    oldpassword: this.oldpassword,
                    newpassword: this.newpassword,
                }, { headers })
                .then((response) => {


                    toaster.success(`Mot de passe modifié avec succès`, {
                        position: "top-right",
                    });
                })
                .catch((error) => {
                    console.error('An error occurred:', error);
                    // console.log(error.response.headers);

                    // if (error.response.status === 422) {
                    //   this.errors = error.response.data.errors;
                    //   toaster.error(`Veuillez remplir les champs`, {
                    //     position: "top-right",
                    //   });
                    //   // console.log("Message non enregisté")
                    // } else if (error.request) {
                    //   // The request was made but no response was received
                    //   console.log(error.request);
                    // } else {
                    //   // Something happened in setting up the request that triggered an Error
                    //   console.log("Error", error.message);
                    // }
                });
        },
    },
    created() {
        this.info();
    },
}
</script>