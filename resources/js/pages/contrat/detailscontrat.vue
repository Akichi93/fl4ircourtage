<template>
  <div class="main-wrapper">
    <Header />

    <Sidebar />
    <div class="page-wrapper">
      <div class="content container-fluid pb-0">
        <div class="row">
          <div class="col-md-12">
            <div class="page-head-box">
              <h3>
                Détails du contrat <em>{{ infos.nom_branche }} </em> -
                <em>{{ infos.numero_police }} </em> -
                <em>{{ infos.nom_client }} </em>
              </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <router-link to="/home">Tableau de bord</router-link>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Contrats
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
                  <a href="#emp_profile" data-bs-toggle="tab" class="nav-link active">Information générale</a>
                </li>
                <li class="nav-item">
                  <a href="#emp_projects" data-bs-toggle="tab" class="nav-link">Primes et commisons</a>
                </li>
                <li class="nav-item">
                  <a href="#bank_statutory" data-bs-toggle="tab" class="nav-link">Avenants</a>
                </li>
                <li v-if="infos.nom_branche == 'AUTOMOBILE' ||
                  infos.nom_branche == 'MOTO'
                  " class="nav-item">
                  <a href="#vehicule_info" data-bs-toggle="tab" class="nav-link">Listes des véhicules</a>
                </li>
                <li v-if="count > 0" class="nav-item">
                  <a href="#sinistre_info" data-bs-toggle="tab" class="nav-link">Sinistres</a>
                </li>
                <li class="nav-item">
                  <a href="#file_info" data-bs-toggle="tab" class="nav-link">Fichier</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="tab-content">
          <div id="emp_profile" class="pro-overview tab-pane fade show active">
            <div class="row">
              <div class="col-md-6 d-flex">
                <div class="card profile-box flex-fill">
                  <div class="card-body">
                    <h3 class="card-title">Information générale</h3>
                    <ul class="personal-info">
                      <li>
                        <div class="title">No de police</div>
                        <div class="text" v-text="infos.numero_police"></div>
                      </li>
                      <li>
                        <div class="title">Branche</div>
                        <div class="text" v-text="infos.nom_branche"></div>
                      </li>
                      <li>
                        <div class="title">Client</div>
                        <div class="text" v-text="infos.nom_client"></div>
                      </li>
                      <li>
                        <div class="title">Compagnie</div>
                        <div class="text" v-text="infos.nom_compagnie"></div>
                      </li>
                      <li>
                        <div class="title">Apporteur</div>
                        <div class="text" v-text="infos.nom_apporteur"></div>
                      </li>
                      <li>
                        <div class="title">Date d'émission</div>
                        <div class="text" v-text="infos.souscrit_le"></div>
                      </li>
                      <li>
                        <div class="title">A</div>
                        <div class="text" v-text="infos.heure_police"></div>
                      </li>
                      <li>
                        <div class="title">Expire le</div>
                        <div class="text" v-text="infos.expire_le"></div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="emp_projects">
            <div class="row">
              <div class="col-md-6 d-flex">
                <div class="card profile-box flex-fill">
                  <div class="card-body">
                    <h3 class="card-title">Primes</h3>
                    <ul class="personal-info">
                      <li>
                        <div class="title">Prime nette</div>
                        <div class="text" v-text="sommes.sommePrimeNette"></div>
                      </li>
                      <li>
                        <div class="title">Accessoires</div>
                        <div class="text">{{ sommes.sommeAccessoires }}</div>
                      </li>
                      <li>
                        <div class="title">Frais courtier</div>
                        <div class="text" v-text="sommes.sommeFraisCourtier"></div>
                      </li>
                      <li>
                        <div class="title">Taxes totales</div>
                        <div class="text" v-text="sommes.sommeTaxesTotales"></div>
                      </li>
                      <li>
                        <div class="title">Prime TTC</div>
                        <div class="text" v-text="sommes.sommePrimeTTC"></div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-6 d-flex">
                <div class="card profile-box flex-fill">
                  <div class="card-body">
                    <h3 class="card-title">Commission</h3>
                    <ul class="personal-info">
                      <li>
                        <div class="title">Commission courtier:</div>
                        <div class="text" v-text="sommes.sommeCommissionCourtier"></div>
                      </li>
                      <li>
                        <div class="title">Gestion</div>
                        <div class="text" v-if="gestion == null">0</div>
                        <div class="text" v-else v-text="contrats.gestion"></div>
                      </li>
                      <li>
                        <div class="title">Commission apporteur:</div>
                        <div class="text" v-text="sommes.sommeCommission"></div>
                      </li>
                      <li>
                        <div class="title">Apporteur</div>
                        <div class="text" v-text="contrats.nom_apporteur"></div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="bank_statutory">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">Avenants</h3>

                <table class="table table-striped custom-table mb-0">
                  <thead>
                    <tr>
                      <th>Annee</th>
                      <th>Mois</th>
                      <th>Type</th>
                      <th>Prime TTC</th>

                      <th>Date d'emission</th>
                      <th>Date de debut</th>
                      <th>Date de fin</th>
                    </tr>
                  </thead>
                  <tbody>
                    <template v-for="avenant in avenants" :key="avenant.id_avenant">
                      <tr>
                        <td>{{ avenant.annee }}</td>
                        <td>{{ avenant.mois }}</td>
                        <td>{{ avenant.type }}</td>
                        <td>{{ avenant.prime_ttc }}</td>

                        <td>{{ avenant.date_emission }}</td>
                        <td>{{ avenant.date_debut }}</td>
                        <td>{{ avenant.date_fin }}</td>
                      </tr>
                    </template>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="vehicule_info">
            <div class="row filter-row">
              <div class="col-md-8"></div>
              <div class="col-md-4">
                <div class="add-emp-section">
                  <a href="#" data-bs-toggle="modal" data-bs-target="#add_flotte" class="btn btn-success btn-add-emp"
                    style="width: auto"><i class="fas fa-plus"></i> Ajouter une flotte
                  </a>
                  <a href="#" data-bs-toggle="modal" data-bs-target="#add_auto" class="btn btn-success btn-add-emp"
                    style="width: auto"><i class="fas fa-plus"></i> Ajouter un véhicule
                  </a>


                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">Listes des véhicules</h3>
                <div class="table-responsive">
                  <table class="table"> 
                    <thead>
                      <tr>
                        <th>Immatriculation</th>
                        <th>Identification proprietaire</th>
                        <th>Date de la circulation</th>
                        <th>Adresse proprietaire</th>
                        <th>Marque</th>
                        <th>Energie</th>
                        <th>Couleur</th>
                        <th>Carosserie</th>
                        <th>Categorie</th>
                        <th>Genre</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <template v-for="automobile in automobiles" :key="automobile.id_contrat">
                        <tr>
                          <td>{{ automobile.numero_immatriculation }}</td>
                          <td>{{ automobile.identification_proprietaire }}</td>
                          <td>{{ automobile.date_circulation }}</td>
                          <td>{{ automobile.adresse_proprietaire }}</td>
                          <td>{{ automobile.marque }}</td>
                          <td>{{ automobile.energie }}</td>
                          <td>{{ automobile.couleur }}</td>
                          <td>{{ automobile.carosserie }}</td>
                          <td>{{ automobile.categorie }}</td>
                          <td>{{ automobile.genre }}</td>
                          <td class="text-end ico-sec d-flex justify-content-end">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#add_garantie" title="Ajouter garantie"><i
                                class="fas fa-plus"></i>
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

          <div class="tab-pane fade" id="sinistre_info">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">Listes des sinistres</h3>
                <table class="table table-striped custom-table mb-0">
                  <thead>
                    <tr>
                      <th>Date de survenance</th>
                      <th>Référence</th>
                      <th>Numéro du sinistre</th>
                      <th>Gestion</th>
                      <th>Date de declaration</th>
                    </tr>
                  </thead>
                  <tbody>
                    <template v-for="sinistre in sinistres" :key="sinistre.id_sinistre">
                      <tr>
                        <td>
                          {{ sinistre.date_survenance }}
                        </td>
                        <td>{{ sinistre.reference_compagnie }}</td>
                        <td>{{ sinistre.numero_sinistre }}</td>
                        <td>{{ sinistre.gestion_compagnie }}</td>
                        <td>{{ sinistre.date_declaration }}</td>
                      </tr>
                    </template>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="file_info">
            <div class="project-task">
              <ul class="nav nav-tabs nav-tabs-top nav-justified mb-0">
                <li class="nav-item">
                  <a class="nav-link active" href="#all_tasks" data-bs-toggle="tab" aria-expanded="true">Contrats</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#pending_tasks" data-bs-toggle="tab" aria-expanded="false">Sinistres</a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane show active" id="all_tasks">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title m-b-20">Contrats</h5>
                      <ul class="files-list">
                        <template v-for="file in filecontrats" :key="file.id_contrat">
                          <li>
                            <div class="files-cont">
                              <div class="file-type">
                                <span class="files-icon"><i class="far fa-file-pdf"></i></span>
                              </div>
                              <div class="files-info">
                                <span class="file-name text-ellipsis">
                                  {{ file.titre }}
                                </span>
                                <span class="file-author"><a :href="'/images/piece_avenant/' + file.nom_file
                                  " download>{{ file.nom_file }}</a></span>
                              </div>
                            </div>
                          </li>
                        </template>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="pending_tasks">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title m-b-20">Sinistres</h5>
                      <ul class="files-list">
                        <template v-for="file in filesinistres" :key="file.id_contrat">
                          <li>
                            <div class="files-cont">
                              <div class="file-type">
                                <span class="files-icon"><i class="far fa-file-pdf"></i></span>
                              </div>
                              <div class="files-info">
                                <span class="file-name text-ellipsis">
                                  {{ file.titre }}
                                </span>
                                <span class="file-author"><a :href="'/images/piece_sinistres/' +
                                  file.nom_fichier
                                  " download>{{ file.nom_fichier }}</a></span>
                              </div>
                            </div>
                          </li>
                        </template>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <addautomobile @automobile-add="refresh"></addautomobile>
          <flotte></flotte>
          <addgarantie></addgarantie>



        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Sidebar from "../../layout/Sidebar.vue";
