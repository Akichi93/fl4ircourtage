<template>
    <div class="account-page">
        <div class="main-wrapper">
            <div class="account-content">
                <div class="container">

                    <div class="account-logo">
                        <a href=""><img src="" alt="Courtage"></a>
                    </div>

                    <div class="account-box">
                        <div class="account-wrapper">
                            <h3 class="account-title">Demande de compte</h3>
                            <form @submit.prevent="register">
                                <div class="input-block mb-4">
                                    <label>Nom de l'entreprise<span class="mandatory">*</span></label>
                                    <input class="form-control" type="text" v-model="form.nom">
                                </div>
                                <div class="input-block mb-4">
                                    <label>Email de l'entreprise<span class="mandatory">*</span></label>
                                    <input class="form-control" type="text" v-model="form.email">
                                </div>
                                <div class="input-block mb-4">
                                    <label>Contact de l'entreprise<span class="mandatory">*</span></label>
                                    <input class="form-control" type="text" v-model="form.contact">
                                </div>
                                <div class="form-group">
                                    <label>Situation géographique<span class="mandatory">*</span></label>
                                    <input class="form-control" type="text" id="adresse" v-model="form.adresse">
                                </div>
                                <div class="input-block mb-4 text-center">
                                    <button class="btn btn-primary account-btn" type="submit">Demande</button>
                                </div>
                            </form>
                            <div class="account-footer">
                                <p>J'ai déja un compte? <router-link to="/"> Se connecter</router-link></p>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { createToaster } from "@meforma/vue-toaster";
// import $ from "jquery";
const toaster = createToaster({
    /* options */
});
export default {
    data() {
        return {
            form: {
                name: '',
                email: '',
                contact: '',
                adresse: '',
            },
            errors: []
        }
    },
    methods: {
        register() {
            axios.post('/api/auth/post-registration', this.form)
                .then(res => {
                    toaster.success(`Entreprise ajouté avec succès. Votre dossier est en traitemaent`, {
                        position: "top-right",
                    });
                })
                .catch((error) => {
                    // console.log(error.response.headers);

                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                        // console.log(error.response.data.errors);
                        toaster.error(`Veuillez `, {
                            position: "top-right",
                        });

                        // console.log("Message non enregisté")
                    }


                    if (error.response.status === 423) {
                        this.errors = error.response.data.errors;
                        // console.log(error.response.data.errors);
                        toaster.error(`Entreprise existante`, {
                            position: "top-right",
                        });

                        // console.log("Message non enregisté")
                    }

                    // else if (error.request) {
                    //     // The request was made but no response was received
                    //     console.log(error.request);
                    // } else {
                    //     // Something happened in setting up the request that triggered an Error
                    //     console.log("Error", error.message);
                    // }
                });
        }
    }


}
</script>