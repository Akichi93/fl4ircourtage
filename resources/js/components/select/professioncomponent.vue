<template>
    <Multiselect :value="modelValue"  :options="professions" :custom-label="({ id_profession, profession }) => `${id_profession} - [${profession}]`
        " valueProp="profession" :placeholder="placeholder" label="profession" track-by="profession" :searchable="true">
    </Multiselect>
</template>
<script>
import Multiselect from "@vueform/multiselect";
import { getProfessionList } from "../../services/formservice";

export default {
    name: "professioncomponent",
    rops: ["modelValue", "placeholder"],
    data() {
        return {
            professions: [],
        };
    },
    created() {
        this.getProfession();
    },

    methods: {
        getProfession: function () {
            getProfessionList().then((result) => {
                this.professions = result;
            });
        },
    },
    components: { Multiselect },
};
</script>
      
<style src="@vueform/multiselect/themes/default.css"></style>
    