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
                  <li class="breadcrumb-item">
                    <a href="/home">Tableau de bord</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Prospect
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
                to="/createprospect"
                class="btn btn-success btn-add-emp"
                style="width: auto"
              >
                <i class="fas fa-plus"></i>Ajouter prospect</router-link
              >
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-row">
            <input
              type="text"
              class="form-control"
              placeholder="Rechercher un prospect"
              v-model="q"
              @keyup="searchtask"
            />
          </div>
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-striped custom-table mb-0">
                <thead>
                  <tr>
                    <th>Nom du prospect</th>
                    <th>Adresse</th>
                    <th>Contact</th>
                    <th>Etat</th>
                    <th>Profession</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <template
                    v-for="(prospect, index) in prospects.data"
                    :key="index"
                  >
                    <tr>
                      <td v-text="prospect.nom_prospect"></td>
                      <td v-text="prospect.adresse_prospect"></td>
                      <td v-text="prospect.tel_prospect"></td>
                      <td v-if="prospect.etat == 0">
                        <span class="badge badge-pill bg-danger">Prospect</span>
                      </td>
                      <td v-else>
                        <span class="badge badge-pill bg-success">Client</span>
                      </td>

                      <td v-text="prospect.profession_prospect"></td>
                      <td v-text="prospect.statut"></td>
                      <td class="text-end ico-sec d-flex justify-content-end">
                        <a
                          href="#"
                          v-if="prospect.etat == 0"
                          @click="editProspect(prospect.id_prospect)"
                          data-bs-toggle="modal"
                          data-bs-target="#delete_project"
                          title="Admettre comme un client"
                          ><i class="fas fa-check"></i>
                        </a>
                        <a
                          href="#"
                          data-bs-toggle="modal"
                          data-bs-target="#edit_department"
                          @click="editProspect(prospect.id_prospect)"
                          title="Modifier"
                          ><i class="fas fa-pen"></i>
                        </a>
                        <a
                          href="#"
                          data-bs-toggle="modal"
                          data-bs-target="#change_statut"
                          @click="editProspect(prospect.id_prospect)"
                          title="Changer d'etat"
                          ><i class="fas fa-edit"></i>
                        </a>

                        <a
                          href="#"
                          @click="viewprospect(prospect.id_prospect)"
                          title="Voir details"
                          ><i class="fas fa-eye"></i>
                        </a>
                        <a
                          href="#"
                          data-bs-toggle="modal"
                          data-bs-target="#delete_prospect"
                          @click="editProspect(prospect.id_prospect)"
                          title="Modifier"
                          ><i class="fas fa-trash-alt"></i>
                        </a>
                      </td>
                    </tr>
                  </template>
                </tbody>
              </table>
            </div>
            <admettreProspect
              v-bind:prospectoedit="prospectoedit"
              @compagnie-updated="refresh"
            ></admettreProspect>
            <editProspect
              v-bind:prospectoedit="prospectoedit"
              @compagnie-updated="refresh"
            ></editProspect>
            <changeProspect
              v-bind:prospectoedit="prospectoedit"
              @compagnie-updated="refresh"
            ></changeProspect>
            <deleteProspect
              v-bind:prospectoedit="prospectoedit"
              @compagnie-deleted="refresh"
            ></deleteProspect>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import pagination from "laravel-vue-pagination";
import Header from "../../layout/Header.vue";
import Sidebar from "../../layout/Sidebar.vue";
import { getProspectsList } from "../../services/prospectservice";
import admettreProspect from "./admettreProspect.vue";
import deleteProspect from "./deleteProspect.vue";
import editProspect from "./editProspect.vue";
import changeProspect from "./changeProspect.vue";
export default {
  name: "search",
  components: {
    Header,
    Sidebar,
    pagination,
    admettreProspect,
    deleteProspect,
    editProspect,
    changeProspect
  },
  data() {
    return {
      value: null,
      prospects: {},
      prospectoedit: "",
      q: "",
    };
  },
  created() {
    this.getProspects();
  },

  methods: {
    getProspects: function () {
      getProspectsList().then((result) => {
        this.prospects = result;
      });
    },
    editProspect(id_prospect) {
      axios
        .get("/api/auth/editProspect/" + id_prospect)
        .then((response) => {
          this.prospectoedit = response.data;
        })
        .catch((error) => console.log(error));
    },

    searchtask() {
      axios
        .get("/api/auth/prospectList/" + this.q)
        .then((response) => (this.prospects = response.data))
        .catch((error) => console.log(error));
    },
  },
};
</script>
  