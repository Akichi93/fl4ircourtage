<template>
  <div class="modal custom-modal fade" id="change_statut" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <div class="form-header">
            <h3>Changer d'etat</h3>
            <p>Vous êtes sur le point de changer l'etat?</p>
          </div>
          <div class="modal-btn delete-action">
            <input
              type="hidden"
              class="form-control"
              v-model="prospectoedit.id_prospect"
            />
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <Multiselect
                    v-model="etat"
                    :options="etats"
                    placeholder="Choisir un etat"
                    :searchable="true"
                    class="form-control"
                  />
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <a
                  href="javascript:void(0);"
                  data-bs-dismiss="modal"
                  class="btn btn-primary continue-btn"
                  >Annuler</a
                >
              </div>
              <div class="col-6">
                <a
                  href="javascript:void(0);"
                  data-bs-dismiss="modal"
                  class="btn btn-primary cancel-btn"
                  @click="ChangeEtat"
                  >Valider</a
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
  props: ["prospectoedit"],
  name: "changeProspect",
  methods: {
    ChangeEtat() {
      axios
        .patch("/api/auth/etatProspect/" + this.prospectoedit.id_prospect, {
          etat: this.etat,
        })
        .then((response) => {
          this.listprospect();
          if (response.status === 200) {
            toaster.success(`Etat changé`, {
              position: "top-right",
            });
            // this.prospects = response.data;
            // this.fetchTask();
          }
        });
    },
  },
};
</script>

<!--  -->
