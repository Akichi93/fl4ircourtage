<template>
  <div class="main-wrapper">
    <Header />

    <Sidebar />
    <div class="page-wrapper">
      <div class="content container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="page-head-box">
              <h3>Emissions - {{ contrats.nom_client }} - {{ contrats.numero_police }} - {{ contrats.nom_branche }}</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="/home">Tableau de bord</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Contrats
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>

        <div class="row filter-row">
          <div class="col-md-8"></div>
          <div class="col-md-4">
            <div class="add-emp-section">
              <a href="" class="btn btn-success btn-add-emp" data-bs-toggle="modal" data-bs-target="#add_avenant"
                style="width: auto"><i class="fas fa-plus"></i>
                Nouvelle emission
              </a>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-row">
            <input type="text" class="form-control" placeholder="Rechercher un avenant" v-model="q" @keyup="searchtask" />
          </div>
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-striped custom-table mb-0">
                <thead>
                  <tr>
                    <th>Type</th>
                    <th>Compagnie</th>
                    <th>Numéro police</th>
                    <th>Branche</th>
                    <th>Année</th>
                    <th>Mois</th>
                    <th>Prime TTC</th>
                    <th>Com courtier</th>
                    <th>Com apporteur</th>
                    <th>Date de saisie</th>
                    <th>Date d'effet</th>
                    <th>Date d'échéance</th>
                    <th>Solder</th>
                    <th>Reverser</th>
                    <th class="text-end">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <template v-for="avenant in avenants" :key="avenant.id_avenant">
                    <tr>
                      <td>{{ avenant.type }}</td>
                      <td>{{ avenant.nom_compagnie }}</td>
                      <td>{{ avenant.numero_police }}</td>
                      <td>{{ avenant.nom_branche }}</td>
                      <td>{{ avenant.annee }}</td>
                      <td>{{ avenant.mois }}</td>
                      <td>{{ avenant.prime_ttc }}</td>
                      <td>{{ avenant.commission_courtier }}</td>
                      <td>{{ avenant.commission }}</td>
                      <td>{{ avenant.date_emission }}</td>
                      <td>{{ avenant.date_debut }}</td>
                      <td>{{ avenant.date_fin }}</td>
                      <td v-if="avenant.solder == 0">
                        <span class="badge badge-pill bg-danger">NON</span>
                      </td>
                      <td v-else>
                        <span class="badge badge-pill bg-success">OUI</span>
                      </td>
                      <td v-if="avenant.reverser == 0">
                        <span class="badge badge-pill bg-danger">NON</span>
                      </td>
                      <td v-else>
                        <span class="badge badge-pill bg-success">OUI</span>
                      </td>
                      <td class="text-end ico-sec d-flex justify-content-end">

                        <a href="#" @click="editAvenant(avenant.id_avenant)" data-bs-toggle="modal"
                          data-bs-target="#add_file" title="Ajouter fichier"><i class="fas fa-plus"></i>
                        </a>

                        <a href="#" @click="fetchFile(avenant.id_avenant)" data-bs-toggle="modal"
                          data-bs-target="#assign_leader" title="Voir fichier"><i class="fas fa-file"></i>
                        </a>

                        <a href="#" @click="viewFacture(avenant.id_avenant)" data-bs-toggle="modal"
                          data-bs-target="#view_facture" title="Voir la facture">
                          <i class="fas fa-eye"></i>
                        </a>

                        <a href="#" @click="editAvenant(avenant.id_avenant)" data-bs-toggle="modal"
                          data-bs-target="#delete_avenant" title="Supprimer"><i class="fas fa-trash-alt"></i>
                        </a>

                        <a v-if="avenant.solder == 0" href="#" data-bs-toggle="modal" data-bs-target="#solder_contrat"
                          @click="editAvenant(avenant.id_avenant)" title="Solder"><i class="fas fa-balance-scale"></i>
                        </a>

                        <a v-if="avenant.solder == 1 && avenant.reverser == 0" href="#" data-bs-toggle="modal"
                          data-bs-target="#reverser_contrat" @click="editAvenant(avenant.id_avenant)" title="Reverser"><i
                            class="fa fa-times"></i>
                        </a>

                      </td>
                    </tr>
                  </template>
                </tbody>
              </table>
            </div>

            <addavenant @avenant-add="refresh"></addavenant>
            <!-- <editavenant v-bind:avenantoedit="avenantoedit"></editavenant> -->
            <soldercontrat v-bind:avenantoedit="avenantoedit" @avenant-solder="refresh"></soldercontrat>
            <reversercontrat v-bind:avenantoedit="avenantoedit" @avenant-reverser="refresh"></reversercontrat>
            <deleteavenant v-bind:avenantoedit="avenantoedit" @avenant-delete="refresh"></deleteavenant>
            <viewfacture v-bind:facturetoedit="facturetoedit"></viewfacture>
            <addfile v-bind:avenantoedit="avenantoedit"></addfile>
            <viewfile v-bind:filetoedit="filetoedit"></viewfile>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Header from "../../layout/Header.vue";
import Sidebar from "../../layout/Sidebar.vue";
import addavenant from "../contrat/addavenant.vue"
import soldercontrat from '../contrat/soldercontrat.vue';
import reversercontrat from '../contrat/reversercontrat.vue';
import deleteavenant from '../contrat/deleteavenant.vue';
import viewfacture from '../contrat/viewfacture.vue';
import addfile from '../contrat/addfile.vue';
import viewfile from '../contrat/viewfile.vue';
import AppStorage from "../../utils/helpers/AppStorage";
export default {
  components: {
    Header,
    Sidebar,
    addavenant,
    soldercontrat,
    reversercontrat,
    deleteavenant,
    viewfacture, 
    addfile,
    viewfile
  },

  data() {
    return {
      aveantoedit: "",
      avenants: {},
      id_contrat: "",
      contrats: {},
      avenantoedit: "",
      facturetoedit: "",
      filetoedit: []
    };
  },
  created() {
    this.fetchDataAvenant();
  },

  methods: {

    async fetchDataAvenant() {
      const uuidContrat = this.$route.params.uuidContrat;

      const avenants = await AppStorage.getAvenantsByUuidContrat(uuidContrat);

      this.avenants = avenants;
    },

    editAvenant(id_avenant) {
      axios
        .get("/api/auth/editAvenant/" + id_avenant)
        .then((response) => {
          this.avenantoedit = response.data;

          // this.form.id_avenant = response.data.id_avenant;
        })
        .catch((error) => console.log(error));
    },

    viewFacture(id_avenant) {
      axios
        .get("/api/auth/getFactures/" + id_avenant)
        .then((response) => {
          this.facturetoedit = response.data;
        })
        .catch((error) => console.log(error));
    },

    fetchFile(id_avenant) {
      axios
        .get("/api/auth/getFileAvenant/" + id_avenant)
        .then((response) => {
          this.filetoedit = response.data;
        })
        // .then((response) => console.log(response.data))
        .catch((error) => console.log(error));
    },

    // fetchTask() {
    //   var that = this;
    //   axios
    //     .all([
    //       axios.get(`/api/auth/getAvenantContrat/${this.$route.params.id_contrat}`),
    //       axios.get("/api/auth/getInfoAvenant/?contrat=" + this.$route.params.id_contrat),
    //     ])
    //     .then(
    //       axios.spread(function (avenants, contrats) {
    //         that.avenants = avenants.data;
    //         that.contrats = contrats.data;

    //       })
    //     );
    // },

    refresh(avenants) {
      this.avenants = avenants.data;
    }




  },
};
</script>
  