<template>
  <div class="main-wrapper">
    <Header />

    <Sidebar />
    <div class="page-wrapper">
      <div class="content container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="page-head-box">
              <h3>
                Listes des taux de l'apporteur
                <em>{{ names.nom_apporteur }}</em>
              </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <router-link to="/home">Tableau de bord</router-link>
                  </li>
                  <li class="breadcrumb-item">
                    <router-link to="/listapporteur">Listes des apporteurs</router-link>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Taux apporteurs
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>

        <div class="row filter-row" v-if="branches.length > 0">
          <div class="col-md-8"></div>
          <div class="col-md-4">
            <div class="add-emp-section">
              <a href="#" data-bs-toggle="modal" data-bs-target="#add_taux" class="btn btn-success btn-add-emp"
                style="width: auto" @click="getApporteur(names.id_apporteur)"><i class="fas fa-plus"></i> Ajouter un taux
              </a>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div>
              <table class="table table-striped custom-table mb-0">
                <thead>
                  <tr>
                    <th>Nom de la branche</th>
                    <th>Taux</th>
                    <th class="text-end">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <template v-for="apporteur in tauxApporteurs" :key="apporteur.id_tauxapp">
                    <tr>
                      <td v-text="apporteur.nom_branche"></td>
                      <td v-text="apporteur.taux"></td>
                      <td class="text-end ico-sec d-flex justify-content-end">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#edit_taux"
                          @click="getTaux(apporteur.id_tauxapp)" title="Modifier"><i class="fas fa-pen"></i>
                        </a>
                      </td>
                    </tr>
                  </template>
                </tbody>
              </table>
            </div>

            <addtauxapporteur v-bind:tauxapporteurtoedit="tauxapporteurtoedit" @tauxapporteur-add="refresh">
            </addtauxapporteur>

            <edittauxapporteur v-bind:tauxtoedit="tauxtoedit" @taux-update="refresh"></edittauxapporteur>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Header from "../../layout/Header.vue";
import Sidebar from "../../layout/Sidebar.vue";
import addtauxapporteur from "./addtauxapporteur.vue";
import edittauxapporteur from "./edittauxapporteur.vue";
import AppStorage from "../../utils/helpers/AppStorage";
export default {
  name: "tauxapporteur",
  components: { Header, Sidebar, addtauxapporteur, edittauxapporteur },
  data() {
    return {
      value: null,
      tauxApporteurs: [],
      tauxtoedit: "",
      tauxapporteurtoedit: "",
      names: "",
      branches: {},
      accidents: [],

      ids: [],
    };
  },
  methods: {

    async fetchData() {
      const uuidApporteur = this.$route.params.uuidApporteur;

      try {
        const tauxApporteurs = await AppStorage.getTauxApporteursByIdApporteur(uuidApporteur);

        this.tauxApporteurs = tauxApporteurs;
      } catch (error) {
        console.error("Erreur lors de la récupération des données :", error);
      }
    },
    // getApporteur() {
    //   axios
    //     .get(`/api/auth/getNameApporteur/${this.$route.params.id_apporteur}`)
    //     .then((response) => (this.tauxapporteurtoedit = response.data))
    //     .catch((error) => console.log(error));
    // },

    // getTaux(id_tauxapp) {
    //   axios
    //     .get("/api/auth/editTauxApporteur/" + id_tauxapp)
    //     .then((response) => (this.tauxtoedit = response.data))
    //     .catch((error) => console.log(error));
    // },

    // fetchTask() {
    //   this.error = this.names = null;
    //   this.loading = true;
    //   var that = this;
    //   axios
    //     .all([
    //       axios.get(
    //         `/api/auth/getNameApporteur/${this.$route.params.id_apporteur}`
    //       ),
    //       axios.get(
    //         `/api/auth/getTauxApporteur/${this.$route.params.id_apporteur}`
    //       ),
    //       axios.get(
    //         `/api/auth/getBrancheDiffApporteur/${this.$route.params.id_apporteur}`
    //       ),
    //     ])
    //     .then(
    //       axios.spread(function (names, apporteurs, branches) {
    //         that.names = names.data;
    //         that.apporteurs = apporteurs.data;
    //         that.branches = branches.data;
    //       })
    //     );
    // },
    refresh(apporteurs) {
      this.apporteurs = apporteurs.data;
    },
  },
  created() {
    // this.getTaux();
    this.fetchData();
    // this.getApporteur();
  },
};
</script>
  