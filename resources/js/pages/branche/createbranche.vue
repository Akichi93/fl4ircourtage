<template>
  <div class="main-wrapper">
    <Header />

    <Sidebar />
    <div class="page-wrapper">
      <div class="content container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="page-head-box">
              <h3>Création de branche</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="/home">Tableau de bord</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Branches
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xl-12 d-flex">
            <div class="card flex-fill">
              <div class="card-header">
                <h4 class="card-title mb-0">Branches</h4>
              </div>
              <div class="card-body">
                <form action="#">
                  <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Nom de branche</label>
                    <div class="col-lg-9">
                      <input type="text" v-model="form.nom_branche" class="form-control" />
                    </div>
                  </div>

                  <div class="text-end">
                    <button type="submit" class="btn btn-primary" @click.prevent="storeBranche">
                      Créer
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
import { postBranche } from "../../services/brancheservice";
import { useBranchesStore } from "../../store/branche";
import { createToaster } from "@meforma/vue-toaster";

const toaster = createToaster({
  /* options */
});

export default {
  components: { Header, Sidebar },

  data() {
    return {
      form: {
        nom_branche: null,
      },
    };
  },
  methods: {
    async storeBranche() {
      const branchesStore = useBranchesStore();
      try {
        const response = await postBranche(this.form);
        console.log(response);

        // Utilisez le magasin Pinia pour ajouter la branche
        branchesStore.addBranch(response);


        // Appeler fetchClients pour récupérer la liste mise à jour après l'insertion
        const updatedBranches = await this.fetchBranches();

        // Mettre à jour IndexedDB avec les clients récupérés
        await AppStorage.storeDataInIndexedDB("branches", updatedBranches);

        this.$router.push("/listbranche");
        toaster.success(`Branche ajoutée avec succès`, {
          position: "top-right",
        });


      } catch (error) {
        console.error("Erreur lors de l'ajout de la branche", error);
      }
    },

    // Votre méthode actuelle fetchClients
    async fetchBranches() {
      const token = AppStorage.getToken();

      // Configurez les en-têtes de la requête
      const headers = {
        Authorization: "Bearer " + token,
        "x-access-token": token,
      };

      try {
        const response = await axios.get("/api/auth/getBranche", { headers });

        // Vous pouvez traiter les données comme vous le souhaitez
        const branches = response.data;

        // Retourner les clients pour une utilisation éventuelle
        return branches;
      } catch (error) {
        console.error("Erreur lors de la récupération des clients sur le serveur", error);
      }
    },
  },
};
</script>
