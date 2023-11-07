<template>
  <div id="edit_project" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modifier client</h5>
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
                  <label>Civilité</label>
                  <civilitecomponent
                    :placeholder="'selectionnez une civilité'"
                    v-model="clientoedit.civilite"
                  ></civilitecomponent>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Nom complet du client</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="clientoedit.nom_client"
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
                    placeholder="Entrez la boîte postale"
                    v-model="clientoedit.postal_client"
                  />
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Téléphone</label>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Numéro de téléphone"
                    v-model="clientoedit.tel_client"
                  />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-9 adresse">
                <div class="form-group">
                  <label>Adresse</label>
                  <adressecomponent
                    :placeholder="'selectionnez l\'adresse'"
                    v-model="clientoedit.adresse_client"
                  ></adressecomponent>
                </div>
              </div>
              <div class="col-sm-3 ajout">
                <div class="form-group">
                  <button
                    type="button"
                    style="margin-top: 25px"
                    class="btn btn-primary"
                  >
                    Ajouter
                  </button>
                </div>
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
            </div>
            <div class="row">
              <div class="col-sm-9 profession">
                <div class="form-group">
                  <label>Profession</label>
                  <professioncomponent
                    :placeholder="'selectionnez une profession'"
                    v-model="clientoedit.profession_client"
                  ></professioncomponent>
                </div>
              </div>
              <div class="col-sm-3 ajouter">
                <div class="form-group">
                  <button
                    type="button"
                    style="margin-top: 25px"
                    class="btn btn-primary"
                  >
                    Ajouter
                  </button>
                </div>
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
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Email</label>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Email du client"
                    v-model="clientoedit.email_client"
                  />
                </div>
              </div>
            </div>

            <div class="form-group">
              <label>Fax</label>
              <input
                type="text"
                class="form-control"
                placeholder="fax du client"
                v-model="clientoedit.fax_client"
              />
            </div>
            <div class="submit-section">
              <button
                type="button"
                class="btn btn-primary cancel-btn"
                data-bs-dismiss="modal"
                aria-label="Close"
              >
                Annuler
              </button>
              <button
                type="button"
                class="btn btn-primary submit-btn"
                @click="editClient"
                data-bs-dismiss="modal"
              >
                Ajouter
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import adressecomponent from "../../components/select/adressecomponent.vue";
import professioncomponent from "../../components/select/professioncomponent.vue";
import civilitecomponent from "../../components/select/civilitecomponent.vue";
export default {
  props: ["clientoedit"],
  name: "editclient",
  components: {
    adressecomponent,
    professioncomponent,
    civilitecomponent,
  },
  methods: {
    editClient() {
      axios
        .patch("/api/auth/updateClient/" + this.clientoedit.id_client, {
          civilite: this.clientoedit.civilite,
          nom_client: this.clientoedit.nom_client,
          postal_client: this.clientoedit.postal_client,
          adresse_client: this.clientoedit.adresse_client,
          tel_client: this.clientoedit.tel_client,
          profession_client: this.clientoedit.profession_client,
          fax_client: this.clientoedit.fax_client,
          email_client: this.clientoedit.email_client,
        })
        .then((response) => {
          if (response.status === 200) {
            // toaster.success(`Client modifié avec succès`, {
            //   position: "top-right",
            // });
            this.taches = response.data;
          }
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
            toaster.error(
              `Client non modifié . Veuillez remplir les champs demandé`,
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