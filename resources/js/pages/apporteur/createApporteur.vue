<template>
  <div class="main-wrapper">
    <Header />

    <Sidebar />
    <div class="page-wrapper">
      <div class="content container-fluid pb-0">
        <div class="row">
          <div class="col-md-12">
            <div class="page-head-box">
              <h3>Création d'apporteur</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <router-link to="/">Tableau de bord</router-link>

                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Apporteur
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>

        <div class="card tab-box mt-3">
          <div class="row user-tabs">
            <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
              <ul class="nav nav-tabs nav-tabs-bottom pt-3 pb-2">
                <li class="nav-item">
                  <a href="#emp_profile" data-bs-toggle="tab" class="nav-link active">Général</a>
                </li>
                <li class="nav-item">
                  <a href="#bank_statutory" data-bs-toggle="tab" class="nav-link">Taux</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="tab-content">
          <div id="emp_profile" class="pro-overview tab-pane fade show active">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title mb-0">Général</h4>
                  </div>
                  <div class="card-body">
                    <form action="#">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Nom de l'apporteur</label>
                            <inputText :placeholder="'Entrez le nom de l apporteur'" v-model="nom_apporteur"></inputText>
                            <p style="color: red" class="text-red" v-if="errors.nom_apporteur"
                              v-text="errors.nom_apporteur[0]"></p>
                          </div>
                          <div class="form-group">
                            <label>Contact</label>
                            <inputText :placeholder="'Entrez le contact de l\'apporteur'" v-model="contact_apporteur">
                            </inputText>
                            <p style="color: red" class="text-red" v-if="errors.contact_apporteur"
                              v-text="errors.contact_apporteur[0]"></p>
                          </div>
                          <div class="form-group">
                            <label>Code postal</label>
                            <inputText :placeholder="'Entrez le code postal de l\'apporteur'" v-model="code_postal">
                            </inputText>
                            <p style="color: red" class="text-red" v-if="errors.code_postal"
                              v-text="errors.code_postal[0]"></p>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Email</label>
                                <inputText :placeholder="'Entrez l\'email de de l\'apporteur'" v-model="email_apporteur">
                                </inputText>
                                <p style="color: red" class="text-red" v-if="errors.email_apporteur"
                                  v-text="errors.email_apporteur[0]"></p>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-9">
                              <div class="form-group">
                                <label>Adresse</label>
                                <Multiselect v-model="adresse_apporteur" :options="localisations" :custom-label="({ id_localisation, nom_ville }) =>
                                  `${id_localisation} - [${nom_ville}]`
                                  " valueProp="nom_ville" placeholder="Selectionnez zone" label="nom_ville"
                                  track-by="nom_ville" :searchable="true">
                                </Multiselect>
                                <p style="color: red" class="text-red" v-if="errors.adresse_apporteur"
                                  v-text="errors.adresse_apporteur[0]"></p>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                  data-bs-target="#addProspect" style="margin-top: 25px">
                                  Ajouter
                                </button>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="bank_statutory">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">Taux</h3>

                <div class="row">
                  <div class="col-md-6" v-for="branche in branches" :key="branche.id_branche">
                    <div class="form-group">
                      <label>{{ branche.nom_branche }}</label>
                      <input type="number" class="form-control" placeholder="Entrez le taux" :key="branche.id_branche"
                        step="0.01" min="0" max="1000" v-model="branche.value" />
                    </div>
                  </div>
                </div>
                <div class="submit-section">
                  <button class="btn btn-primary submit-btn" type="button" @click="storeApporteur">
                    Enregistrer
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <addadresse @adresse-add="handleClientsChange"></addadresse>
  </div>
</template>
<script>
import Multiselect from "@vueform/multiselect";
import Header from "../../layout/Header.vue";
import Sidebar from "../../layout/Sidebar.vue";
import inputText from "../../components/input/inputText.vue";
import { getBrancheList, getAdresseList } from "../../services/formservice";
import addadresse from "../../pages/form/addadresse.vue";
import { createToaster } from "@meforma/vue-toaster";

import AppStorage from '../../utils/helpers/AppStorage';
const toaster = createToaster({
  /* options */
});

export default {
  name: "createapporteur",
  data() {
    return {
      value: null,
      localisations: [],
      branches: [],
      nom_apporteur: "",
      contact_apporteur: "",
      email_apporteur: "",
      adresse_apporteur: "",
      code_postal: "",
      ajout_adresse: "",
      accidents: [],
      ids: [],
      errors: {},
      isConnected: false,
    };
  },
  created() {
    this.getBranche();
    this.getAdresse();
  },

  methods: {
    async storeApporteur() {
      const response = await fetch(
        "/api/check-internet-connection"
      );

      const data = await response.json();

      this.isConnected = data.connected;
      if (this.isConnected) {
        const { v4: uuidv4 } = require('uuid');
        const uuid = uuidv4();
        const token = AppStorage.getToken();
        const userId = AppStorage.getId();
        const entrepriseId = AppStorage.getEntreprise();

        // Configurez les en-têtes de la requête
        const headers = {
          Authorization: "Bearer " + token,
          "x-access-token": token,
        };
        let test = JSON.parse(JSON.stringify(this.branches));
        let donnees = [];

        for (let i = 0; i < Object.keys(test).length; i++) {
          donnees.push(test[i]["value"]);
        }

        let testing = JSON.parse(JSON.stringify(this.branches));
        let datas = [];

        for (let i = 0; i < Object.keys(testing).length; i++) {
          datas.push(testing[i]["id_branche"]);
        }
        axios
          .post("/api/auth/postApporteur", {
            nom_apporteur: this.nom_apporteur,
            contact_apporteur: this.contact_apporteur,
            email_apporteur: this.email_apporteur,
            adresse_apporteur: this.adresse_apporteur,
            code_postal: this.code_postal,
            accidents: donnees,
            ids: datas,
            id_entreprise: entrepriseId,
            id: userId,
          })
          .then((response) => {
            AppStorage.storeApporteurs(response.data)
            this.$router.push("/listapporteur");
            if (response.status === 200) {
              toaster.success(`Apporteur ajouté avec succès`, {
                position: "top-right",
              });
            }
          })
          .catch((error) => {
            // console.log(error.response.headers);
            // if (error.response.status === 422) {
            //   this.errors = error.response.data.errors;
            //   toaster.error(`Veuillez remplir tous les champs`, {
            //     position: "top-right",
            //   });
            // } else if (error.request) {
            //   // The request was made but no response was received
            //   console.log(error.request);
            //   toaster.error(`Veuillez remplir les champs`, {
            //     position: "top-right",
            //   });
            // } else {
            //   // Something happened in setting up the request that triggered an Error
            //   console.log("Error", error.message);
            // }
          });
      } else { }

    },
    getAdresse() {
      getAdresseList().then((result) => {
        this.localisations = result;
      });
    },

    getBranche: function () {
      getBrancheList().then((result) => {
        this.branches = result;

      });
    },
  },
  components: { Header, Sidebar, inputText, addadresse, Multiselect },
};
</script>
  