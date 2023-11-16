<template>
    <Multiselect :value="client" :options="clients" :custom-label="({ id_client, nom_client }) => `${id_client} - [${nom_client}]`
        " valueProp="id_client" :placeholder="placeholder" label="nom_client" track-by="nom_client" :searchable="true">
    </Multiselect>
</template>
<script>
import Multiselect from "@vueform/multiselect";
import { getClientList } from "../../services/formservice";

export default {
    name: "clientcomponent",
    props: ["client", "placeholder"],
    data() {
        return {
            clients: [],
        };
    },
    created() {
        this.getClient();
    },
    methods: {
        getClient: function () {
            getClientList().then((result) => {
                this.clients = result;
                console.log(result)
            });
        },

    },
    watch: {
        // Watcher pour réagir aux changements dans la propriété 'client'
        client(newClient) {
            // Exemple: affichez le nom du nouveau client sélectionné dans la console
            console.log("Nouveau client sélectionné:", newClient);

            // Vous pouvez ajouter ici d'autres logiques en fonction de vos besoins
        },
    },
    components: { Multiselect },
};
</script>
      
<style src="@vueform/multiselect/themes/default.css"></style>