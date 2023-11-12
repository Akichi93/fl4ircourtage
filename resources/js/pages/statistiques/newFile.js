export default (await import('vue')).defineComponent({
name: "statclient",
components: {
Header,
Sidebar,
},
data() {
return {
clients: {},
};
},
created() {
this.fetchData();
},
methods: {
fetchData() {
const token = localStorage.getItem("token");

// Configurez les en-têtes de la requête
const headers = {
Authorization: "Bearer " + token,
"x-access-token": token,
};
axios;
axios.get(`/api/auth/getAvenantContrat/${this.$route.params.id_contrat}`),
                    .get("/api/auth/getAvenantContrat/${this.$route.params.id_contrat}, { headers })"
.then((response) => {
this.clients = response.data;
console.log(response.data);
})
.catch((error) => {
this.error = error.response.data.message || error.message;
}));
},
},
});
