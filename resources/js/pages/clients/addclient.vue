<template>
  <div id="add_client" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ajouter client</h5>
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
                    v-model="civilite"
                  ></civilitecomponent>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Nom complet du client</label>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Entrez le nom du client"
                    v-model="nom_client"
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
                    v-model="postal_client"
                  />
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Téléphone</label>
                  <inputText
                    :placeholder="'téléphone'"
                    v-model="tel_client"
                  ></inputText>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-9 adresse">
                <div class="form-group">
                  <label>Adresse</label>
                  <adressecomponent
                    :placeholder="'selectionnez l\'adresse'"
                    v-model="adresse_client"
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
                    v-model="profession_client"
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
                    v-model="email_client"
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
                v-model="fax_client"
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
                @click="storeClient"
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
import inputText from "../../components/input/inputText.vue";
import { createToaster } from "@meforma/vue-toaster";
// import $ from "jquery";
const toaster = createToaster({
  /* options */
});
export default {
  components: {
    adressecomponent,
    professioncomponent,
    civilitecomponent,
    inputText,
  },
  data() {
    return {
      civilite: "",
      civil: "",
      nom_client: "",
      prenom_client: "",
      postal_client: "",
      adresse_client: "",
      adresse: "",
      email_client: "",
      tel_client: "",
      profession_client: "",
      profession: "",
      fax_client: "",
      clientoedit: "",
      ajout_adresse: "",
      ajout_profession: "",
    };
  },
  methods: {
    storeClient() {
      const token = localStorage.getItem("token");
      const userId = localStorage.getItem("id");
      const entrepriseId = localStorage.getItem("entreprise");
      axios
        .post("/api/auth/postClient", {
          civilite: this.civilite,
          nom_client: this.nom_client,
          prenom_client: this.prenom_client,
          postal_client: this.postal_client,
          adresse_client: this.adresse_client,
          tel_client: this.tel_client,
          profession_client: this.profession_client,
          fax_client: this.fax_client,
          email_client: this.email_client,
          id: userId,
          id_entreprise: entrepriseId,
        })
        .then((response) => {
          // this.$emit('client-add', response)
          this.$emit('client-added', response.data);
          this.civilite =
            this.nom_client =
            this.prenom_client =
            this.postal_client =
            this.adresse_client =
            this.tel_client =
            this.profession_client =
            this.fax_client =
            this.email_client =
              "";
          if (response.status === 200) {
            toaster.success(`Client ajouté avec succès`, {
              position: "top-right",
            });
          }
        })
        .catch((error) => {
          console.log(error.response.headers);

          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
            toaster.error(`Veuillez remplir les champs`, {
              position: "top-right",
            });
            // console.log("Message non enregisté")
          } else if (error.request) {
            // The request was made but no response was received
            console.log(error.request);
          } else {
            // Something happened in setting up the request that triggered an Error
            console.log("Error", error.message);
          }
        });
    },
  },
};
</script>