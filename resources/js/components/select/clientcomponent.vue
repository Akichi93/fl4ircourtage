<template>
  <Multiselect
    :value="modelValue"
    :options="clients"
    :custom-label="
      ({ id_client, nom_client }) => `${id_client} - [${nom_client}]`
    "
    valueProp="id_client"
    :placeholder="placeholder"
    label="nom_client"
    track-by="nom_client"
    :searchable="true"
  >
  </Multiselect>
</template>
<script>
import Multiselect from "@vueform/multiselect";
import { getClientList } from "../../services/formservice";

export default {
    name: "clientcomponent",
    props: ["modelValue", "placeholder"],
    data() {
        return {
            professions: [],
        };
    },
    created() {
        this.getClient();
    },

    methods: {
        getClient: function () {
            getClientList().then((result) => {
                this.clients = result;
            });
        },
    },
    components: { Multiselect },
};
</script>
      
<style src="@vueform/multiselect/themes/default.css"></style>