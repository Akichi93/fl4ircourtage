<template>
    <div class="content container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="page-head-box">
                    <h3>Salaire</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home">Tableau de bord</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Salaire</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="row filter-row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <div class="add-emp-section">
                    <a href="/createsalary" class="btn btn-success btn-add-emp" style="width: auto;"><i class="fas fa-plus"></i>
                        Ajouter un salaire
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- <div class="col-row">
                <input type="text" class="form-control" placeholder="Rechercher un apporteur" v-model="q"
                    @keyup="searchtask" />
            </div> -->
            <div class="col-md-12">
                <div>
                    <table class="table table-striped custom-table mb-0">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Sexe</th>
                                <th>Secteur</th>
                                <th>Date de naissance</th>
                                <th>Date d'embauche</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="salarie in salaries" :key="salarie.id_salaire">
                                <tr>
                                    <td v-text="salarie.nom"></td>
                                    <td v-text="salarie.prenom"></td>
                                    <td v-text="salarie.sexe"></td>
                                    <td v-text="salarie.secteur"></td>
                                    <td v-text="salarie.date_naissance"></td>
                                    <td v-text="salarie.date_embauche"></td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
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
            salaries: {},
        };
    },
    created() {
        this.fetchData();
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            axios
                .get("/salaires")
                .then((response) => {
                    this.salaries = response.data;
                })
                .catch((error) => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
        },
    },
};
</script>
