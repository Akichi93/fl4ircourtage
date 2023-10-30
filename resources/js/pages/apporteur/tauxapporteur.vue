<template>
    <div class="main-wrapper">
        <Header />

        <Sidebar />
        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="page-head-box">
                            <h3>Listes des taux de l'apporteur <em>{{ names.nom_apporteur }}</em></h3>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/home">Tableau de bord</a></li>
                                    <li class="breadcrumb-item"><a href="/apporteur">Listes des apporteurs</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Taux apporteurs</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="row filter-row" v-if="branches.length > 0">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <div class="add-emp-section">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#add_taux"
                                class="btn btn-success btn-add-emp" style="width: auto;"><i class="fas fa-plus"></i> Ajouter
                                un taux
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <table class="table table-striped custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Nom de la branche</th>
                                        <th>Taux</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="apporteur in apporteurs" :key="apporteur.id_tauxapp">
                                        <tr>
                                            <td v-text="apporteur.nom_branche"></td>
                                            <td v-text="apporteur.taux"></td>
                                            <td class="text-end ico-sec d-flex justify-content-end">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#edit_taux"
                                                    @click="getTaux(apporteur.id_tauxapp)" title="Modifier"><i
                                                        class="fas fa-pen"></i>
                                                </a>


                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>

                        <addtauxapporteur></addtauxapporteur>
                        <edittauxapporteur v-bind:tauxtoedit="tauxtoedit"></edittauxapporteur>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Header from "../../layout/Header.vue";
import Sidebar from "../../layout/Sidebar.vue";
import { createToaster } from "@meforma/vue-toaster";
// import $ from "jquery";
const toaster = createToaster({
    /* options */
});
import addtauxapporteur from "./addtauxapporteur.vue";
import edittauxapporteur from "./edittauxapporteur.vue";
export default {
    name: "tauxapporteur",
    components: { Header, Sidebar, addtauxapporteur, edittauxapporteur },
    data() {
        return {
            value: null,
            apporteurs: "",
            tauxtoedit: "",
            names: "",
            branches: {},
            accidents: [],

            ids: [],
        };
    },
    methods: {
        getTaux(id_tauxapp) {
            axios
                .get("/api/auth/editTauxApporteur/" + id_tauxapp)
                .then((response) => (
                    this.tauxtoedit = response.data
                ))
                .catch((error) => console.log(error));
        },



        fetchTask() {
            this.error = this.names = null;
            this.loading = true;
            var that = this;
            axios
                .all([
                    axios.get(`/api/auth/getNameApporteur/${this.$route.params.id_apporteur}`),
                    axios.get(`/api/auth/getTauxApporteur/${this.$route.params.id_apporteur}`),
                    axios.get(`/api/auth/getBrancheDiffApporteur/${this.$route.params.id_apporteur}`),
                ])
                .then(
                    axios.spread(function (
                        names,
                        apporteurs,
                        branches

                    ) {
                        that.names = names.data;
                        that.apporteurs = apporteurs.data;
                        that.branches = branches.data;
                    })
                );
        },

        editTaux() {
            axios
                .post("updateTauxApporteur", {
                    id_tauxapp: this.tauxtoedit.id_tauxapp,
                    taux: this.tauxtoedit.taux,
                })
                .then((response) => {
                    this.getauto();

                    if (response.status === 200) {
                        toaster.success("Taux modifié", {
                            position: "top-right",
                        });
                    }
                });
        },

        addTaux() {
            let test = JSON.parse(JSON.stringify(this.branches));
            let donnees = [];

            for (let i = 0; i < Object.keys(test).length; i++) {
                donnees.push(test[i]["value"]);
            }

            let testing = JSON.parse(JSON.stringify(this.branches));
            let datas = [];

            for (let i = 0; i < Object.keys(testing).length; i++) {
                datas.push(testing[i]["id_branche"]);
            }
            axios
                .post("postTauxApporteur", {
                    name: this.names.nom_apporteur,
                    taux: this.tauxtoedit.taux,
                    accidents: donnees,
                    ids: datas,
                })
                .then((response) => {
                    this.getauto();
                    this.getbranche();
                    if (response.status === 200) {
                        toaster.success("Taux ajouté", {
                            position: "top-right",
                        });
                    }
                });
        },


    },
    created() {
        this.getTaux();
        this.fetchTask()
    },

};
</script>
  