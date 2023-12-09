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
            <div class="col-sm-12">
              <div class="form-group">
                <label>Adresse</label>
                <adressecomponent
                  :placeholder="'selectionnez l\'adresse'"
                  v-model="adresse_client"
                ></adressecomponent>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Profession</label>
                <professioncomponent
                  :placeholder="'selectionnez une profession'"
                  v-model="profession_client"
                >
                </professioncomponent>
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
import AppStorage from "../../utils/helpers/AppStorage";
import { createToaster } from "@meforma/vue-toaster";
import { openDB } from "idb";
import axios from "axios"; // Importer axios pour les requêtes HTTP

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
      nom_client: "",
      postal_client: "",
      adresse_client: "",
      email_client: "",
      tel_client: "",
      profession_client: "",
      fax_client: "",
    };
  },
  methods: {
    async storeClient() {
      const userId = AppStorage.getId();
      const entrepriseId = AppStorage.getEntreprise();

      try {
        const response = await axios.post("/api/auth/postClient", {
          civilite: this.civilite,
          nom_client: this.nom_client,
          postal_client: this.postal_client,
          adresse_client: this.adresse_client,
          tel_client: this.tel_client,
          profession_client: this.profession_client,
          fax_client: this.fax_client,
          email_client: this.email_client,
          id: userId,
          id_entreprise: entrepriseId,
        });

        await this.insertDataIntoIndexedDB(response.data, "clients");
        this.$emit("client-added", response);
        this.$emit("client-add", response.data);

        if (response.status === 200) {
          toaster.success(`Client ajouté avec succès`, {
            position: "top-right",
          });
        }
      } catch (error) {
        console.error("Erreur lors de l'ajout du client sur le serveur", error);
      }
    },

    async insertDataIntoIndexedDB(clientData, objectStoreName) {
      try {
        const db = await openDB("your_database_name", 1, {
          upgrade(db, oldVersion, newVersion, transaction) {
            if (!db.objectStoreNames.contains(objectStoreName)) {
              const store = db.createObjectStore(objectStoreName, {
                keyPath: "id",
                autoIncrement: true,
              });

              store.createIndex("id", "id", { unique: true });
            }
          },
        });

        // Effacer les données existantes dans le magasin d'objets spécifié
        const clearTx = db.transaction('clients', "readwrite");
        const clearStore = clearTx.objectStore(clients);
        clearStore.clear();
        await clearTx.done;

        // Ajouter les nouvelles données du client
        const addTx = db.transaction('clients', "readwrite");
        const addStore = addTx.objectStore(clients);
        await addStore.add(clientData);
        await addTx.done;

        console.log("Insertion réussie dans IndexedDB : ", clientData);
      } catch (error) {
        console.error("Erreur lors de l'insertion des données dans IndexedDB", error);
      }
    },
  },
};
</script>
