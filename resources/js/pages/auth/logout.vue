<template>
    
</template>
<script>
export default {
    created() {
        localStorage.removeItem('token')
        localStorage.removeItem('user')
        localStorage.removeItem('id')
        localStorage.removeItem('entreprise')
        this.$router.push({ name: 'welcome' })
    },

   
}
</script>
<style scoped></style>