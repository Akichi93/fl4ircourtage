<template>
  <div class="main-wrapper">
    <Header />

    <Sidebar />
    <div class="page-wrapper">
      <div class="content container-fluid pb-0">
        <div class="row">
          <div class="col-md-12">
            <div class="page-head-box">
              <h3>Création de compagnie</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <router-link to="/home">Tableau de bord</router-link>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Compagnies
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

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Nom de la compagnie</label>
                          <inputText :placeholder="'Entrez le nom de la compagnie'" v-model="nom_compagnie"></inputText>

                          <p style="color: red" class="text-red" v-if="errors.nom_compagnie"
                            v-text="errors.nom_compagnie[0]"></p>
                        </div>
                        <div class="form-group">
                          <label>Contact</label>
                          <inputText :placeholder="'Entrez le contact de la compagnie'" v-model="contact_compagnie">
                          </inputText>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Email</label>
                              <inputText :placeholder="'Entrez l\'email de la compagnie'" v-model="email_compagnie">
                              </inputText>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-9">
                            <div class="form-group">
                              <label>Adresse</label>
                              <Multiselect v-model="adresse_compagnie" :options="localisations" :custom-label="({ id_localisation, nom_ville }) =>
                                `${id_localisation} - [${nom_ville}]`
                                " valueProp="nom_ville" placeholder="Selectionnez zone" label="nom_ville"
                                track-by="nom_ville" :searchable="true">
                              </Multiselect>
                              <p style="color: red" class="text-red" v-if="errors.adresse_compagnie"
                                v-text="errors.adresse_compagnie[0]"></p>
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
                  </div>


                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="bank_statutory">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">Taux</h3>
                <form>
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
                    <button class="btn btn-primary submit-btn" type="button" @click="storeCompagnie">
                      Enregistrer
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <addadresse @adresse-add="handleClientsChange"></addadresse>
      </div>
    </div>
  </div>
</template>
<script>
import Multiselect from "@vueform/multiselect";
import Header from "../../layout/Header.vue";
import Sidebar from "../../layout/Sidebar.vue";
import inputText from "../../components/input/inputText.vue";
import addadresse from "../../pages/form/addadresse.vue";
import { getBrancheList, getAdresseList } from "../../services/formservice";
import AppStorage from '../../utils/helpers/AppStorage';
import { createToaster } from "@meforma/vue-toaster";
// import $ from "jquery";
const toaster = createToaster({
  /* options */
});

export default {
  name: "createcompagnie",
  components: {
    Header,
    Sidebar,
    inputText,
    addadresse,
    Multiselect
  },
  data() {
    return {
      value: null,
      localisations: {},
      branches: {},
      nom_compagnie: "",
      contact_compagnie: "",
      email_compagnie: "",
      adresse_compagnie: "",
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
    getBranche: function () {
      getBrancheList().then((result) => {
        this.branches = result;
      });
    },

    getAdresse() {
      getAdresseList().then((result) => {
        this.localisations = result;
      });
    },

    async storeCompagnie() {
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

        try {
          const response = await axios.post("/api/auth/postCompagnie", {
            nom_compagnie: this.nom_compagnie,
            contact_compagnie: this.contact_compagnie,
            email_compagnie: this.email_compagnie,
            adresse_compagnie: this.adresse_compagnie,
            accidents: donnees,
            ids: datas,
            id_entreprise: entrepriseId,
            id: userId,
            uuidCompagnie: uuid,
          });

          const updatedCompagnies = await this.fetchCompagnies();
 b
          if (response.status === 200) {
            console.log(response.data)
            toaster.success(`Compagnie ajouté avec succès`, {
              position: "top-right",
            });
          }

          // Mettre à jour IndexedDB avec les compagnies récupérés après comparaison
          AppStorage.getCompagnies().then((existingCompagnies) => {
            if (existingCompagnies && updatedCompagnies) {
              // Comparaison des nouvelles compagnies avec ceux déjà existants
              const newCompagnies = updatedCompagnies.filter((compagnie) => {
                return !existingCompagnies.some((existingCompagnie) => existingCompagnie.id_compagnie === compagnie.id_compagnie);
              });

              // Insérer uniquement les nouvelles compagnies dans IndexedDB
              if (newCompagnies.length > 0) {
                AppStorage.storeDataInIndexedDB('compagnies', newCompagnies);
              }
            }
          });

          

          // Mettre à jour IndexedDB avec les taux compagnies récupérés 

          const newCompanyId = response.data.id_compagnie;

          const ratesEndpoint = `/api/auth/getTauxCompagnie/${newCompanyId}`;

          const ratesResponse = await axios.get(ratesEndpoint);

          const rates = ratesResponse.data;

          AppStorage.storeDataInIndexedDB('tauxcompagnies', rates);


          this.$router.push("/listcompagnie");



        } catch (error) {
          console.error("Erreur lors de l'ajout de la compagnie sur le serveur", error);
        }
      } else {
        const { v4: uuidv4 } = require('uuid');
        const uuid = uuidv4();

        const userId = parseInt(AppStorage.getId(), 10);
        const entrepriseId = parseInt(AppStorage.getEntreprise(), 10);


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


        // Si hors ligne, ajoutez la nouvelle donnée directement dans IndexedDB
        const newCompagnieData = [{
          nom_compagnie: this.nom_compagnie,
          adresse_compagnie: this.adresse_compagnie,
          email_compagnie: this.email_compagnie,
          postal_compagnie: this.postal_compagnie,
          contact_compagnie: this.contact_compagnie,
          code_compagnie: this.code_compagnie,
          postal_compagnie: this.postal_compagnie,
          sync: 0,
          id_entreprise: entrepriseId,
          user_id: userId,
          uuidCompagnie: uuid,
        }];

        // Ajouter la nouvelle donnée dans IndexedDB
        await AppStorage.storeDataInIndexedDB("compagnies", newCompagnieData);

        const branchesMap = await AppStorage.getBranches();
        for (let i = 0; i < datas.length; i++) {
          // Use the branchesMap to get nom_branche corresponding to id_branche
          const nom_branche = branchesMap[datas[i]];

          let newTauxCompagnie = {
            uuidCompagnie: uuid,
            sync: 0,
            tauxcomp: donnees[i],
            nom_branche: nom_branche, // Use the retrieved nom_branche value
            id_branche: datas[i],
            // Add other properties as needed
          };

          await AppStorage.storeDataInIndexedDB("tauxcompagnies", newTauxCompagnie);
        }

        toaster.info(`Compagnie ajouté localement (hors ligne)`, {
          position: "top-right",
        });

        this.$router.push("/listcompagnie");
      }

    },

    // fetchCompagnies
    async fetchCompagnies() {
      const token = AppStorage.getToken();

      // Configurez les en-têtes de la requête
      const headers = {
        Authorization: "Bearer " + token,
        "x-access-token": token,
      };

      try {
        const response = await axios.get("/api/auth/getCompagnies", { headers });

        // Vous pouvez traiter les données comme vous le souhaitez
        const compagnies = response.data;

        // Retourner les compagnies pour une utilisation éventuelle
        return compagnies;
      } catch (error) {
        console.error("Erreur lors de la récupération des clients sur le serveur", error);
      }
    },


    handleClientsChange(localisations) {
      this.localisations = localisations;
    },


  },
};
</script>