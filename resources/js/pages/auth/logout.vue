<template>
    
</template>
<script>
import AppStorage from "../../utils/helpers/AppStorage";
export default {
    created() {
        AppStorage.clear()
        AppStorage.deleteIndexedDB()
        this.$router.push({ name: 'welcome' })
    },

   
}
</script>
<style scoped></style>