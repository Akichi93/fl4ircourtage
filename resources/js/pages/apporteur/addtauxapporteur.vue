<template>
    <div id="add_taux" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label></label>
                                    <input type="number" class="form-control" placeholder="Entrez le taux"
                                         />
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary cancel-btn" data-bs-dismiss="modal"
                                aria-label="Close">Annuler</button>
                            <button class="btn btn-primary submit-btn" type="button"
                                data-bs-dismiss="modal">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { createToaster } from "@meforma/vue-toaster";
// import $ from "jquery";
const toaster = createToaster({
  /* options */
});
export default {
  name: "edittaux",
  data() {
    return {
      value: null,
      // get fetchTask
      apporteurs: {},
      tauxtoedit: "",
      names: "",
      branches: {},
      accidents: [],

      ids: [],
    };
  },
  methods: {
    viewRoute() {
      let urlParams = new URLSearchParams(window.location.search);
      let myParam = urlParams.get("apporteur");
      this.id_apporteur = myParam;
    },

    getTaux(id_tauxapp) {
      axios
        .get("/editTauxApporteur/" + id_tauxapp)
        .then((response) => (this.tauxtoedit = response.data))
        .catch((error) => console.log(error));
    },

    getauto() {
      let urlParams = new URLSearchParams(window.location.search);
      let myParam = urlParams.get("apporteur");
      axios
        .get("/getTauxApporteur?apporteur=" + myParam)
        .then((response) => {
          // this.loading = true;
          this.apporteurs = response.data;
          // console.log(response.data);
        })
        .catch((error) => {
          // this.loading = false;
          this.error = error.response.data.message || error.message;
        });
    },

    getname() {
      let urlParams = new URLSearchParams(window.location.search);
      let myParam = urlParams.get("apporteur");
      axios
        .get("/getNameApporteur?apporteur=" + myParam)
        .then((response) => {
          // this.loading = true;
          this.names = response.data;
          // console.log(response.data);
        })
        .catch((error) => {
          // this.loading = false;
          this.error = error.response.data.message || error.message;
        });
    },


    getbranche() {
      let urlParams = new URLSearchParams(window.location.search);
      let myParam = urlParams.get("apporteur");
      axios
        .get("/getBrancheDiffApporteur?apporteur=" + myParam)
        .then((response) => {
          this.branches = response.data;
        })
        .catch((error) => {
          // this.loading = false;
          this.error = error.response.data.message || error.message;
        });
    },
    
    editTaux() {
      axios
        .post("updateTauxApporteur", {
          id_tauxapp: this.tauxtoedit.id_tauxapp,
          taux: this.tauxtoedit.taux,
        })
        .then((response) => {
          this.getauto();

          if (response.status === 200) {
            toaster.success("Taux modifié", {
              position: "top-right",
            });
          }
        });
    },

    addTaux() {
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
        .post("postTauxApporteur", {
          name: this.names.nom_apporteur,
          taux: this.tauxtoedit.taux,
          accidents: donnees,
          ids: datas,
        })
        .then((response) => {
          this.getauto();
          this.getbranche();
          if (response.status === 200) {
            toaster.success("Taux ajouté", {
              position: "top-right",
            });
          }
        });
    },


  },
  created() {
    this.getTaux();
    this.viewRoute();
    this.getauto();
    this.getname();
    this.getbranche();
  },
  mounted() {
    this.getauto();
  },
};
</script>
