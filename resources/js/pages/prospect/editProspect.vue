<template>
  <div id="edit_department" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modifier prospect</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <i class="fas fa-times"></i>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Civilite</label>
                  <civilitecomponent :placeholder="'selectionnez une civilité'" v-model="prospectoedit.civilite">
                  </civilitecomponent>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Nom complet du prospect</label>
                  <input type="text" class="form-control" v-model="prospectoedit.nom_prospect" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Boîte postal</label>
                  <input type="text" class="form-control" v-model="prospectoedit.postal_prospect" />
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Telephone</label>
                  <input type="text" class="form-control" v-model="prospectoedit.tel_prospect" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-8 adresse">
                <div class="form-group">
                  <label>Adresse</label>
                  <adressecomponent :placeholder="'selectionnez l\'adresse'" v-model="prospectoedit.adresse_prospect">
                  </adressecomponent>
                </div>
              </div>
              <div class="col-md-4 ajout">
                <button type="button" style="margin-top: 25px" class="btn btn-primary">
                  Ajouter
                </button>
              </div>
              <div class="col-md-8 form1" style="display: none">
                <div>
                  <label>Adresse</label>
                  <input type="text" class="form-control" placeholder="Entrez une nouvelle adresse"
                    v-model="ajout_adresse" />
                </div>
              </div>
              <div class="col-md-2 form2" style="display: none">
                <div>
                  <button type="button" class="btn btn-primary" style="margin-top: 25px" @click="storeAdresse">
                    Ajouter
                  </button>
                </div>
              </div>
              <div class="col-sm-8 profession">
                <div class="form-group">
                  <label>Profession</label>
                  <professioncomponent :placeholder="'selectionnez une profession'"
                    v-model="prospectoedit.profession_prospect"></professioncomponent>
                </div>
              </div>
              <div class="col-md-4 ajouter">
                <button type="button" style="margin-top: 25px" class="btn btn-primary">
                  Ajouter
                </button>
              </div>
              <div class="col-md-8 form3" style="display: none">
                <label>Profession</label>
                <input type="text" class="form-control" placeholder="Entrez une nouvelle profession"
                  v-model="ajout_profession" />
              </div>
              <div class="col-md-2 form4" style="display: none">
                <div>
                  <button type="button" class="btn btn-primary" style="margin-top: 25px" @click="storeProfession">
                    Ajouter
                  </button>
                </div>
              </div>
            </div>
            <div class="submit-section">
              <button class="btn btn-primary cancel-btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                Annuler
              </button>
              <button class="btn btn-primary submit-btn" type="button" data-bs-dismiss="modal" @click="editApporteur">
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
import Multiselect from "@vueform/multiselect";
import civilitecomponent from "../../components/select/civilitecomponent.vue";
import adressecomponent from "../../components/select/adressecomponent.vue";
import professioncomponent from "../../components/select/professioncomponent.vue";
import AppStorage from '../../utils/helpers/AppStorage';
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({
  /* options */
});
export default {
  props: ["prospectoedit"],
  components: { Multiselect, civilitecomponent, adressecomponent, professioncomponent },
  methods: {
    async editProspect() {
      const response = await fetch(
        "/api/check-internet-connection"
      );

      const data = await response.json();

      this.isConnected = data.connected;
      if (this.isConnected) {
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
      } else {

        const uuidProspectToUpdate = this.prospectoedit.uuidProspect;

        const nouvellesInfos = {
          civilite: this.prospectoedit.civilite,
          nom_prospect: this.prospectoedit.nom_prospect,
          postal_prospect: this.prospectoedit.postal_prospect,
          adresse_prospect: this.prospectoedit.adresse_prospect,
          tel_prospect: this.prospectoedit.tel_prospect,
          profession_prospect: this.prospectoedit.profession_prospect,
          email_prospect: this.prospectoedit.email_prospect,
          fax_prospect: this.prospectoedit.fax_prospect,
          etat: nouveauEtat,
          sync: 0,
        };

        const prospectMisAJour = await AppStorage.updateProspect(uuidProspectToUpdate, nouvellesInfos);


        toaster.success(`Propect modifié avec succès (Hors ligne)`, {
          position: "top-right",
        });


      }
    },
  },
};
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
