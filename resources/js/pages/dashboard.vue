<template>
  <div class="main-wrapper">
    <Header />

    <Sidebar />

    <div class="page-wrapper">
      <div class="content container-fluid pb-0"></div>

      <form method="get">
        <div class="row">
          <div class="col-xl-3 col-md-6">
            <select class="form-select mb-3" v-model="year">
              <option
                v-for="data in getYear"
                :value="data.id_avenant"
                :key="data.id_avenant"
              >
                {{ data.annee }}
              </option>
            </select>
          </div>
          <div class="col-xl-3 col-md-6" v-if="year != 0" @change="getData()">
            <select class="form-select mb-3" v-model="branch">
              <option value="tous">Toutes les branches</option>
              <option
                v-for="branche in branches"
                :value="branche.id_branche"
                :key="branche.id_branche"
              >
                {{ branche.nom_branche }}
              </option>
            </select>
          </div>
        </div>
      </form>

      <div class="row">
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
          <div class="card flex-fill tickets-card">
            <div class="card-header">
              <div class="text-center w-100 p-3">
                <h3 class="bl-text mb-1"></h3>
                <h2>Nombre de contrats</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
          <div class="card flex-fill tickets-card">
            <div class="card-header">
              <div class="text-center w-100 p-3">
                <h3 class="bl-text mb-1"></h3>
                <h2>Nombre de prospects</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
          <div class="card flex-fill tickets-card">
            <div class="card-header">
              <div class="text-center w-100 p-3">
                <h3 class="bl-text mb-1"></h3>
                <h2>Contrat à echeance</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
          <div class="card flex-fill tickets-card">
            <div class="card-header">
              <div class="text-center w-100 p-3">
                <h3 class="bl-text mb-1"></h3>
                <h2>Nombre de sinistres</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
          <div class="card flex-fill tickets-card">
            <div class="card-header">
              <div class="text-center w-100 p-3">
                <h3 class="bl-text mb-1"></h3>
                <h2>Emissions</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
          <div class="card flex-fill tickets-card">
            <div class="card-header">
              <div class="text-center w-100 p-3">
                <h3 class="bl-text mb-1"></h3>
                <h2>Commission courtier</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
          <div class="card flex-fill tickets-card">
            <div class="card-header">
              <div class="text-center w-100 p-3">
                <h3 class="bl-text mb-1"></h3>
                <h2>Commission apporteur</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Header from "../layout/Header";
import Sidebar from "../layout/Sidebar";
export default {
  data() {
    return {
      year: "",
      branch: "",
      contrat: "",
      prospect: "",
      sinistre: "",
      comissioncourtier: "",
      comissionapporteur: "",
      echeance: "",
      countemission: "",
      getYear: {},
      branches: {},
    };
  },
  created() {
    if (!User.loggedIn()) {
      this.$router.push({ name: "welcome" });
    }
    this.fetchData();
    this.getCategory();
    this.getTypes();
    this.getData();
  },
  name: "dashboard",
  components: { Header, Sidebar },
  methods: {
    fetchData() {
      const token = localStorage.getItem("token");

      // Configurez les en-têtes de la requête
      const headers = {
        Authorization: "Bearer " + token,
        "x-access-token": token,
      };

      this.error = this.branches = null;
      this.loading = true;
      axios
        .get("/api/auth/stat", { headers })
        .then((response) => {
          this.contrat = response.data.contrat;
          this.prospect = response.data.prospect;
          this.sinistre = response.data.sinistre;
          this.comissioncourtier = response.data.comissioncourtier;
          this.comissionapporteur = response.data.comissionapporteur;
          this.echeance = response.data.echeance;
          this.countemission = response.data.countemission;
        })
        .catch((error) => {
          this.loading = false;
          this.error = error.response.data.message || error.message;
        });
    },

    getCategory: function () {
      const token = localStorage.getItem("token");

      // Configurez les en-têtes de la requête
      const headers = {
        Authorization: "Bearer " + token,
        "x-access-token": token,
      };
      axios.get("/api/auth/year", { headers }).then(
        function (response) {
          this.getYear = response.data;
          console.log(response.data)
        }.bind(this)
      );
    },

    getTypes: function () {
      const token = localStorage.getItem("token");

      // Configurez les en-têtes de la requête
      const headers = {
        Authorization: "Bearer " + token,
        "x-access-token": token,
      };
      axios.get("/api/auth/retrievebranche", { headers }).then(
        function (response) {
          this.branches = response.data;
        }.bind(this)
      );
    },

    getData() {
      const token = localStorage.getItem("token");

      // Configurez les en-têtes de la requête
      const headers = {
        Authorization: "Bearer " + token,
        "x-access-token": token,
      };
      axios
        .get(
          "/api/auth/stat/",
          { headers },
          {
            params: {
              year: this.year,
              branch: this.branch,
            },
          }
        )
        .then((response) => {
          this.contrat = response.data.contrat;
          this.prospect = response.data.prospect;
          this.sinistre = response.data.sinistre;
          this.comissioncourtier = response.data.comissioncourtier;
          this.comissionapporteur = response.data.comissionapporteur;
          this.echeance = response.data.echeance;
          this.countemission = response.data.countemission;
        })
        .catch((error) => console.log(error));
    },
  },
};
</script>