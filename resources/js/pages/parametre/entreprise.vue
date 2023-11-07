<template>
    <div class="content container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="page-head-box">
                    <h3>Entreprises</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home">Tableau de bord</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Entreprises</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-row">
                <input type="text" class="form-control" placeholder="Rechercher une entreprise" v-model="q"
                    @keyup="searchtask" />
            </div>
            <div class="col-md-12">
                <div>
                    <table class="table table-striped custom-table mb-0">
                        <thead>
                            <tr>
                                <th>Nom de l'entreprise</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Situation géographique</th>
                                <th>Statut</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="entreprise in entreprises" :key="entreprise.id_entreprise">
                                <tr>
                                    <td v-text="entreprise.nom"></td>
                                    <td v-text="entreprise.email"></td>
                                    <td v-text="entreprise.contact"></td>
                                    <td v-text="entreprise.adresse"></td>
                                    <td v-if="entreprise.statut == 0">
                                        Encours
                                    </td>
                                    <td v-else-if="entreprise.statut == 1">
                                        Validé
                                    </td>
                                    <td v-else>
                                        Refusé
                                    </td>
                                    <td v-if="entreprise.statut == 0" class="text-end ico-sec d-flex justify-content-end">
                                        <a href="#" data-bs-toggle="modal" @click="getEntreprise(entreprise.id_entreprise)"
                                            title="Valider" data-bs-target="#edit_department"><i
                                                class="fas fa-check"></i></a>
                                        <a href="#" data-bs-toggle="modal" title="Refuser"
                                            data-bs-target="#edit_department"><i class="fas fa-close"></i></a>

                                    </td>
                                    <td v-if="entreprise.statut == 1">
                                        PAS D'ACTION
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>



    <div class="modal custom-modal fade" id="edit_department" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Valider l'entreprise</h3>
                        <p> Ëtes-vous sur de valider l'entreprise?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <input type="hidden" v-model="entreprisetoedit.id_entreprise" />
                            <input type="hidden" v-model="entreprisetoedit.nom" />
                            <input type="hidden" v-model="entreprisetoedit.contact" />
                            <input type="hidden" v-model="entreprisetoedit.adresse" />
                            <input type="hidden" v-model="entreprisetoedit.email" />
                            <div class="col-6">
                                <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary continue-btn"
                                    @click="editEntreprise">Valider</a>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0);" data-bs-dismiss="modal"
                                    class="btn btn-primary cancel-btn">Annuler</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
import Multiselect from "@vueform/multiselect";
import { createToaster } from "@meforma/vue-toaster";
// import $ from "jquery";
const toaster = createToaster({
    /* options */
});
export default {
    components: {
        Multiselect,
    },
    data() {
        return {
            entreprises: {},
            entreprisetoedit: ""
        };
    },
    created() {
        this.fetchData();
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        getEntreprise(id_entreprise) {
            axios
                .get("/entreprises/edit/" + id_entreprise)
                .then((response) => {
                    this.entreprisetoedit = response.data;
                    console.log(response.data)
                })
                // .then((response) => console.log(response.data))
                .catch((error) => console.log(error));
        },
        editEntreprise() {
            axios
                .patch("/entreprises/" + this.entreprisetoedit.id_entreprise, {
                    nom: this.entreprisetoedit.nom,
                    contact: this.entreprisetoedit.contact,
                    email: this.entreprisetoedit.email,
                    adresse: this.entreprisetoedit.adresse,
                })
                .then((response) => {
                    this.fetchData();
                    if (response.status === 200) {
                        toaster.success(`Nouvelle entreprise enregistré`, {
                            position: "top-right",
                        });
                    }
                    console.log(response.data);
                })
                .catch((error) => console.log(error));
        },

        fetchData() {
            var that = this;
            axios
                .all([
                    axios.get("entreprises"),
                ])
                .then(
                    axios.spread(function (entreprises) {
                        that.entreprises = entreprises.data;
                    })
                );
        },
    },
};
</script>
