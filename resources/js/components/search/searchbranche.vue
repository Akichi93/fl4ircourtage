<template>
    <div class="col-row">
        <input type="text" class="form-control" placeholder="Rechercher une branche" v-model="q" @keyup="searchtask" />
    </div>
</template>
<script>
export default {
    name: "searchbranche",

    data() {
        return {
            branches: {},
            q: ""
        };
    },

    methods: {
        searchtask() {
            const token = localStorage.getItem("token");

            // Configurez les en-têtes de la requête
            const headers = {
                Authorization: "Bearer " + token,
                "x-access-token": token,
            };

            axios
                .get("/api/auth/branchesList/" + this.q, { headers })
                .then((response) => (this.branches = response.data))
                .catch((error) => console.log(error));
        }
    },
};
</script>