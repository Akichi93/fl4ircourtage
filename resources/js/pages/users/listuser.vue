<template>
    <div class="content container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="page-head-box">
            <h3>Utilisateurs</h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="/home">Tableau de bord</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  Utilisateurs
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
            <a
              href="#"
              data-bs-toggle="modal"
              data-bs-target="#add_department"
              class="btn btn-success btn-add-emp"
              style="width: auto"
              ><i class="fas fa-plus"></i>
              Ajouter utilisateur
            </a>
          </div>
        </div>
      </div>
  
      <div class="row">
        <div class="col-row">
          <input
            type="text"
            class="form-control"
            placeholder="Rechercher un utilisateur"
            v-model="q"
            @keyup="searchtask"
          />
        </div>
        <div class="col-md-12">
          <div>
            <table class="table table-striped custom-table mb-0">
              <thead>
                <tr>
                  <th>Nom</th>
                  <th>Contact</th>
                  <th>Email</th>
                  <th>Adresse</th>
                  <th>Rôle</th>
                  <th class="text-end">Actions</th>
                </tr>
              </thead>
              <tbody>
                <template v-for="user in users" :key="user.id">
                  <tr>
                    <td>{{ user.name }}</td>
                    <td>{{ user.contact }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.adresse }}</td>
                    <td>
                      <span class="badge badge-pill bg-success">{{
                        user.nom_role
                      }}</span>
                    </td>
                    <td class="text-end ico-sec d-flex justify-content-end">
                      <a
                        href="#"
                        data-bs-toggle="modal"
                        data-bs-target="#edit_department"
                        title="Modifier"
                        @click="getUser(user.id)"
                        ><i class="fas fa-pen"></i>
                      </a>
                      <a
                        href="#"
                        @click="viewusers(user.id)"
                        title="Voir les détails"
                        ><i class="fas fa-eye"></i>
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
  
    <div id="add_department" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Ajouter utilisateur</h5>
            <button
              type="button"
              class="close"
              data-bs-dismiss="modal"
              aria-label="Close"
            >
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Nom complet de l'utilisateur</label>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Entrez le nom de l'utilisateur"
                      v-model="name"
                      required
                    />
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Telephone</label>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Numéro de téléphone"
                      v-model="contact"
                      required
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Adresse</label>
                    <Multiselect
                      v-model="adresse"
                      :options="localisations"
                      :custom-label="
                        ({ id_localisation, nom_ville }) =>
                          `${id_localisation} - [${nom_ville}]`
                      "
                      valueProp="nom_ville"
                      placeholder="Selectionnez zone"
                      label="nom_ville"
                      track-by="nom_ville"
                      :searchable="true"
                    >
                    </Multiselect>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Email</label>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Email de l'utilisateur"
                      v-model="email"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Rôle</label>
                    <Multiselect
                      v-model="poste"
                      :options="roles"
                      :custom-label="
                        ({ id_role, nom_role }) => `${id_role} - [${nom_role}]`
                      "
                      valueProp="id_role"
                      placeholder="Selectionnez rôle"
                      label="nom_role"
                      track-by="nom_role"
                      :searchable="true"
                    >
                    </Multiselect>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Mot de passe</label>
                <input type="text" class="form-control" v-model="password" />
              </div>
              <div class="submit-section">
                <button
                  class="btn btn-primary cancel-btn"
                  type="button"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                >
                  Annuler
                </button>
                <button
                  class="btn btn-primary submit-btn"
                  type="button"
                  data-bs-dismiss="modal"
                  @click="storeUser"
                >
                  Ajouter
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  
    <div id="edit_department" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modifier utilisateur</h5>
            <button
              type="button"
              class="close"
              data-bs-dismiss="modal"
              aria-label="Close"
            >
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Nom</label>
                    <input
                      class="form-control"
                      type="text"
                      v-model="userstoedit.name"
                    />
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Email</label>
                    <input
                      class="form-control"
                      type="text"
                      v-model="userstoedit.email"
                    />
                  </div>
                </div>
              </div>
  
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Contact</label>
                    <input
                      class="form-control"
                      type="text"
                      v-model="userstoedit.contact"
                    />
                  </div>
                </div>
              </div>
              <div class="submit-section">
                <button
                  class="btn btn-primary cancel-btn"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                >
                  Annuler
                </button>
                <button
                  class="btn btn-primary submit-btn"
                  type="button"
                  data-bs-dismiss="modal"
                  @click="editUser"
                >
                  Modifier
                </button>
              </div>
            </form>
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
        value: null,
        users: {},
        localisations: {},
        roles: {},
        name: "",
        email: "",
        poste: "",
        password: "",
        contact: "",
        adresse: "",
        ajout_adresse: "",
        userstoedit: "",
      };
    },
    created() {
      this.fetchData();
    },
    mounted() {
      this.fetchData();
    },
    methods: {
      getUser(id) {
        axios
          .get("/utilisateurs/edit/" + id)
          .then((response) => (this.userstoedit = response.data))
          .catch((error) => console.log(error));
      },
      storeUser() {
        axios
          .post("/utilisateurs", {
            name: this.name,
            email: this.email,
            password: this.password,
            contact: this.contact,
            adresse: this.adresse,
            id_role: this.poste,
          })
          .then((response) => {
            this.fetchData();
            this.name = this.email = this.contact = this.adresse = "";
            // if (response.status === 200) {
            toaster.success(`Nouvel utilisateur enregistré`, {
              position: "top-right",
            });
            // }
            console.log(response.data);
          })
          .catch((error) => {
            // console.log(error.response.headers);
  
            if (error.response.status === 422) {
              this.errors = error.response.data.errors;
              toaster.error(`Veuillez remplir les champs`, {
                position: "top-right",
              });
            } else if (error.request) {
              // The request was made but no response was received
              console.log(error.request);
            } else {
              // Something happened in setting up the request that triggered an Error
              console.log("Error", error.message);
            }
          });
      },
  
      viewusers(id) {
        window.location.href = "/viewusers?user=" + id;
      },
      storeAdresse() {
        axios
          .post("/postLocalisations", {
            ajout_adresse: this.ajout_adresse,
          })
          .then((response) => {
            this.fetchData();
            if (response.status === 200) {
              toaster.success(`Nouvelle adresse enregistré`, {
                position: "top-right",
              });
            }
          })
          .catch((error) => {
            // console.log(error.response.headers);
  
            if (error.response.status === 422) {
              toaster.error(`Adresse existante`, {
                position: "top-right",
              });
              this.errors = error.response.data.errors;
              // console.log("Message non enregisté")
            } else if (error.request) {
              // The request was made but no response was received
              console.log(error.request);
            } else {
              // Something happened in setting up the request that triggered an Error
              console.log("Error", error.message);
            }
          });
      },
  
      editUser() {
        axios
          .patch("/utilisateurs/" + this.userstoedit.id, {
            name: this.userstoedit.name,
            email: this.userstoedit.email,
            contact: this.userstoedit.contact,
          })
          .then((response) => {
            this.fetchData();
            if (response.status === 200) {
              toaster.success(`Utilisateur modifié avec succès`, {
                position: "top-right",
              });
            }
          })
          .catch((error) => console.log(error));
      },
  
      fetchData() {
        var that = this;
        axios
          .all([
            axios.get("/getLocalisations"),
            axios.get("getRoles"),
            axios.get("utilisateurs"),
          ])
          .then(
            axios.spread(function (localisations, roles, users) {
              that.localisations = localisations.data;
              that.roles = roles.data;
              that.users = users.data;
              console.log(users.data);
            })
          );
      },
    },
  };
  </script>
  