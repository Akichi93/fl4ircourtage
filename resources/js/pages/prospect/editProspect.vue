<template>
  <div id="edit_department" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modifier prospect</h5>
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
                  <label>Civilite</label>
                  <Multiselect
                    v-model="prospectoedit.civilite"
                    :options="valeurs"
                    placeholder="Choisir une civilité"
                    :searchable="true"
                  />
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Nom complet du prospect</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="prospectoedit.nom_prospect"
                  />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Boîte postal</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="prospectoedit.postal_prospect"
                  />
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Telephone</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="prospectoedit.tel_prospect"
                  />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-8 adresse">
                <div class="form-group">
                  <label>Adresse</label>
                  <Multiselect
                    v-model="prospectoedit.adresse_prospect"
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
              <div class="col-md-4 ajout">
                <button
                  type="button"
                  style="margin-top: 25px"
                  class="btn btn-primary"
                >
                  Ajouter
                </button>
              </div>
              <div class="col-md-8 form1" style="display: none">
                <div>
                  <label>Adresse</label>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Entrez une nouvelle adresse"
                    v-model="ajout_adresse"
                  />
                </div>
              </div>
              <div class="col-md-2 form2" style="display: none">
                <div>
                  <button
                    type="button"
                    class="btn btn-primary"
                    style="margin-top: 25px"
                    @click="storeAdresse"
                  >
                    Ajouter
                  </button>
                </div>
              </div>
              <div class="col-sm-8 profession">
                <div class="form-group">
                  <label>Profession</label>
                  <Multiselect
                    v-model="prospectoedit.profession_prospect"
                    :options="professions"
                    :custom-label="
                      ({ id_profession, profession }) =>
                        `${id_profession} - [${profession}]`
                    "
                    valueProp="profession"
                    placeholder="Choisir une profession"
                    label="profession"
                    track-by="profession"
                    :searchable="true"
                  >
                  </Multiselect>
                </div>
              </div>
              <div class="col-md-4 ajouter">
                <button
                  type="button"
                  style="margin-top: 25px"
                  class="btn btn-primary"
                >
                  Ajouter
                </button>
              </div>
              <div class="col-md-8 form3" style="display: none">
                <label>Profession</label>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Entrez une nouvelle profession"
                  v-model="ajout_profession"
                />
              </div>
              <div class="col-md-2 form4" style="display: none">
                <div>
                  <button
                    type="button"
                    class="btn btn-primary"
                    style="margin-top: 25px"
                    @click="storeProfession"
                  >
                    Ajouter
                  </button>
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
                @click="editApporteur"
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
export default {
  props: ["prospectoedit"],
  methods: {
    editProspect() {
      axios
        .patch("/api/auth/updateProspect/" + this.prospectoedit.id_prospect, {
          civilite: this.prospectoedit.civilite,
          nom_prospect: this.prospectoedit.nom_prospect,
          postal_prospect: this.prospectoedit.postal_prospect,
          adresse_prospect: this.prospectoedit.adresse_prospect,
          tel_prospect: this.prospectoedit.tel_prospect,
          profession_prospect: this.prospectoedit.profession_prospect,
          email_prospect: this.prospectoedit.email_prospect,
          fax_prospect: this.prospectoedit.fax_prospect,
        })
        .then((response) => {
          if (response.status === 200) {
            toaster.success(`Propect modifié avec succès`, {
              position: "top-right",
            });
          }
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
            toaster.error(
              `Propect non modifié . Veuillez remplir les champs demandé`,
              {
                position: "top-right",
                duration: 4000,
              }
            );
          }
        });
    },
  },
};
</script>

<!--  -->