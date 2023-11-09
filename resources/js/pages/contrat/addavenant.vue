<template>
  <div id="add_avenant" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ajouter une emission</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <i class="fas fa-times"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Type</label>
                <typeavenantcomponent v-model="type" :placeholder="'selectionnez un type'"></typeavenantcomponent>
                <!-- <Multiselect v-model="type" :options="modes" placeholder="Choisir le mode" :searchable="true" /> -->
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label>Prime nette</label>
                <input type="number" class="form-control" placeholder="Entrez la prime nette" v-model="prime_nette" />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Accessoires</label>
                <input type="number" class="form-control" placeholder="Entrez ..." v-model="accessoires" />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Frais courtier</label>
                <input type="number" class="form-control" placeholder="Frais courtier" v-model="frais_courtier" />
              </div>
            </div>

            <div class="col-sm-12">
              <div class="form-group">
                <label>Taxes totales</label>
                <input type="number" class="form-control" placeholder="Taxes totales" v-model="taxes_totales" />
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label>Prime ttc</label>
                <input type="number" class="form-control" placeholder="Entrez la prime ttc" v-model="prime_ttc" />
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Date de debut</label>
            <input class="form-control" placeholder="Date de debut" type="date" v-model="date_debut" />
          </div>
          <div class="form-group">
            <label>Date de fin</label>
            <input class="form-control" placeholder="Date de fin" type="date" v-model="date_fin" />
          </div>
          <div class="submit-section">
            <button type="button" class="btn btn-primary cancel-btn" data-bs-dismiss="modal" aria-label="Close">
              Annuler
            </button>
            <button type="button" data-bs-dismiss="modal" class="btn btn-primary submit-btn" @click="addAvenant">
              Ajouter
            </button>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Multiselect from "@vueform/multiselect";
import typeavenantcomponent from '../../components/select/typeavenantcomponent.vue';
import { createToaster } from "@meforma/vue-toaster";
// import $ from "jquery";
const toaster = createToaster({
  /* options */
});
export default {
  components: { typeavenantcomponent },
  methods: {
    components: {
      Multiselect,
    },
    data() {
      return {

        type: "",
        prime_ttc: "",
        prime_nette: "",
        ristourne: "",
        retrocession: "",
        commission: "",
        prise_charge: "",
        date_emission: "",
        taxes_totales: "",
        frais_courtier: "",
        accessoires: "",
        date_debut: "",
        date_fin: "",

      };
    },
    addAvenant() {
      const token = localStorage.getItem("token");
      const userId = localStorage.getItem("id");
      const entrepriseId = localStorage.getItem("entreprise");

      axios
        .post("/api/auth/postAvenant", {
          type: this.type,
          prime_ttc: this.prime_ttc,
          retrocession: this.retrocession,
          prime_nette: this.prime_nette,
          commission: this.commission,
          ristourne: this.ristourne,
          accessoires: this.accessoires,
          frais_courtier: this.frais_courtier,
          prise_charge: this.prise_charge,
          date_emission: this.date_emission,
          taxes_totales: this.taxes_totales,
          date_debut: this.date_debut,
          date_fin: this.date_fin,
          id_contrat: this.$route.params.id_contrat,
          id_entreprise: entrepriseId,
          id: userId,
        })
        .then((response) => {
          this.$emit('avenant-add', response)
          toaster.success(`Avenant ajouté avec succès`, {
            position: "top-right",
          });
          this.type =
            this.prime_ttc = '',
            this.accessoires = '',
            this.prime_nette = '',
            this.commission = '',
            this.ristourne =
            this.prise_charge =
            this.date_emission =
            this.date_debut =
            this.date_fin =
            "";

        })
        .catch(() => {
          this.$toast.error(
            "Aveant Impossible, Veuillez renseigner tous les champs",
            {
              // override the global option
              position: "top-right",
            }
          );
        });
    },
  }
}
</script>
<style src="@vueform/multiselect/themes/default.css"></style>