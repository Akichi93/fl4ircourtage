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
              <option v-for="data in getYear" :value="data.id_avenant" :key="data.id_avenant">
                {{ data.annee }}
              </option>
            </select>
          </div>
          <div class="col-xl-3 col-md-6" v-if="year != 0" @change="getData()">
            <select class="form-select mb-3" v-model="branch">
              <option value="tous">Toutes les branches</option>
              <option v-for="branche in branches" :value="branche.id_branche" :key="branche.id_branche">
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
                <h3 class="bl-text mb-1" v-text="contrat"></h3>
                <h2>Nombre de contrats</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
          <div class="card flex-fill tickets-card">
            <div class="card-header">
              <div class="text-center w-100 p-3">
                <h3 class="bl-text mb-1" v-text="prospect"></h3>
                <h2>Nombre de prospects</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
          <div class="card flex-fill tickets-card">
            <div class="card-header">
              <div class="text-center w-100 p-3">
                <h3 class="bl-text mb-1" v-text="echeance"></h3>
                <h2>Contrat à echeance</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
          <div class="card flex-fill tickets-card">
            <div class="card-header">
              <div class="text-center w-100 p-3">
                <h3 class="bl-text mb-1" v-text="sinistre"></h3>
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
                <h3 class="bl-text mb-1" v-text="countemission"></h3>
                <h2>Emissions</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
          <div class="card flex-fill tickets-card">
            <div class="card-header">
              <div class="text-center w-100 p-3">
                <h3 class="bl-text mb-1" v-text="comissioncourtier"></h3>
                <h2>Commission courtier</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
          <div class="card flex-fill tickets-card">
            <div class="card-header">
              <div class="text-center w-100 p-3">
                <h3 class="bl-text mb-1" v-text="comissionapporteur"></h3>
                <h2>Commission apporteur</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <Bar :data="chartData"/>
        </div>
        <div class="col-md-6">
          <Bar :data="chartDonnees"/>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <Bar :data="chartGraphs"/>
        </div>

      </div>
    </div>
  </div>
</template>
<script>
import Header from "../layout/Header";
import Sidebar from "../layout/Sidebar";
import { Bar } from "vue-chartjs";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({
  /* options */
});
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale,
} from "chart.js";

ChartJS.register(
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale
);
export default {
  data() {
    return {
      isConnected: false,
      year: "",
      branch: "",
      contrat: "",
      prospect: "",
      sinistre: "",
      comissioncourtier: "",
      comissionapporteur: "",
      echeance: "",
      countemission: "",
      // compagnies:[],
      getYear: {},
      branches: {},
      chartData: {
        labels: [""],
        datasets: [
          {
            label: "Chiffre d'affaire par mois dans l'année",
            backgroundColor: "#f87979",
            data: [0],
          },
        ],
      },
      chartDonnees: {
        labels: [""],
        datasets: [
          {
            label: "Chiffres d'affaires par branche",
            backgroundColor: "#f87979",
            data: [0],
          },
        ],
      },

      chartGraphs: {
        labels: [""],
        datasets: [
          {
            label: "Chiffres d'affaires par compagnie",
            backgroundColor: "#f87979",
            data: [0],
          },
        ],
      },
    };
  },
  created() {
    this.getCategory();
    this.getTypes();
    this.getData();
  },
  name: "dashboard",
  components: { Header, Sidebar, Bar },
  // mounted() {
  //   // Vérifiez la connexion au montage
  //   this.checkInternetConnection();

  //   // Écoutez les changements de connexion
  //   this.$watch('isConnected', (newVal, oldVal) => {
  //     if (newVal !== oldVal) {
  //       this.notifyConnectionStatus();
  //     }
  //   });
  // },
  methods: {
    // async checkInternetConnection() {
    //   try {
    //     const response = await axios.get('https://www.example.com');
    //     this.isConnected = response.status === 200;
    //   } catch (error) {
    //     this.isConnected = false;
    //   }
    // },
    // notifyConnectionStatus() {
    //   // Utilisez toaster.success ou toaster.error en fonction de la connexion
    //   if (this.isConnected) {
    //     toaster.success('Vous êtes connecté à Internet');
    //   } else {
    //     toaster.error('Vous n\'êtes pas connecté à Internet');
    //   }
    // },

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

      const params = {
        year: this.year,
        branch: this.branch,
      };
  
      axios
        .get("/api/auth/stat/", {
          params: params,
          headers: headers,
        })
        .then((response) => {
          console.log(this.countemission)
          this.contrat = response.data.contrat;
          this.prospect = response.data.prospect;
          this.sinistre = response.data.sinistre;
          this.comissioncourtier = response.data.comissioncourtier;
          this.comissionapporteur = response.data.comissionapporteur;
          this.echeance = response.data.echeance;
          this.countemission = response.data.countemission;
          this.compagnies = response.data.compagnies;
          const labels = response.data.primes.map((prime) => prime.name);
          const data = response.data.primes.map((prime) => prime.y);

          const label = response.data.accesoires.map(
            (accesoire) => accesoire.name
          );

          const donnees = response.data.accesoires.map(
            (accesoire) => accesoire.y
          );

          const titre = response.data.compagnies.map(
            (compagnie) => compagnie.name
          );

          const graphs = response.data.compagnies.map(
            (compagnie) => compagnie.y
          );

          this.chartData = {
            labels: labels,
            datasets: [
              {
                label: "Chiffre d'affaire par mois dans l'année",
                backgroundColor: ['#123E6B', '#97B0C4', '#A5C8ED', '#F26D85', '#4CAF50', '#FFC107', '#9C27B0', '#FF5722', '#795548', '#009688'],
                data: data,
              },
            ],
          };

          this.chartDonnees = {
            labels: label,
            datasets: [
              {
                label: "Chiffres d'affaires par branche",
                backgroundColor: ['#123E6B', '#97B0C4', '#A5C8ED', '#F26D85', '#4CAF50', '#FFC107', '#9C27B0', '#FF5722', '#795548', '#009688'],
                data: donnees,
              },
            ],
          };

          this.chartGraphs = {
            labels: titre,
            datasets: [
              {
                label: "Chiffres d'affaires par compagnie",
                backgroundColor: ['#123E6B', '#97B0C4', '#A5C8ED', '#F26D85', '#4CAF50', '#FFC107', '#9C27B0', '#FF5722', '#795548', '#009688'],
                data: graphs,
              },
            ],
          };
        })
        .catch((error) => console.log(error));
    },


  },
};
</script>