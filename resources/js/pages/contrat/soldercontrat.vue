<template>
  <div class="modal custom-modal fade" id="solder_contrat" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <div class="form-header">
            <h3>Solder contrat</h3>
            <p>Le contrat est il solde ?</p>
          </div>
          <div class="modal-btn delete-action">
            <div class="row">
              <div class="col-6">
                <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary continue-btn"
                  @click="ChangeSolde">Solder</a>
              </div>
              <div class="col-6">
                <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary cancel-btn">Annuler</a>
              </div>
            </div>
          </div>
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
  props: ["avenantoedit"],
  methods: {
    ChangeSolde() {
      axios
        .post("/api/auth/soldeAvenant", {
          id_avenant: this.avenantoedit.id_avenant,
        })
        .then((response) => {
          this.$emit('avenant-solder', response)
          if (response.status === 200) {
            toaster.success(`Avenant solde`, {
              position: "top-right",
            });
          }
        });
    },

  }
}
</script>