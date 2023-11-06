<template>
    <div class="main-wrapper">
        <Header />

        <Sidebar />
        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="page-head-box">
                            <h3>Listes des taux de la compagnie <em>{{ names.nom_compagnie }}</em></h3>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/home">Tableau de bord</a></li>
                                    <li class="breadcrumb-item"><a href="/compagnie">Listes des compagnies</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Taux compagnies</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="row filter-row" v-if="branches.length > 0">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <div class="add-emp-section">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#create_project"
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
                                    <template v-for="compagnie in compagnies" :key="compagnie.id_tauxcomp">
                                        <tr>
                                            <td v-text="compagnie.nom_branche"></td>
                                            <td v-text="compagnie.tauxcomp"></td>
                                            <td class="text-end ico-sec d-flex justify-content-end">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#edit_tauxcompagnie"
                                                    @click="getTaux(compagnie.id_tauxcomp)" title="Modifier"><i
                                                        class="fas fa-pen"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <addtauxcompagnie v-bind:tauxcompagnietoedit="tauxcompagnietoedit" @tauxcompagnie-add="refresh"></addtauxcompagnie>
    <edittauxcompagnie v-bind:tauxtoedit="tauxtoedit" @tauxcompagnie-update="refresh"></edittauxcompagnie>

</template>
<script>
import Header from "../../layout/Header.vue";
import Sidebar from "../../layout/Sidebar.vue";
import { createToaster } from "@meforma/vue-toaster";
import addtauxcompagnie from "./addtauxcompagnie.vue";
import edittauxcompagnie from "./edittauxcompagnie.vue";
const toaster = createToaster({
    /* options */
});
export default {
    name: "tauxcompagnie",
    components: { Header, Sidebar, addtauxcompagnie, edittauxcompagnie },
    data() {
        return {
            value: null,
            compagnies: [],
            branches: [],
            tauxtoedit: "",
            names: "",
            tauxcompagnietoedit: ""
        };
    },
    methods: {
        getCompagnie() {
            axios
                .get(`/api/auth/getNameCompagnie/${this.$route.params.id_compagnie}`)
                .then((response) => (this.tauxcompagnietoedit = response.data))
                .catch((error) => console.log(error));
        },

        getTaux(id_tauxcomp) {
            axios
                .get("/api/auth/editTauxCompagnie/" + id_tauxcomp)
                .then((response) => (
                    this.tauxtoedit = response.data))
                .catch((error) => console.log(error));
        },

        fetchTask() {
            this.error = this.names = null;
            this.loading = true;
            var that = this;
            axios
                .all([
                    axios.get(
                        `/api/auth/getNameCompagnie/${this.$route.params.id_compagnie}`
                    ),
                    axios.get(
                        `/api/auth/getTauxCompagnie/${this.$route.params.id_compagnie}`
                    ),
                    axios.get(
                        `/api/auth/getBrancheDiffCompagnie/${this.$route.params.id_compagnie}`
                    ),
                ])
                .then(
                    axios.spread(function (names, compagnies, branches) {
                        that.names = names.data;
                        that.compagnies = compagnies.data;
                        that.branches = branches.data;
                    })
                );
        },
        refresh(compagnies) {
            this.compagnies = compagnies.data;
        },


    },
    created() {
        this.getCompagnie();
        this.getTaux();
        this.fetchTask();
    },
};
</script>
  