<template>
  <div class="main-wrapper">
    <Header />

    <Sidebar />
    <div class="page-wrapper">
      <div class="content container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="page-head-box">
              <h3>Apporteurs</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="/home">Tableau de bord</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Apporteur
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
              <router-link to="/createapporteur" class="btn btn-success btn-add-emp" style="width: auto">
                Ajouter apporteur
              </router-link>
            </div>
          </div>
        </div>

        <div class="row">
          <searchbranche :placeholder="'Rechercher un apporteur'" v-model="q" @keyup="searchtask"></searchbranche>
          <div class="col-md-12">
            <div class="table-responsive">
              <table id="tbl_exporttable_to_xls" class="table table-striped custom-table mb-0">
                <thead>
                  <tr>
                    <th>Code</th>
                    <th>Nom et prenom de l'apporteur</th>
                    <th>Code postal</th>
                    <th>ville</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <template v-for="(apporteur, i) in apporteurs" :key="i">
                    <tr>
                      <td v-text="apporteur.code_apporteur"></td>
                      <td v-text="apporteur.nom_apporteur"></td>
                      <td v-text="apporteur.code_postal"></td>
                      <td v-text="apporteur.adresse_apporteur"></td>
                      <td v-text="apporteur.contact_apporteur"></td>
                      <td v-text="apporteur.email_apporteur"></td>
                      <td class="text-end ico-sec d-flex justify-content-end">
                        <router-link :to="{
                          name: 'tauxapporteur',
                          params: { id_apporteur: apporteur.id_apporteur },
                        }">
                        <i class="fa fa-pen-fancy"></i>
                        </router-link>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#edit_department"
                          @click="editApporteur(apporteur.id_apporteur)" title="Modifier"><i class="fas fa-pen"></i>
                        </a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#delete_apporteur"
                          @click="editApporteur(apporteur.id_apporteur)" title="supprimer"><i
                            class="fas fa-trash-alt"></i>
                        </a>
                      </td>
                    </tr>
                  </template>
                </tbody>
              </table>
            </div>
            <editApporteur v-bind:apporteurtoedit="apporteurtoedit"></editApporteur>
            <deleteApporteur v-bind:apporteurtoedit="apporteurtoedit"></deleteApporteur>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import LaravelVuePagination from "laravel-vue-pagination";
import Header from "../../layout/Header.vue";
import Sidebar from "../../layout/Sidebar.vue";
import searchbranche from "../../components/search/searchbranche.vue";
import { getApporteursList } from "../../services/apporteurservice";
import editApporteur from "./editApporteur.vue";
import deleteApporteur from "./deleteApporteur.vue";

export default {
  components: {
    Pagination: LaravelVuePagination,
    Header,
    Sidebar,
    searchbranche,
    editApporteur,
    deleteApporteur
  },
  data() {
    return {
      value: null,
      apporteurs: [],
      apporteurtoedit: "",
      q: "",

    };
  },
  created() {
   this.getApporteurs()
  },
  methods: {
    getApporteurs: function () {
      getApporteursList().then((result) => {
        this.apporteurs = result;
      });
    },

    editApporteur(id_apporteur) {
      axios
        .get("api/auth/editApporteur/" + id_apporteur)
        .then((response) => (this.apporteurtoedit = response.data))
        .catch((error) => console.log(error));
    },

    searchtask() {
      axios
        .get("/apporteurList/" + this.q)
        .then((response) => (this.apporteurs = response.data))
        .catch((error) => console.log(error));
    },
  },
};
</script>

<style scoped>
.pagination {
  margin-bottom: 0;
}

.curseur:hover {
  cursor: grab;
}
</style>

