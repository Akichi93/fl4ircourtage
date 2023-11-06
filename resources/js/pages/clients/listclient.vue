<template>
    <div class="content container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="page-head-box">
            <h3>Clients</h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="/home">Tableau de bord</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Client</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
  
      <div class="row filter-row">
        <div class="col-md-8"></div>
        <div class="col-md-4">
          <div class="add-emp-section">
            <a href="#" data-bs-toggle="modal" data-bs-target="#create_project" class="btn btn-success btn-add-emp"
              style="width: auto"><i class="fas fa-plus"></i> Ajouter client
            </a>
          </div>
        </div>
      </div>
  
      <div class="row">
        <div class="col-row">
          <input type="text" class="form-control" placeholder="Rechercher un client" v-model="q" @keyup="searchtask" />
        </div>
        <div class="col-md-12">
  
          <div class="table-responsive">
            <table class="table table-striped custom-table mb-0">
              <thead>
                <tr>
                  <th>Nom du prospect</th>
                  <th>Adresse</th>
                  <th>Email</th>
                  <th>Contact</th>
                  <th>Profession</th>
                  <th class="text-end">Actions</th>
                </tr>
              </thead>
              <tbody>
                <template v-for="client in clients.data" :key="client.id_client">
                  <tr>
                    <td v-text="client.nom_client"></td>
                    <td v-text="client.adresse_client"></td>
                    <td v-text="client.email_client"></td>
                    <td v-text="client.tel_client"></td>
                    <td v-text="client.profession_client"></td>
                    <td class="text-end ico-sec d-flex justify-content-end">
                      <a href="#" data-bs-toggle="modal" data-bs-target="#edit_project"
                        @click="getClient(client.id_client)"><i class="fas fa-pen"></i></a>
                    </td>
                  </tr>
                </template>
              </tbody>
            </table>
          </div>
          
          <pagination align="center" :data="clients" :limit="5" :current_page="clients.current_page"
            :last_page="clients.last_page" @pagination-change-page="listclient">
          </pagination>
        </div>
      </div>
    </div>
  
    <div id="create_project" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Ajouter client</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Civilité</label>
                    <Multiselect v-model="civilite" :options="valeurs" placeholder="Choisir une civilité"
                      :searchable="true" />
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Nom complet du client</label>
                    <input type="text" class="form-control" placeholder="Entrez le nom du client" v-model="nom_client" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Boîte postal</label>
                    <input type="text" class="form-control" placeholder="Entrez la boîte postale" v-model="postal_client" />
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Téléphone</label>
                    <input type="text" class="form-control" placeholder="Numéro de téléphone" v-model="tel_client" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-9 adresse">
                  <div class="form-group">
                    <label>Adresse</label>
                    <Multiselect v-model="adresse_client" :options="localisations" :custom-label="({ id_localisation, nom_ville }) =>
                      `${id_localisation} - [${nom_ville}]`
                      " valueProp="nom_ville" placeholder="Selectionnez zone" label="nom_ville" track-by="nom_ville"
                      :searchable="true">
                    </Multiselect>
                  </div>
                </div>
                <div class="col-sm-3 ajout">
                  <div class="form-group">
                    <button type="button" style="margin-top: 25px" class="btn btn-primary">
                      Ajouter
                    </button>
                  </div>
                </div>
                <div class="col-md-8 form1" style="display: none">
                  <div>
                    <label>Adresse</label>
                    <input type="text" class="form-control" placeholder="Entrez une nouvelle adresse"
                      v-model="ajout_adresse" />
                  </div>
                </div>
                <div class="col-md-2 form2" style="display: none">
                  <div>
                    <button type="button" class="btn btn-primary" style="margin-top: 25px" @click="storeAdresse">
                      Ajouter
                    </button>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-9 profession">
                  <div class="form-group">
                    <label>Profession</label>
                    <Multiselect v-model="profession_client" :options="professions" :custom-label="({ id_profession, profession }) =>
                      `${id_profession} - [${profession}]`
                      " valueProp="profession" placeholder="Choisir une profession" label="profession"
                      track-by="profession" :searchable="true">
                    </Multiselect>
                  </div>
                </div>
                <div class="col-sm-3 ajouter">
                  <div class="form-group">
                    <button type="button" style="margin-top: 25px" class="btn btn-primary">
                      Ajouter
                    </button>
                  </div>
                </div>
                <div class="col-md-8 form3" style="display: none">
                  <label>Profession</label>
                  <input type="text" class="form-control" placeholder="Entrez une nouvelle profession"
                    v-model="ajout_profession" />
                </div>
                <div class="col-md-2 form4" style="display: none">
                  <div>
                    <button type="button" class="btn btn-primary" style="margin-top: 25px" @click="storeProfession">
                      Ajouter
                    </button>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" placeholder="Email du client" v-model="email_client" />
                  </div>
                </div>
              </div>
  
              <div class="form-group">
                <label>Fax</label>
                <input type="text" class="form-control" placeholder="fax du client" v-model="fax_client" />
              </div>
              <div class="submit-section">
                <button type="button" class="btn btn-primary cancel-btn" data-bs-dismiss="modal" aria-label="Close">
                  Annuler
                </button>
                <button type="button" class="btn btn-primary submit-btn" @click="storeClient" data-bs-dismiss="modal">
                  Ajouter
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  
    <div id="edit_project" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modifier client</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Civilité</label>
                    <Multiselect :value="clientoedit.civilite" v-model="civil" :options="valeurs"
                      placeholder="Choisir une civilité" :searchable="true" />
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Nom complet du client</label>
                    <input type="text" class="form-control" v-model="clientoedit.nom_client" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Boîte postal</label>
                    <input type="text" class="form-control" placeholder="Entrez la boîte postale"
                      v-model="clientoedit.postal_client" />
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Téléphone</label>
                    <input type="text" class="form-control" placeholder="Numéro de téléphone"
                      v-model="clientoedit.tel_client" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-9 adresse">
                  <div class="form-group">
                    <label>Adresse</label>
                    <Multiselect :value="clientoedit.adresse_client" v-model="adresse" :options="localisations"
                      :custom-label="({ id_localisation, nom_ville }) =>
                        `${id_localisation} - [${nom_ville}]`
                        " valueProp="nom_ville" placeholder="Selectionnez zone" label="nom_ville" track-by="nom_ville"
                      :searchable="true">
                    </Multiselect>
                  </div>
                </div>
                <div class="col-sm-3 ajout">
                  <div class="form-group">
                    <button type="button" style="margin-top: 25px" class="btn btn-primary">
                      Ajouter
                    </button>
                  </div>
                </div>
                <div class="col-md-8 form1" style="display: none">
                  <div>
                    <label>Adresse</label>
                    <input type="text" class="form-control" placeholder="Entrez une nouvelle adresse"
                      v-model="ajout_adresse" />
                  </div>
                </div>
                <div class="col-md-2 form2" style="display: none">
                  <div>
                    <button type="button" class="btn btn-primary" style="margin-top: 25px" @click="storeAdresse">
                      Ajouter
                    </button>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-9 profession">
                  <div class="form-group">
                    <label>Profession</label>
                    <Multiselect :value="clientoedit.profession_client" v-model="profession" :options="professions"
                      :custom-label="({ id_profession, profession }) =>
                        `${id_profession} - [${profession}]`
                        " valueProp="profession" placeholder="Choisir une profession" label="profession"
                      track-by="profession" :searchable="true">
                    </Multiselect>
                  </div>
                </div>
                <div class="col-sm-3 ajouter">
                  <div class="form-group">
                    <button type="button" style="margin-top: 25px" class="btn btn-primary">
                      Ajouter
                    </button>
                  </div>
                </div>
                <div class="col-md-8 form3" style="display: none">
                  <label>Profession</label>
                  <input type="text" class="form-control" placeholder="Entrez une nouvelle profession"
                    v-model="ajout_profession" />
                </div>
                <div class="col-md-2 form4" style="display: none">
                  <div>
                    <button type="button" class="btn btn-primary" style="margin-top: 25px" @click="storeProfession">
                      Ajouter
                    </button>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" placeholder="Email du client"
                      v-model="clientoedit.email_client" />
                  </div>
                </div>
              </div>
  
              <div class="form-group">
                <label>Fax</label>
                <input type="text" class="form-control" placeholder="fax du client" v-model="clientoedit.fax_client" />
              </div>
              <div class="submit-section">
                <button type="button" class="btn btn-primary cancel-btn" data-bs-dismiss="modal" aria-label="Close">
                  Annuler
                </button>
                <button type="button" class="btn btn-primary submit-btn" @click="editClient" data-bs-dismiss="modal">
                  Ajouter
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
  import pagination from "laravel-vue-pagination";
  import { createToaster } from "@meforma/vue-toaster";
  // import $ from "jquery";
  const toaster = createToaster({
    /* options */
  });
  export default {
    name: "prospect",
    components: {
      Multiselect,
      pagination,
    },
    props: ["current_page", "last_page"],
    data() {
      return {
        value: null,
        clients: {},
        localisations: {},
        professions: {},
        q: "",
        //Client form
        civilite: "",
        civil: "",
        nom_client: "",
        prenom_client: "",
        postal_client: "",
        adresse_client: "",
        adresse: "",
        tel_client: "",
        profession_client: "",
        profession: "",
        fax_client: "",
        clientoedit: "",
        ajout_adresse: "",
        ajout_profession:"",
        valeurs: ["Monsieur", "Madame", "Mademoiselle", "Dr", "Pr","Société"],
  
      };
    },
    methods: {
      getClient(id_client) {
        axios
          .get("/editClient/" + id_client)
          .then((response) => {
            this.clientoedit = response.data;
          })
          .catch((error) => console.log(error));
      },
  
      listclient(page = 1) {
        axios.get("/clientList?page=" + page).then((response) => {
          this.clients = response.data;
        });
      },
  
      storeClient() {
        axios
          .post("/postClient", {
            civilite: this.civilite,
            nom_client: this.nom_client,
            prenom_client: this.prenom_client,
            postal_client: this.postal_client,
            adresse_client: this.adresse_client,
            tel_client: this.tel_client,
            profession_client: this.profession_client,
            fax_client: this.fax_client,
            email_client: this.email_client,
          })
          .then((response) => {
            this.listclient();
            this.civilite =
              this.nom_client =
              this.prenom_client =
              this.postal_client =
              this.adresse_client =
              this.tel_client =
              this.profession_client =
              this.fax_client =
              this.email_client =
              "";
            if (response.status === 200) {
              toaster.success(`Client ajouté avec succès`, {
                position: "top-right",
              });
              this.clients = response.data;
            }
          })
          .catch((error) => {
            // console.log(error.response.headers);
  
            if (error.response.status === 422) {
              this.errors = error.response.data.errors;
              toaster.error(`Veuillez remplir les champs`, {
                position: "top-right",
              });
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
  
      storeAdresse() {
        axios
          .post("/postLocalisations", {
            ajout_adresse: this.ajout_adresse,
          })
          .then((response) => {
            this.fetchTask();
            if (response.status === 200) {
              toaster.success(`Adresse ajouté avec succès`, {
                position: "top-right",
              });
              this.adresses = response.data;
              this.ajout_adresse = '';
            }
          })
          .catch((error) => {
            // console.log(error.response.headers);
  
            if (error.response.status === 422) {
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
  
      storeProfession() {
        axios
          .post("/postProfessions", {
            ajout_profession: this.ajout_profession,
          })
          .then((response) => {
            this.fetchTask();
            if (response.status === 200) {
              toaster.success(`Profession ajouté avec succès`, {
                position: "top-right",
              });
              this.professions = response.data;
              this.ajout_profession = '';
            }
          })
          .catch((error) => {
            // console.log(error.response.headers);
  
            if (error.response.status === 422) {
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
  
      editClient() {
        axios
          .patch("/updateClient/" + this.clientoedit.id_client, {
            civilite: this.civil,
            nom_client: this.clientoedit.nom_client,
            postal_client: this.clientoedit.postal_client,
            adresse_client: this.adresse,
            tel_client: this.clientoedit.tel_client,
            profession_client: this.profession,
            fax_client: this.clientoedit.fax_client,
            email_client: this.clientoedit.email_client,
          })
          .then((response) => {
            if (response.status === 200) {
              toaster.success(`Client modifié avec succès`, {
                position: "top-right",
              });
              this.taches = response.data;
              this.fetchTask();
              this.listclient();
            }
          })
          .catch((error) => {
            if (error.response.status === 422) {
              this.errors = error.response.data.errors;
              toaster.error(
                `Client non modifié . Veuillez remplir les champs demandé`,
                {
                  position: "top-right",
                  duration: 4000,
                }
              );
            }
          });
      },
  
      fetchTask() {
        var that = this;
        axios
          .all([axios.get("/getLocalisations"), axios.get("/getProfessions")])
          .then(
            axios.spread(function (localisations, professions) {
              that.localisations = localisations.data;
              that.professions = professions.data;
            })
          );
      },
  
      searchtask() {
        axios
          .get("/clientList/" + this.q)
          .then((response) => (this.clients = response.data))
          .catch((error) => console.log(error));
      },
    },
    mounted() {
      this.fetchTask();
      this.listclient();
    },
    created() {
      this.fetchTask();
      this.listclient();
    },
  };
  </script>
  
  <style src="@vueform/multiselect/themes/default.css"></style>
  
  <style scoped>
  .pagination {
    margin-bottom: 0;
  }
  
  .curseur:hover {
    cursor: grab;
  }
  </style>
  