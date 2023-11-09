<template>
    <div class="modal custom-modal fade" id="reverser_contrat" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <div class="form-header">
            <h3>Reverser contrat</h3>
            <p>Le contrat est il reversé ?</p>
          </div>
          <div class="modal-btn delete-action">
            <div class="row">
              <div class="col-6">
                <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary continue-btn"
                  @click="ChangeReverse">Reverser</a>
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
    ChangeReverse() {
      axios
        .post("/api/auth/reverseAvenant", {
          id_avenant: this.avenantoedit.id_avenant,
        })
        .then((response) => {
          this.$emit('avenant-reverser', response)
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