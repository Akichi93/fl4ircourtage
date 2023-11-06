<template>
    <Multiselect :value="modelValue" :options="etats" placeholder="Choisir un etat" :searchable="true"
        class="form-control" />
</template>
<script>
import Multiselect from "@vueform/multiselect";

export default {
    name: "adressecomponent",
    rops: ["modelValue", "placeholder"],
    data() {
        return {
            etats: [
                "Recherche Saturation",
                "Etude en cours",
                "Client entier",
            ],
        };
    },
    components: { Multiselect },
};
</script>
      
<style src="@vueform/multiselect/themes/default.css"></style>
    