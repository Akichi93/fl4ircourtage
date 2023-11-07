<template>
  <Multiselect
    :value="modelValue"
    :options="apporteurs"
    :custom-label="
      ({ id_apporteur, nom_apporteur }) =>
        `${id_apporteur} - [${nom_apporteur}]`
    "
    valueProp="id_apporteur"
    :placeholder="placeholder"
    label="nom_apporteur"
    track-by="nom_apporteur"
    :searchable="true"
  >
  </Multiselect>
</template>
  <script>
import Multiselect from "@vueform/multiselect";
import { getApporteurList } from "../../services/formservice";

export default {
  name: "clientcomponent",
  rops: ["modelValue", "placeholder"],
  data() {
    return {
      apporteurs: [],
    };
  },
  created() {
    this.getApporteur();
  },

  methods: {
    getApporteur: function () {
      getApporteurList().then((result) => {
        this.clients = result;
      });
    },
  },
  components: { Multiselect },
};
</script>
        
  <style src="@vueform/multiselect/themes/default.css"></style>