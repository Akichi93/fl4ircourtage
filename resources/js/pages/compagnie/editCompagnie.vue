<template>
    <div id="edit_department" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modifier compagnie</h5>
          <button
            type="button"
            class="close"
            data-bs-dismiss="modal"
            aria-label="Close"
          >
            <i class="fas fa-times"></i>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Nom complet de la compagnie</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="compagniestoedit.nom_compagnie"
                  />
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Email</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="compagniestoedit.email_compagnie"
                  />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Contact</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="compagniestoedit.contact_compagnie"
                  />
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Ville</label>
                  <Multiselect
                    v-model="compagniestoedit.adresse_compagnie"
                    :options="localisations"
                    :custom-label="
                      ({ id_localisation, nom_ville }) =>
                        `${id_localisation} - [${nom_ville}]`
                    "
                    valueProp="nom_ville"
                    placeholder="Selectionnez zone"
                    label="nom_ville"
                    track-by="nom_ville"
                    :searchable="true"
                  >
                  </Multiselect>
                </div>
              </div>
            </div>
            <div class="submit-section">
              <button
                class="btn btn-primary cancel-btn"
                type="button"
                data-bs-dismiss="modal"
                aria-label="Close"
              >
                Annuler
              </button>
              <button
                class="btn btn-primary submit-btn"
                type="button"
                data-bs-dismiss="modal"
            
              >
                Modifier
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default{
    props: [compagniestoedit]
}
</script>