<template>
  <div id="add_client" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ajouter client</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <i class="fas fa-times"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Civilité</label>
                <civilitecomponent :placeholder="'selectionnez une civilité'" v-model="civilite"></civilitecomponent>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label>Nom complet du client</label>
                <input type="text" class="form-control" placeholder="Entrez le nom du client" v-model="nom_client" />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Boîte postal</label>
                <input type="text" class="form-control" placeholder="Entrez la boîte postale" v-model="postal_client" />
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label>Téléphone</label>
                <inputText :placeholder="'téléphone'" v-model="tel_client"></inputText>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Adresse</label>
                <adressecomponent :placeholder="'selectionnez l\'adresse'" v-model="adresse_client"></adressecomponent>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Profession</label>
                <professioncomponent :placeholder="'selectionnez une profession'" v-model="profession_client">
                </professioncomponent>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" placeholder="Email du client" v-model="email_client" />
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Fax</label>
            <input type="text" class="form-control" placeholder="fax du client" v-model="fax_client" />
          </div>
          <div class="submit-section">
            <button type="button" class="btn btn-primary cancel-btn" data-bs-dismiss="modal" aria-label="Close">
              Annuler
            </button>
            <button type="button" class="btn btn-primary submit-btn" @click="storeClient" data-bs-dismiss="modal">
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
import axios from "axios";

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
      if (navigator.onLine) {
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

          // Appeler fetchClients pour récupérer la liste mise à jour après l'insertion
          const updatedClients = await this.fetchClients();

          this.$emit("client-added", response);
          this.$emit("client-add", response.data);

          if (response.status === 200) {
            toaster.success(`Client ajouté avec succès`, {
              position: "top-right",
            });
          }

          // Mettre à jour IndexedDB avec les clients récupérés
          await AppStorage.storeDataInIndexedDB("clients", updatedClients);

        } catch (error) {
          console.error("Erreur lors de l'ajout du client sur le serveur", error);
        }
      } else {
        // Si hors ligne, ajoutez la nouvelle donnée directement dans IndexedDB
        const newClientData = {
          civilite: this.civilite,
          nom_client: this.nom_client,
          postal_client: this.postal_client,
          adresse_client: this.adresse_client,
          tel_client: this.tel_client,
          profession_client: this.profession_client,
          fax_client: this.fax_client,
          email_client: this.email_client,
          sync: 0,
        };

        // Ajouter la nouvelle donnée dans IndexedDB
        await AppStorage.storeDataInIndexedDB("clients", newClientData);

        toaster.info(`Client ajouté localement (hors ligne)`, {
          position: "top-right",
        });
      }
    },

    // Votre méthode actuelle fetchClients
    async fetchClients() {
      const token = AppStorage.getToken();

      // Configurez les en-têtes de la requête
      const headers = {
        Authorization: "Bearer " + token,
        "x-access-token": token,
      };

      try {
        const response = await axios.get("/api/auth/getClient", { headers });

        // Vous pouvez traiter les données comme vous le souhaitez
        const clients = response.data;

        // Retourner les clients pour une utilisation éventuelle
        return clients;
      } catch (error) {
        console.error("Erreur lors de la récupération des clients sur le serveur", error);
      }
    },
  },
};
</script>
