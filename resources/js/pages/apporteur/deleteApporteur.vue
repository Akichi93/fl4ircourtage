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

  name: "deletebranche",
  data() {
    return {
      branches: {},
    };
  },
  methods: {
    brancheDelete() {
      axios
      .patch("/deleteApporteur/" + this.apporteurtoedit.id_apporteur)
        .patch("/api/auth/deleteBranche/" + this.branchetoedit.id_branche, {
          nom_branche: this.branchetoedit.nom_branche,
        })
        .then((response) => {
          this.$emit("task-delete", response);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>