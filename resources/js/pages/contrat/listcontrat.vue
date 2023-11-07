<template>
  <div class="main-wrapper">
    <Header />

    <Sidebar />
    <div class="page-wrapper">
      <div class="content container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="page-head-box">
              <h3>Contrats</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="/home">Tableau de bord</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Contrat
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
              <router-link to="/createcontrat" class="btn btn-success btn-add-emp"
                style="width: auto"><i class="fas fa-plus"></i>
                Ajouter contrat</router-link>
             
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-row">
            <input
              type="text"
              class="form-control"
              placeholder="Rechercher un contrat"
              v-model="q"
              @keyup="searchtask"
            />
          </div>
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-striped custom-table mb-0">
                <thead>
                  <tr>
                    <th>Code du client</th>
                    <th>Nom du client</th>
                    <th>Compagnie</th>
                    <th>Branche</th>
                    <th>Date d'effet</th>
                    <th>Date d'échéance</th>
                    <!-- <th>Solde</th>
                  <th>Reverse</th> -->
                    <th class="text-end">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <template
                    v-for="contrat in contrats.data"
                    :key="contrat.id_contrat"
                  >
                    <tr>
                      <td v-text="contrat.numero_client"></td>
                      <td v-text="contrat.nom_client"></td>
                      <td v-text="contrat.nom_compagnie"></td>
                      <td v-text="contrat.nom_branche"></td>
                      <td v-text="contrat.effet_police"></td>
                      <td v-text="contrat.expire_le"></td>
                      <!-- <td v-if="contrat.solde == 0">
                      <span class="badge badge-pill bg-danger">NON</span>
                    </td>
                    <td v-else>
                      <span class="badge badge-pill bg-success">OUI</span>
                    </td>
                    <td v-if="contrat.reverse == 0">
                      <span class="badge badge-pill bg-danger">NON</span>
                    </td>
                    <td v-else>
                      <span class="badge badge-pill bg-success">OUI</span>
                    </td> -->
                      <td class="text-end ico-sec d-flex justify-content-end">
                        <a
                          href="#"
                          @click="modifcontrat(contrat.id_contrat)"
                          title="Modifier"
                          ><i class="fas fa-pen"></i>
                        </a>
                        <a
                          href="#"
                          @click="addAuto(contrat.id_contrat)"
                          title="Détails"
                          ><i class="fas fa-info"></i>
                        </a>
                        <a
                          href="#"
                          data-bs-toggle="modal"
                          data-bs-target="#edit_department"
                          @click="addAvenant(contrat.id_contrat)"
                          title="Emission"
                          ><i class="fas fa-paper-plane"></i>
                        </a>
                        <!-- <a v-if="contrat.solde == 0" href="#" data-bs-toggle="modal" data-bs-target="#solder_contrat"
                        @click="getContrat(contrat.id_contrat)" title="Solder"><i class="fas fa-balance-scale"></i>
                      </a>
                      <a v-if="contrat.solde == 1 && contrat.reverse == 0" href="#" data-bs-toggle="modal"
                        data-bs-target="#reverser_contrat" @click="getContrat(contrat.id_contrat)" title="Reverser"><i
                          class="fa fa-times"></i>
                      </a> -->

                        <a
                          href="#"
                          @click="getContrat(contrat.id_contrat)"
                          data-bs-toggle="modal"
                          data-bs-target="#delete_contrat"
                          title="Supprimer"
                          ><i class="fas fa-trash-alt"></i>
                        </a>
                      </td>
                    </tr>
                  </template>
                </tbody>
              </table>
            </div>

            <pagination
              align="center"
              :data="contrats"
              :limit="5"
              :current_page="contrats.current_page"
              :last_page="contrats.last_page"
              @pagination-change-page="listcontrat"
            >
            </pagination>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal custom-modal fade" id="solder_contrat" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <div class="form-header">
            <h3>Solder contrat</h3>
            <p>Le contrat est il solde ?</p>
          </div>
          <div class="modal-btn delete-action">
            <div class="row">
              <input
                type="hidden"
                class="form-control"
                v-model="contrattoedit.id_contrat"
              />
              <div class="col-6">
                <a
                  href="javascript:void(0);"
                  data-bs-dismiss="modal"
                  class="btn btn-primary continue-btn"
                  @click="ChangeSolde"
                  >Solder</a
                >
              </div>
              <div class="col-6">
                <a
                  href="javascript:void(0);"
                  data-bs-dismiss="modal"
                  class="btn btn-primary cancel-btn"
                  >Annuler</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal custom-modal fade" id="reverser_contrat" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <div class="form-header">
            <h3>Reverser contrat</h3>
            <p>Le contrat est il reversé ?</p>
          </div>
          <div class="modal-btn delete-action">
            <div class="row">
              <input
                type="hidden"
                class="form-control"
                v-model="contrattoedit.id_contrat"
              />
              <div class="col-6">
                <a
                  href="javascript:void(0);"
                  data-bs-dismiss="modal"
                  class="btn btn-primary continue-btn"
                  @click="ChangeReverse"
                  >Reverser</a
                >
              </div>
              <div class="col-6">
                <a
                  href="javascript:void(0);"
                  data-bs-dismiss="modal"
                  class="btn btn-primary cancel-btn"
                  >Annuler</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal custom-modal fade" id="delete_contrat" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <div class="form-header">
            <h3>Supprimer contrat</h3>
            <p>Voulez vous supprimer le contrat?</p>
          </div>
          <div class="modal-btn delete-action">
            <div class="row">
              <div class="col-6">
                <a
                  href="javascript:void(0);"
                  class="btn btn-primary continue-btn"
                  data-bs-dismiss="modal"
                  @click="deleteContrat"
                  >supprimer</a
                >
              </div>
              <div class="col-6">
                <a
                  href="javascript:void(0);"
                  data-bs-dismiss="modal"
                  class="btn btn-primary cancel-btn"
                  >Annuler</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
  <script>
