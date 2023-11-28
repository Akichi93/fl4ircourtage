<template>
    
</template>
<script>
export default {
    created() {
        localStorage.clear()
        this.$router.push({ name: 'welcome' })
    },

   
}
</script>
<style scoped></style>