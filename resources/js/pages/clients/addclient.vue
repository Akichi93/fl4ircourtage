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
import { apiUrl } from "../../utils/constants/apiUrl";
import { createToaster } from "@meforma/vue-toaster";
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
      clients: []
    };
  },
  methods: {
    async storeClient() {
      const isConnected = await this.checkInternetConnection();

      if (isConnected) {
        await this.storeClientOnline();
      } else {
        await this.storeClientOffline();
      }
    },

    async checkInternetConnection() {
      const response = await fetch("/api/check-internet-connection");
      const data = await response.json();
      this.isConnected = data.connected;
      return this.isConnected;
    },

    async storeClientOnline() {
      const userId = AppStorage.getId();
      const entrepriseId = AppStorage.getEntreprise();
      const uuid = require('uuid').v4();

      const numeroClient = this.generateNumeroClient();

      try {
        const response = await axios.post(apiUrl.postclient, {
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
          uuidClient: uuid,
          numero_client: numeroClient,
        });

        if (response.status === 200) {
          toaster.success(`Client ajouté avec succès`, { position: "top-right" });
        }

        const updatedClients = await this.fetchClients();
        await this.updateIndexedDBWithNewClients(updatedClients);

        this.emitClientAddEvent();

      } catch (error) {
        console.error("Erreur lors de l'ajout du client sur le serveur", error);
      }
    },

    async storeClientOffline() {
      const uuid = require('uuid').v4();
      const userId = parseInt(AppStorage.getId(), 10);
      const entrepriseId = parseInt(AppStorage.getEntreprise(), 10);

      const numeroClient = this.generateNumeroClient();

      const newClientData = [{
        civilite: this.civilite,
        nom_client: this.nom_client,
        postal_client: this.postal_client,
        adresse_client: this.adresse_client,
        tel_client: this.tel_client,
        profession_client: this.profession_client,
        fax_client: this.fax_client,
        email_client: this.email_client,
        sync: 0,
        uuidClient: uuid,
        id_entreprise: entrepriseId,
        user_id: userId,
        numero_client: numeroClient,
      }];

      await AppStorage.storeDataInIndexedDB("clients", newClientData);
      const result = await AppStorage.getClients();
      this.emitClientAddEvent();

      toaster.info(`Client ajouté localement (hors ligne)`, { position: "top-right" });
    },

    generateNumeroClient() {
      const today = new Date();
      const year = today.getFullYear();
      const month = (today.getMonth() + 1).toString().padStart(2, '0');
      const day = today.getDate().toString().padStart(2, '0');
      const dateDuJour = year + month + day;

      const nom = this.nom_client;
      const deuxPremiersCaracteres = nom.substring(0, 2).toUpperCase();

      return `CL-${deuxPremiersCaracteres}-${dateDuJour}`;
    },

    async updateIndexedDBWithNewClients(updatedClients) {
      const existingClients = await AppStorage.getClients();
      if (existingClients && updatedClients) {
        const newClients = updatedClients.filter((client) => {
          return !existingClients.some((existingClient) => existingClient.id_client === client.id_client);
        });

        if (newClients.length > 0) {
          AppStorage.storeDataInIndexedDB('clients', newClients);
        }
      }
    },

    emitClientAddEvent() {
      AppStorage.getClients().then((result) => {
        this.$emit("client-add", result);
      });
    },



    // fetchClients
    async fetchClients() {
      const token = AppStorage.getToken();

      // Configurez les en-têtes de la requête
      const headers = {
        Authorization: "Bearer " + token,
        "x-access-token": token,
      };

      try {
        const response = await axios.get(apiUrl.getclient, { headers });

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