import Header from "../../layout/Header.vue";
import Sidebar from "../../layout/Sidebar.vue";
import Multiselect from "@vueform/multiselect";
import { createToaster } from "@meforma/vue-toaster";
// import $ from "jquery";
const toaster = createToaster({
  /* options */
});
import Form from "vform";
import { HasError } from "vform/src/components/bootstrap5";
export default {
  components: {
    Multiselect,
    HasError,
    Header,
    Sidebar,
  },
  data() {
    return {
      form: Form.make({
        id_contrat: "",
        titre: "",
        file: null,
      }),
      value: null,
      filename: "",
      file: "",
      success: "",
      contrats: {},
      compagnies: {},
      contrattoedit: "",
      q: "",
      roles: "",
    };
  },
  created() {
    this.listcontrat();
    this.getRole();
  },
  mounted() {
    this.listcontrat();
    this.getRole();
  },
  methods: {
    getContrat(id_contrat) {
      axios
        .get("/editContrat/" + id_contrat)
        .then((response) => {
          this.contrattoedit = response.data;
          this.form.id_contrat = response.data.id_contrat;
        })
        .catch((error) => console.log(error));
    },

    listcontrat(page = 1) {
      axios.get("/contratList?page=" + page).then((response) => {
        this.contrats = response.data;
      });
    },

    getRole() {
      axios
        .get("/getrole")
        .then((response) => {
          this.roles = response.data;
        })
        .catch((error) => console.log(error));
    },

    modifcontrat(id) {
      window.location.href = "/modifcontrat?contrat=" + id;
    },

    addAuto(id) {
      window.location.href = "/addauto?contrat=" + id;
    },

    voirAuto(id) {
      window.location.href = "/voirauto?contrat=" + id;
    },

    addAvenant(id) {
      window.location.href = "/addavenant?contrat=" + id;
    },

    searchtask() {
      axios
        .get("/contratList/" + this.q)
        .then((response) => (this.contrats = response.data))
        .catch((error) => console.log(error));
    },

    handleFile(event) {
      // We'll grab just the first file...
      // You can also do some client side validation here.
      const file = event.target.files[0];

      // Set the file object onto the form...
      this.form.file = file;
    },

    async submit() {
      const response = await this.form.post("/add/avenant", {}).then((res) => {
        if (res.status === 200) {
          toaster.success(`Avenant ajouté avec succès`, {
            position: "top-right",
          });
          this.clients = res.data;
          this.form.reset();
        }
      });
    },

    ChangeSolde() {
      axios
        .post("/soldeContrat", {
          id_contrat: this.contrattoedit.id_contrat,
        })
        .then((response) => {
          this.listcontrat();
          if (response.status === 200) {
            toaster.success(`Contrat solde`, {
              position: "top-right",
            });
          }
        });
    },

    ChangeReverse() {
      axios
        .post("/reverseContrat", {
          id_contrat: this.contrattoedit.id_contrat,
        })
        .then((response) => {
          this.listcontrat();
          if (response.status === 200) {
            toaster.success(`Solde reverse`, {
              position: "top-right",
            });
            // this.prospects = response.data;
            // this.fetchTask();
          }
        });
    },

    deleteContrat() {
      axios
        .patch("/deleteContrat/" + this.contrattoedit.id_contrat)
        .then((response) => {
          this.listcontrat();
          if (response.status === 200) {
            toaster.success(`Contrat supprimé avec succes`, {
              position: "top-right",
            });
          }
        })
        .catch((error) => console.log(error));
    },
  },
};
</script>
  
  <style src="@vueform/multiselect/themes/default.css"></style>
  