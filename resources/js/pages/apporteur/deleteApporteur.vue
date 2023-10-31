<template>
   <div class="modal custom-modal fade" id="delete_apporteur" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <div class="form-header">
            <h3>Supprimer apporteur</h3>
            <p>Voulez vous supprimer l'apporteur <b>{{ apporteurtoedit.nom_apporteur }}</b>?</p>
          </div>
          <div class="modal-btn delete-action">
            <div class="row">
              <div class="col-6">
                <a
                  href="javascript:void(0);"
                  class="btn btn-primary continue-btn"
                  data-bs-dismiss="modal"
                  @click.prevent="apporteurDelete"
                  >supprimer</a
                >
              </div>
              <div class="col-6">
                <a
                  href="javascript:void(0);"
                  data-bs-dismiss="modal"
                  class="btn btn-primary cancel-btn"
                  >Annuler</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["apporteurtoedit"],
  name: "deleteApporteur",
  methods: {
    apporteurDelete() {
      axios
      .patch("/api/auth/deleteApporteur/" + this.apporteurtoedit.id_apporteur)
        .then((response) => {
          this.$emit("apporteur-delete", response);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>