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
                    <a href="admin-dashboard.html">Tableau de bord</a>
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
                    <form action="#">
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
                            <div class="col-md-9 adresse">
                              <div class="form-group">
                                <label>Adresse</label>
                                <adressecomponent :placeholder="'selectionnez l\'adresse'" v-model="adresse_compagnie">
                                </adressecomponent>
                                <p style="color: red" class="text-red" v-if="errors.adresse_compagnie"
                                  v-text="errors.adresse_compagnie[0]"></p>
                              </div>
                            </div>
                            <div class="col-md-3 ajout">
                              <div class="form-group">
                                <button type="button" style="margin-top: 25px" class="btn btn-primary">
                                  Ajouter
                                </button>
                              </div>
                            </div>
                            <div class="col-md-4 form1" style="display: none">
                              <div>
                                <label>Adresse</label>
                                <input type="text" class="form-control" placeholder="Entrez une nouvelle adresse"
                                  v-model="ajout_adresse" />
                              </div>
                            </div>
                            <div class="col-md-2 form2" style="display: none">
                              <div>
                                <button type="button" class="btn btn-primary" style="margin-top: 25px"
                                  @click="storeAdresse">
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
                <form>
                  <div class="row">
                    <div class="col-md-6" v-for="branche in branches" :key="branche.id_branche">
                      <div class="form-group">
                        <label>{{ branche.nom_branche }}</label>
                        <input type="text" class="form-control" placeholder="Entrez le taux" :key="branche.id_branche"
                          v-model="branche.value" />
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
      </div>
    </div>
  </div>
</template>
<script>
import Header from "../../layout/Header.vue";
import Sidebar from "../../layout/Sidebar.vue";
import inputText from "../../components/input/inputText.vue";
import adressecomponent from "../../components/select/adressecomponent.vue";
import { getBrancheList } from "../../services/formservice";
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
    adressecomponent,
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
    };
  },
  created() {
    this.getBranche();
  },
  methods: {
    storeCompagnie() {
      alert(this.adresse_compagnie);
      const token = localStorage.getItem("token");
      const userId = localStorage.getItem("id");
      const entrepriseId = localStorage.getItem("entreprise");


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
        .post("/api/auth/postCompagnie", {
          nom_compagnie: this.nom_compagnie,
          contact_compagnie: this.contact_compagnie,
          email_compagnie: this.email_compagnie,
          adresse_compagnie: this.adresse_compagnie,
          accidents: donnees,
          ids: datas,
          id_entreprise: entrepriseId,
          id: userId,
        })
        .then((response) => {
          // if (response.status === 200) {
          toaster.success(`Compagnie ajouté avec succès`, {
            position: "top-right",
          });
          this.contrats = response.data;
          // }
          this.$router.push("/listcompagnie");
        })
        .catch((error) => {
          // console.log(error.response.headers);

          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
            // console.log(error.response.data.errors);
            toaster.error(`Veuillez remplir tous les champs`, {
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
          this.ajout_adresse = "";
          if (response.status === 200) {
            toaster.success(`Adresse ajouté avec succès`, {
              position: "top-right",
            });
            this.contrats = response.data;
          }
        })
        .catch((error) => {
          // console.log(error.response.headers);

          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
            if (response.status === 422) {
              toaster.error(`Cet compagnie existe déja`, {
                position: "top-right",
              });
            }
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

    getBranche: function () {
      getBrancheList().then((result) => {
        this.branches = result;
        console.log(result);
      });
    },
  },
};
</script>