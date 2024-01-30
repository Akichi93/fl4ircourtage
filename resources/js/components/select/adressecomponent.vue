<template>
  <Multiselect :value="modelValues" :options="localisations" :custom-label="({ id_localisation, nom_ville }) => `${id_localisation} - [${nom_ville}]`
    " valueProp="nom_ville" :placeholder="placeholder" label="nom_ville" track-by="nom_ville" :searchable="true">
  </Multiselect>
</template>
<script>
import Multiselect from "@vueform/multiselect";
import AppStorage from "../../utils/helpers/AppStorage";


export default {
  name: "adressecomponent",
  props: ["modelValues", "placeholder"],
  data() {
    return {
      localisations: [],
    };
  },
  created() {
    this.getAdresse();
  },

  methods: {
    getAdresse() {
      AppStorage.getLocalisations().then((result) => {
        this.localisations = result;
      });
    },
  },
  components: { Multiselect },
};
</script>
    
<style src="@vueform/multiselect/themes/default.css"></style>
  