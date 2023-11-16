<template>
  <div class="main-wrapper">
    <Header />

    <Sidebar />
    <div class="page-wrapper">
      <div class="content container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="page-head-box">
              <h3>Clients</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <router-link to="/home">
                      Tableau de bord
                    </router-link>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Client
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
              <a href="#" data-bs-toggle="modal" data-bs-target="#add_client" class="btn btn-success btn-add-emp"
                style="width: auto"><i class="fas fa-plus"></i> Ajouter client
              </a>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-row">
            <searchbranche :placeholder="'Rechercher un client'" v-model="q" @keyup="searchtask"></searchbranche>
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
                  <template v-for="(client, i) in clients" :key="i">
                    <tr>
                      <td v-text="client.nom_client"></td>
                      <td v-text="client.adresse_client"></td>
                      <td v-text="client.email_client"></td>
                      <td v-text="client.tel_client"></td>
                      <td v-text="client.profession_client"></td>
                      <td class="text-end ico-sec d-flex justify-content-end">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#edit_project"
                          @click="editClient(client.id_client)"><i class="fas fa-pen"></i></a>
                      </td>
                    </tr>
                  </template>
                </tbody>
              </table>
            </div>
            <addclient @client-add="refresh"></addclient>
            <editclient v-bind:clientoedit="clientoedit" @client-updated="refresh"></editclient>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Header from "../../layout/Header.vue";
import Sidebar from "../../layout/Sidebar.vue";
import addclient from "./addclient.vue";
import { getClientsList } from "../../services/clientservice";
import editclient from "./editclient.vue";
import searchbranche from "../../components/search/searchbranche.vue";
export default {
  name: "prospect",
  components: {
    Header,
    Sidebar,
    addclient,
    editclient,
    searchbranche
  },
  props: ["current_page", "last_page"],
  data() {
    return {
      value: null,
      clients: {},
      localisations: {},
      professions: {},
      q: "",
      clientoedit: ''
    };
  },
  created() {
    this.getClients();
  },
  methods: {
    getClients: function () {
      getClientsList().then((result) => {
        this.clients = result;
      });
    },
    editClient(id_client) {
      axios
        .get("/api/auth/editClient/" + id_client)
        .then((response) => {
          this.clientoedit = response.data;
        })
        .catch((error) => console.log(error));
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
            this.ajout_adresse = "";
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
            this.ajout_profession = "";
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

    searchtask() {
      const token = localStorage.getItem("token");

      // Configurez les en-têtes de la requête
      const headers = {
        Authorization: "Bearer " + token,
        "x-access-token": token,
      };

      if (this.q.length > 0) {
        axios
          .get("/api/auth/clientList/" + this.q, { headers })
          .then(
            (response) => (
              (this.clients = response.data.data), console.log(response.data)
            )
          )
          .catch((error) => console.log(error));
      } else {
        axios
          .get("/api/auth/clientList/", { headers })
          .then(
            (response) => (
              (this.clients = response.data), console.log(response.data)
            )
          )
          .catch((error) => console.log(error));
      }
    },

    refresh(clients) {
      this.clients = clients.data;
    }
  },
};
</script>
  
  
  