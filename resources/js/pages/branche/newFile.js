import { getBranchesList } from "../../services/brancheservice";

export default (await import('vue')).defineComponent({
data() {
return {
branches: null,
branchetoedit: "",
q: ""
};
},
created() {
this.getBranches();
},
methods: {
getBranches: function () {
getBranchesList().then((result) => {
// console.log(result);
this.branches = result;
});
},

editbranche(id_branche) {
axios
.get("api/auth/editBranche/" + id_branche)
.then((response) => {
this.branchetoedit = response.data;
})
.catch((error) => console.log(error));
},

searchtask() {
alert(this.q);
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
components: { Header, Sidebar, editbranche, paginationbranche, searchbranche },
});
