<template>
  <Multiselect
    :value="modelValue"
    :options="compagnies"
    :custom-label="
      ({ id_compagnie, nom_compagnie }) =>
        `${id_compagnie} - [${nom_compagnie}]`
    "
    valueProp="id_compagnie"
    :placeholder="placeholder"
    label="nom_compagnie"
    track-by="nom_compagnie"
    :searchable="true"
  >
  </Multiselect>
 
</template>
  <script>
import Multiselect from "@vueform/multiselect";
import { getCompagnieList } from "../../services/formservice";

export default {
  name: "compagniecomponent",
  props: ["modelValue", "placeholder"],
  data() {
    return {
      compagnies: [],
    };
  },
  created() {
    this.getCompagnie();
  },

  methods: {
    getCompagnie: function () {
        getCompagnieList().then((result) => {
        this.compagnies = result;
      });
    },
  },
  components: { Multiselect },
};
</script>
        
  <style src="@vueform/multiselect/themes/default.css"></style>