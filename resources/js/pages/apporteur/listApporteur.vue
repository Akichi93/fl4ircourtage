<template>
  <div class="main-wrapper">
    <Header />

    <Sidebar />
    <div class="page-wrapper">
      <div class="content container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="page-head-box">
              <h3>Apporteurs</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="/home">Tableau de bord</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Apporteur
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
                <router-link
                to="/createapporteur"
                class="btn btn-success btn-add-emp"
                style="width: auto"
              >
                Ajouter apporteur
              </router-link>
            </div>
          </div>
        </div>

        <div class="row">
          <searchbranche
            :placeholder="'Rechercher un apporteur'"
            v-model="q"
            @keyup="searchtask"
          ></searchbranche>
          <div class="col-md-12">
            <div class="table-responsive">
              <table
                id="tbl_exporttable_to_xls"
                class="table table-striped custom-table mb-0"
              >
                <thead>
                  <tr>
                    <th>Code</th>
                    <th>Nom et prenom de l'apporteur</th>
                    <th>Code postal</th>
                    <th>ville</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <template
                    v-for="apporteur in apporteurs.data"
                    :key="apporteur.id_apporteur"
                  >
                    <tr>
                      <td v-text="apporteur.code_apporteur"></td>
                      <td v-text="apporteur.nom_apporteur"></td>
                      <td v-text="apporteur.code_postal"></td>
                      <td v-text="apporteur.adresse_apporteur"></td>
                      <td v-text="apporteur.contact_apporteur"></td>
                      <td v-text="apporteur.email_apporteur"></td>
                      <td class="text-end ico-sec d-flex justify-content-end">
                        <a
                          href="#"
                          @click="modifTaux(apporteur.id_apporteur)"
                          title="Modifier les taux"
                          ><i class="fa fa-pen-fancy"></i>
                        </a>
                        <a
                          href="#"
                          data-bs-toggle="modal"
                          data-bs-target="#edit_department"
                          @click="getApporteur(apporteur.id_apporteur)"
                          title="Modifier"
                          ><i class="fas fa-pen"></i>
                        </a>
                        <a
                          v-if="roles == 'ADMIN'"
                          href="#"
                          data-bs-toggle="modal"
                          data-bs-target="#delete_apporteur"
                          @click="getApporteur(apporteur.id_apporteur)"
                          title="supprimer"
                          ><i class="fas fa-trash-alt"></i>
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
    </div>
  </div>

  

 
</template>
<script>
import LaravelVuePagination from "laravel-vue-pagination";
import Header from "../../layout/Header.vue";
import Sidebar from "../../layout/Sidebar.vue";
import searchbranche from "../../components/search/searchbranche.vue";

export default {
  components: {
    Pagination: LaravelVuePagination,
    Header,
    Sidebar,
    searchbranche
  },
  data() {
    return {
      value: null,
      apporteurs: {},
      localisations: {},
      apporteurstoedit: "",
      q: "",
      roles: "",
    };
  },
  created() {
    this.fetchData();
    this.listapporteur();
    this.getRole();
  },
  mounted() {
    this.fetchData();
    this.listapporteur();
    this.getRole();
  },

  methods: {
    getApporteur(id_apporteur) {
      axios
        .get("/editApporteur/" + id_apporteur)
        .then((response) => (this.apporteurstoedit = response.data))
        .catch((error) => console.log(error));
    },

    listapporteur(page = 1) {
      axios.get("/apporteurList?page=" + page).then((response) => {
        this.apporteurs = response.data;
      });
    },

    // modifTaux(id) {
    //   window.location.href = "/modifapporteur?apporteur=" + id;
    // },

    editApporteur() {
      axios
        .patch("/updateApporteur/" + this.apporteurstoedit.id_apporteur, {
          nom_apporteur: this.apporteurstoedit.nom_apporteur,
          email_apporteur: this.apporteurstoedit.email_apporteur,
          contact_apporteur: this.apporteurstoedit.contact_apporteur,
          adresse_apporteur: this.apporteurstoedit.adresse_apporteur,
          code_postal: this.apporteurstoedit.code_postal,
        })
        .then((response) => {
          this.listapporteur();
          if (response.status === 200) {
            toaster.success(`Apporteur modifié avec succès`, {
              position: "top-right",
            });
          }
        })
        .catch((error) => console.log(error));
    },

    getRole() {
      axios
        .get("/getrole")
        .then((response) => {
          this.roles = response.data;
        })
        .catch((error) => console.log(error));
    },

   

    deleteApporteur() {
      axios
        .patch("/deleteApporteur/" + this.apporteurstoedit.id_apporteur)
        .then((response) => {
          this.listapporteur();
          if (response.status === 200) {
            toaster.success(`Apporteur supprimé avec succes`, {
              position: "top-right",
            });
          }
        })
        .catch((error) => console.log(error));
    },

    searchtask() {
      axios
        .get("/apporteurList/" + this.q)
        .then((response) => (this.apporteurs = response.data))
        .catch((error) => console.log(error));
    },
  },
};
</script>

<style scoped>
.pagination {
  margin-bottom: 0;
}

.curseur:hover {
  cursor: grab;
}
</style>

