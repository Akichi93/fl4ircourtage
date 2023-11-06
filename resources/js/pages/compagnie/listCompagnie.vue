<template>
  <div class="main-wrapper">
    <Header />

    <Sidebar />
    <div class="page-wrapper">
      <div class="content container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="page-head-box">
              <h3>Compagnies</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="/home">Tableau de bord</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Compagnie
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
              <router-link
                to="createcompagnie"
                class="btn btn-success btn-add-emp"
                style="width: auto"
              ><i class="fa fa-plus"></i> Ajouter une compagnie</router-link>
             
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-row">
            <input
              type="text"
              class="form-control"
              placeholder="Rechercher une compagnie"
              v-model="q"
              @keyup="searchtask"
            />
          </div>
          <div class="col-md-12">
            <div class="table-responsive">
              <table
                class="table table-striped custom-table mb-0"
                cellspacing="0"
                cellpadding="1"
                border="1"
                width="300"
              >
                <thead>
                  <tr>
                    <th>Nom de la compagnie</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Adresse</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <template
                    v-for="compagnie in compagnies.data"
                    :key="compagnie.id_compagnie"
                  >
                    <tr>
                      <td v-text="compagnie.nom_compagnie"></td>
                      <td v-text="compagnie.email_compagnie"></td>
                      <td v-text="compagnie.contact_compagnie"></td>
                      <td v-text="compagnie.adresse_compagnie"></td>
                      <td class="text-end ico-sec d-flex justify-content-end">
                        <a
                          href="#"
                          @click="editRate(compagnie.id_compagnie)"
                          title="Modifier les taux"
                          ><i class="fa fa-pen-fancy"></i>
                        </a>
                        <a
                          href="#"
                          data-bs-toggle="modal"
                          data-bs-target="#edit_department"
                          @click="getCompagnie(compagnie.id_compagnie)"
                          title="Modifier"
                          ><i class="fas fa-pen"></i>
                        </a>
                        <a
                          v-if="roles == 'ADMIN'"
                          href="#"
                          data-bs-toggle="modal"
                          data-bs-target="#delete_compagnie"
                          @click="getCompagnie(compagnie.id_compagnie)"
                          title="supprimer"
                          ><i class="fas fa-trash-alt"></i>
                        </a>
                      </td>
                    </tr>
                  </template>
                </tbody>
              </table>
            </div>
            <!-- <Pagination
              align="center"
              :data="compagnies"
              :limit="5"
              :current_page="compagnies.current_page"
              :last_page="compagnies.last_page"
              @pagination-change-page="listcompagnie"
            /> -->
          </div>
        </div>
      </div>
    </div>
  </div>

  

  
</template>
<script>
import Header from "../../layout/Header.vue";
import Sidebar from "../../layout/Sidebar.vue";
import LaravelVuePagination from "laravel-vue-pagination";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({
  /* options */
});
export default {
  name: "compagnie",
  components: {
    Header,
    Sidebar,
    Pagination: LaravelVuePagination,
  },
  data() {
    return {
      value: null,
      compagnies: {},
      branches: {},
      localisations: {},
      nom_compagnie: "",
      contact_compagnie: "",
      email_compagnie: "",
      adresse_compagnie: "",
      compagniestoedit: "",
      roles: "",
    };
  },
  created() {
    this.fetchData();
    this.listcompagnie();
    this.getRole();
  },
  mounted() {
    this.fetchData();
    this.listcompagnie();
    this.getRole();
  },
  methods: {
    getCompagnie(id_compagnie) {
      axios
        .get("/editCompagnie/" + id_compagnie)
        .then((response) => (this.compagniestoedit = response.data))
        .catch((error) => console.log(error));
    },

    listcompagnie(page = 1) {
      axios.get("/compagnieList?page=" + page).then((response) => {
        this.compagnies = response.data;
      });
    },

    fetchData() {
      var that = this;
      axios
        .all([axios.get("/getLocalisations"), axios.get("/getBranches")])
        .then(
          axios.spread(function (localisations, branches) {
            that.localisations = localisations.data;
            that.branches = branches.data;
          })
        );
    },

    getRole() {
      axios
        .get("/getrole")
        .then((response) => {
          this.roles = response.data;
        })
        .catch((error) => console.log(error));
    },

    deleteCompagnie() {
      axios
        .patch("/deleteCompagnie/" + this.compagniestoedit.id_compagnie)
        .then((response) => {
          this.listcompagnie();
          if (response.status === 200) {
            toaster.success(`Compagnie supprimé avec succes`, {
              position: "top-right",
            });
          }
        })
        .catch((error) => console.log(error));
    },

    searchtask() {
      axios
        .get("/compagnieList/" + this.q)
        .then((response) => (this.compagnies = response.data))
        .catch((error) => console.log(error));
    },
  },
};
</script>

<style src="@vueform/multiselect/themes/default.css"></style>