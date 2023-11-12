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
                Listes des branches <em>{{ names.nom_prospect }}</em>
              </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="/home">Tableau de bord</a>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="/prospect">Listes des prospects</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Ajout
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
              <a
                href="#"
                data-bs-toggle="modal"
                data-bs-target="#add_prospect"
                class="btn btn-success btn-add-emp"
                style="width: auto"
                ><i class="fas fa-plus"></i> Ajouter des branches
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
                    <th>Commentaire</th>
                    <th class="text-end">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- <template v-for="prospect in prospects" :key="prospect.id_prosbranche">
                                        <tr>
                                            <td v-text="prospect.nom_branche"></td>
                                            <td v-text="prospect.description"></td>
                                            <td class="text-end ico-sec d-flex justify-content-end">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#edit_department"
                                                     title="Modifier"><i
                                                        class="fas fa-pen"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </template> -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <addprospectbranche></addprospectbranche>
  <editprospectbranche></editprospectbranche>
</template>
<script>
import Header from "../../layout/Header.vue";
import Sidebar from "../../layout/Sidebar.vue";
import editprospectbranche from "../prospect/editprospectbranche.vue";
import addprospectbranche from "../prospect/addprospectbranche.vue";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({
  /* options */
});
export default {
  name: "detailsprospect",
  components: {
    Header,
    Sidebar,
    editprospectbranche,
    addprospectbranche,
  },
  data() {
    return {
      names: "",
      prospects: {},
    };
  },
  methods: {
    fetchData() {
      var that = this;
      let myParam = this.$route.params.id_prospect;
      axios
        .all([
          axios.get("/api/auth/getBrancheProspect?prospect=" + myParam),
          axios.get("/api/auth/getNameProspect?prospect=" + myParam),
        ])
        .then(
          axios.spread(function (prospects,names) {
            that.prospects = prospects.data;
            that.names = names.data;
          })
        );
    },
  },
  created() {
    this.fetchData();
  },
};
</script>

    