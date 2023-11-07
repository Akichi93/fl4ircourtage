<template>
    <div class="main-wrapper">

        <Header />

        <Sidebar />

        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="page-head-box">
                            <h3>Prospects</h3>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/home">Tableau de bord</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Prospects</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-0">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Création de prospect</h4>
                            </div>
                            <div class="card-body">
                                <form action="#">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Civilité:</label>
                                                <civilitecomponent :placeholder="'selectionnez une civilité'"
                                                    v-model="civilite"></civilitecomponent>

                                                <p style="color: red" class="text-red" v-if="errors.civilite"
                                                    v-text="errors.civilite[0]">
                                                </p>
                                            </div>
                                            <div class="form-group">
                                                <label>Boite postale:</label>
                                                <inputText :placeholder="'Entrez la boîte postal du prospect'"
                                                    v-model="postal_prospect"></inputText>
                                                <p style="color: red" class="text-red" v-if="errors.postal_prospect"
                                                    v-text="errors.postal_prospect[0]"></p>
                                            </div>
                                            <div class="form-group">
                                                <label>Téléphone:</label>
                                                <inputText :placeholder="'Entrez le numéro de téléphone du prospect'"
                                                    v-model="tel_prospect"></inputText>
                                                <p style="color: red" class="text-red" v-if="errors.tel_prospect"
                                                    v-text="errors.tel_prospect[0]"></p>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Etat:</label>
                                                        <etatcomponent :placeholder="'selectionnez un état'"
                                                            v-model="etats"></etatcomponent>
                                                        <p style="color: red" class="text-red" v-if="errors.etat"
                                                            v-text="errors.etat[0]">
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-9 adresse">
                                                    <div class="form-group">
                                                        <label>Adresse</label>
                                                        <adressecomponent :placeholder="'selectionnez l\'adresse'"
                                                            v-model="adresse_prospect"></adressecomponent>
                                                        <p style="color: red" class="text-red"
                                                            v-if="errors.adresse_prospect"
                                                            v-text="errors.adresse_prospect[0]"></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 ajout">
                                                    <div class="form-group">
                                                        <button type="button" style="margin-top: 25px"
                                                            class="btn btn-primary">
                                                            Ajouter
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form1" style="display: none">
                                                    <div class="form-group">

                                                        <label>Adresse</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Entrez une nouvelle adresse"
                                                            v-model="ajout_adresse" />

                                                    </div>
                                                </div>
                                                <div class="col-md-3 form2" style="display: none">

                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-primary"
                                                            style="margin-top: 25px" @click="storeAdresse">
                                                            Ajouter
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Nom complet du prospect:</label>
                                                        <inputText :placeholder="'Entrez le nom complet'"
                                                            v-model="nom_prospect"></inputText>
                                                        <p style="color: red" class="text-red" v-if="errors.nom_prospect"
                                                            v-text="errors.nom_prospect[0]"></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Fax:</label>
                                                        <inputText :placeholder="'Entrez le fax du prospect'"
                                                            v-model="fax_prospect"></inputText>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Email:</label>
                                                        <inputText :placeholder="'Entrez l\'email du prospect'"
                                                            v-model="email_prospect"></inputText>
                                                        <p style="color: red" class="text-red" v-if="errors.email_prospect"
                                                            v-text="errors.email_prospect[0]"></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-9 profession">
                                                    <div class="form-group">
                                                        <label>Profession:</label>
                                                        <professioncomponent :placeholder="'selectionnez une profession'"
                                                            v-model="profession_prospect"></professioncomponent>
                                                        <p style="color: red" class="text-red"
                                                            v-if="errors.profession_prospect"
                                                            v-text="errors.profession_prospect[0]"></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 ajouter">
                                                    <div class="form-group">
                                                        <button type="button" style="margin-top: 25px"
                                                            class="btn btn-primary">
                                                            Ajouter
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 form3" style="display: none">
                                                    <div>
                                                        <label>Profession</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Entrez une nouvelle profession"
                                                            v-model="ajout_profession" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3 form4" style="display: none">
                                                    <div>
                                                        <button type="button" class="btn btn-primary"
                                                            style="margin-top: 25px" @click="storeProfession">
                                                            Ajouter
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button type="button" class="btn btn-primary"
                                            @click="storeProspect">Enregistrer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Header from "../../layout/Header.vue"
