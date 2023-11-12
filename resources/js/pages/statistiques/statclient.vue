<template>
  <div class="main-wrapper">
    <Header />

    <Sidebar />

    <div class="page-wrapper">
      <div class="content container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="page-head-box">
              <h3>Synthese</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="/home">Tableau de bord</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Synthese
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-striped custom-table mb-0">
                <thead>
                  <tr>
                    <th>Nom du cient</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Profession</th>
                    <th>Adresse</th>
                  </tr>
                </thead>
                <tbody>
                  <template
                    v-for="(client, index) in clients"
                    :key="index"
                  >
                    <tr>
                      <td>
                        <router-link :to="{
                          name: 'infoclient',
                          params: { id_client: client.id_client },

                        }">{{ client.nom_client }}</router-link>
                      </td>
                      <td v-text="client.email_client"></td>
                      <td v-text="client.tel_client"></td>
                      <td v-text="client.profession_client"></td>
                      <td v-text="client.adresse_client"></td>                    
                    </tr>
                  </template>
                </tbody>
              </table>
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
export default {
  name: "statclient",
  components: {
    Header,
    Sidebar,
  },
  data() {
    return {
      clients: {},
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      const token = localStorage.getItem("token");

      // Configurez les en-têtes de la requête
      const headers = {
        Authorization: "Bearer " + token,
        "x-access-token": token,
      };
      axios
        .get("/api/auth/synthese", { headers })
        .then((response) => {
          this.clients = response.data;
          console.log(response.data);
        })
        .catch((error) => {
          this.error = error.response.data.message || error.message;
        });
    },
  },
};
</script>