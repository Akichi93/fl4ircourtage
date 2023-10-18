<template>
    <!-- <pagination align="center" :data="branches" :limit="5" :current_page="branches.current_page"
        :last_page="branches.last_page" @pagination-change-page="listbranche" ></pagination> -->

        <pagination align="center" :data="branches" @pagination-change-page="listbranche"></pagination>

       
</template>
<script>
// import pagination from 'laravel-vue-pagination';
import pagination from 'laravel-vue-pagination'
export default {
    name: "paginationbranche",
    components: {
        pagination
    },
    data() {
        return {
            branches: {},
        };
    },
    created() {
        this.listbranche();


    },
    methods: {

        listbranche(page = 1) {
            const token = localStorage.getItem("token");

            // Configurez les en-têtes de la requête
            const headers = {
                Authorization: "Bearer " + token,
                "x-access-token": token,
            };
            
            axios.get("/api/auth/branchesList?page=" + page, { headers }).then((response) => {
                this.branches = response.data;
            });
        },


    },
};
</script>

<style scoped>
    .pagination{
        margin-bottom: 0;
    }
</style>