import Sidebar from "../../layout/Sidebar.vue";
import adressecomponent from "../../components/select/adressecomponent.vue";
import professioncomponent from "../../components/select/professioncomponent.vue";
import civilitecomponent from "../../components/select/civilitecomponent.vue";
import etatcomponent from "../../components/select/etatcomponent.vue";
import inputText from "../../components/input/inputText.vue";

import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({
    /* options */
});

export default {
    name: "createProspect",
    components: {
        Header, Sidebar, adressecomponent, professioncomponent, civilitecomponent, etatcomponent, inputText
    },
    data() {
        return {
            value: null,
            civilite: "",
            etat: "",
            nom_prospect: "",
            tel_prospect: "",
            postal_prospect: "",
            email_prospect: "",
            adresse_prospect: "",
            fax_prospect: "",
            ajout_adresse: "",
            ajout_profession: "",
            profession_prospect: "",
            prospectoedit: "",
            errors: {}
        };
    },
    created() {
        this.fetchTask();
    },
    mounted() {
        this.fetchTask();
    },
    methods: {
        storeProspect() {

            const token = localStorage.getItem("token");
            const userId = localStorage.getItem("id");
            const entrepriseId = localStorage.getItem("entreprise");

            axios
                .post("/api/auth/postProspect", {
                    civilite: this.civilite,
                    nom_prospect: this.nom_prospect,
                    postal_prospect: this.postal_prospect,
                    adresse_prospect: this.adresse_prospect,
                    tel_prospect: this.tel_prospect,
                    profession_prospect: this.profession_prospect,
                    email_prospect: this.email_prospect,
                    fax_prospect: this.fax_prospect,
                    etat: this.etat,
                    id_entreprise: entrepriseId,
                    id: userId,
                })
                .then((response) => {
                    if (response.status === 200) {
                        toaster.success(`Prospect ajouté avec succès`, {
                            position: "top-right",
                        });
                    }
                    window.location.href = "/prospect";
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    } else if (error.request) {
                        // The request was made but no response was received
                        console.log(error.request);
                    } else {
                        // Something happened in setting up the request that triggered an Error
                        console.log("Error", error.message);
                    }
                });
        },

        storeAdresse() {
            axios
                .post("/postLocalisations", {
                    ajout_adresse: this.ajout_adresse,
                })
                .then((response) => {
                    this.ajout_adresse = '';
                    if (response.status === 200) {
                        toaster.success(`Adresse ajouté avec succès`, {
                            position: "top-right",
                        });
                    }
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    } else if (error.request) {
                        // The request was made but no response was received
                        console.log(error.request);
                    } else {
                        // Something happened in setting up the request that triggered an Error
                        console.log("Error", error.message);
                    }
                });
        },

        storeProfession() {
            axios
                .post("/postProfessions", {
                    ajout_profession: this.ajout_profession,
                })
                .then((response) => {
                    this.fetchTask();
                    this.ajout_profession = '';
                    if (response.status === 200) {
                        toaster.success(`Profession ajouté avec succès`, {
                            position: "top-right",
                        });
                    }
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    } else if (error.request) {
                        // The request was made but no response was received
                        console.log(error.request);
                    } else {
                        // Something happened in setting up the request that triggered an Error
                        console.log("Error", error.message);
                    }
                });
        },

        fetchTask() {
            var that = this;
            axios
                .all([
                    axios.get("/getLocalisations"),
                    axios.get("/getProfessions"),
                ])
                .then(
                    axios.spread(function (localisations, professions) {
                        that.localisations = localisations.data;
                        that.professions = professions.data;
                    })
                );
        },
    },
};
</script>
  
<style src="@vueform/multiselect/themes/default.css"></style>