import Header from "../../layout/Header.vue";
import addautomobile from "./addAutomobile.vue";
import flotte from "./flotte.vue";
import addgarantie from "./addGarantie.vue";
import AppStorage from "../../utils/helpers/AppStorage";
export default {
  components: {
    Header,
    Sidebar,
    addautomobile,
    addgarantie,
    flotte
  },
  data() {
    return {
      result: "",
      avenants: {},
      contrats: {},
      infos: {},
      sinistres: {},
      filecontrats: {},
      filesinistres: {},
      automobiles: {},
      count: "",
      id_contrat: "",
      value: null,
      typegarantie: [],
      localisations: {},
      sommes: null,
    };
  },
  created() {
    this.calculateSomme();
    this.fetchDataContrat()
    this.fetchDataAvenant()
  },

  methods: {

    async fetchDataContrat() {
      const uuidContrat = this.$route.params.uuidContrat;

      try {
        const infos = await AppStorage.getInfoContratByUuid(uuidContrat);

        this.infos = infos;
      } catch (error) {
        console.error("Erreur lors de la récupération des données :", error);
      }
    },

    async calculateSomme() {
      const uuidContrat = this.$route.params.uuidContrat;

      // Await the resolution of the Promise
      const sommes = await AppStorage.getAvenantsSommeByUuid(uuidContrat);

      // Assign the result to the component data if needed
      this.sommes = sommes;
    },

    async fetchDataAvenant() { 
      const uuidContrat = this.$route.params.uuidContrat;

      const avenants = await AppStorage.getAvenantsByUuidContrat(uuidContrat);

      this.avenants = avenants;
    },



    fetchData() {
      var that = this;
      axios
        .all([
          axios.get(`/api/auth/getAvenantContrat/${this.$route.params.id_contrat}`),
          axios.get("/api/auth/getInfoAvenantContrat?contrat=" + this.$route.params.id_contrat),
          axios.get("/api/auth/getInfoContrat?contrat=" + this.$route.params.id_contrat),
          axios.get("/api/auth/getCountsinistre?contrat=" + this.$route.params.id_contrat),
          axios.get("/api/auth/getInfosinistres?contrat=" + this.$route.params.id_contrat),
          axios.get("/api/auth/getInfoFileContrat?contrat=" + this.$route.params.id_contrat),
          axios.get("/api/auth/getInfoFileSinistre?contrat=" + this.$route.params.id_contrat),
          axios.get("/api/auth/getInfoVehicules?contrat=" + this.$route.params.id_contrat),
        ])
        .then(
          axios.spread(function (
            avenants,
            contrats,
            infos,
            count,
            sinistres,
            filecontrats,
            filesinistres,
            automobiles
          ) {
            that.avenants = avenants.data;
            that.contrats = contrats.data;
            that.infos = infos.data;
            that.count = count.data;
            that.sinistres = sinistres.data;
            that.filecontrats = filecontrats.data;
            that.filesinistres = filesinistres.data;
            that.automobiles = automobiles.data;
          })
        );
    },



    storeAutomobile() {
      axios
        .post("/api/auth/postAutomobile", {
          //Automobile
          numero_immatriculation: this.numero_immatriculation,
          date_circulation: this.date_circulation,
          identification_proprietaire: this.identification_proprietaire,
          adresse_proprietaire: this.adresse_proprietaire,
          zone: this.zone,
          categorie_id: this.categorie_id,
          marque_id: this.marque_id,
          genre_id: this.genre_id,
          type: this.type,
          carosserie: this.carosserie,
          couleur_id: this.couleur_id,
          energie_id: this.energie_id,
          place: this.place,
          puissance: this.puissance,
          charge: this.charge,
          valeur_neuf: this.valeur_neuf,
          valeur_venale: this.valeur_venale,
          categorie_socio_pro: this.categorie_socio_pro,
          permis: this.permis,
          option: this.option_garantie,
          entree: this.entree_le,
          garantie: this.typegarantie,
          tierce: this.tierce,
          id_contrat: this.id_contrat,
        })
        .then((response) => {
          this.fetchData();
          if (response.status === 200) {
            toaster.success(`Véhicule ajouté avec succès`, {
              position: "top-right",
            });
            this.clients = response.data;
          }
          console.log(response.data);
        })
        .catch((error) => {
          // console.log(error.response.headers);

          if (error.response.status === 422) {
            toaster.error(`Veuillez remplir les champs indiqués`, {
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

    storeGarantie() {
      axios
        .post("/api/auth/postGarantie", {
          //Automobile
          garantie: this.typegarantie,
          tierce: this.tierce,
          id_contrat: this.id_contrat,
        })
        .then((response) => {
          if (response.status === 200) {
            toaster.success(`Garantie ajouté avec succès`, {
              position: "top-right",
            });
          }
        })
        .catch((error) => {
          if (error.response.status === 422) {
            toaster.error(`Veuillez remplir les champs indiqués`, {
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

    refresh(automobiles) {
      this.automobiles = automobiles.data;
    }
  },
};
</script>
  