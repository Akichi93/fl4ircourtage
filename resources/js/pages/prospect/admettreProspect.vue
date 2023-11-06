<template>
  <div class="modal custom-modal fade" id="delete_project" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <div class="form-header">
            <h3>Admettre comme client</h3>
            <p>Vous êtes sur le point d'admettre le prospect comme client?</p>
          </div>
          <div class="modal-btn delete-action">
            <input
              type="hidden"
              class="form-control"
              v-model="prospectoedit.id_prospect"
            />
            <input
              type="hidden"
              class="form-control"
              v-model="prospectoedit.nom_prospect"
            />
            <input
              type="hidden"
              class="form-control"
              v-model="prospectoedit.civilite"
            />
            <input
              type="hidden"
              class="form-control"
              v-model="prospectoedit.postal_prospect"
            />
            <input
              type="hidden"
              class="form-control"
              v-model="prospectoedit.adresse_prospect"
            />
            <input
              type="hidden"
              class="form-control"
              v-model="prospectoedit.tel_prospect"
            />
            <input
              type="hidden"
              class="form-control"
              v-model="prospectoedit.profession_prospect"
            />
            <input
              type="hidden"
              class="form-control"
              v-model="prospectoedit.email_prospect"
            />
            <input
              type="hidden"
              class="form-control"
              v-model="prospectoedit.fax_prospect"
            />
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
                  @click="ChangeProspect"
                  >Admettre</a
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
  props: ['prospectoedit'],
  name: "admettreProspect",
  methods: {
    ChangeProspect() {
      axios
        .post("/validateProspect", {
          id_prospect: this.prospectoedit.id_prospect,
          civilite: this.prospectoedit.id_prospect,
          nom_prospect: this.prospectoedit.nom_prospect,
          email_prospect: this.prospectoedit.email_prospect,
          tel_prospect: this.prospectoedit.tel_prospect,
          postal_prospect: this.prospectoedit.postal_prospect,
          adresse_prospect: this.prospectoedit.adresse_prospect,
          fax_prospect: this.prospectoedit.fax_prospect,
          profession_prospect: this.prospectoedit.profession_prospect,
        })
        .then((response) => {
          this.listprospect();
          if (response.status === 200) {
            toaster.success(`Nouveau client enregistré`, {
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


<!-- -->