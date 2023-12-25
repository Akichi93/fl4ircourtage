export default (await import('vue')).defineComponent({
data() {
return {
isConnected: false,
year: "",
branch: "",
contrat: "",
prospect: "",
sinistre: "",
comissioncourtier: "",
comissionapporteur: "",
echeance: "",
countemission: "",
// compagnies:[],
getYear: {},
branches: {},
chartData: {
labels: [""],
datasets: [
{
label: "Chiffre d'affaire par mois dans l'année",
backgroundColor: "#f87979",
data: [0],
},
],
},
chartDonnees: {
labels: [""],
datasets: [
{
label: "Chiffres d'affaires par branche",
backgroundColor: "#f87979",
data: [0],
},
],
},

chartGraphs: {
labels: [""],
datasets: [
{
label: "Chiffres d'affaires par compagnie",
backgroundColor: "#f87979",
data: [0],
},
],
},
};
},
created() {
this.getCategory();
this.getTypes();
this.getData();
},
name: "dashboard",
components: { Header, Sidebar, Bar },
mounted() {
this.checkInternetConnectivity();
},
methods: {
optionSelected() {
// L'année sélectionnée est stockée dans la variable 'year'
console.log("Année sélectionnée :", this.year);
},
getCategory: function () {
const token = localStorage.getItem("token");

// Configurez les en-têtes de la requête
const headers = {
Authorization: "Bearer " + token,
"x-access-token": token,
};
axios.get("/api/auth/year", { headers }).then(
function (response) {
this.getYear = response.data;

}.bind(this)
);
},

getTypes: function () {
const token = localStorage.getItem("token");

// Configurez les en-têtes de la requête
const headers = {
Authorization: "Bearer " + token,
"x-access-token": token,
};
axios.get("/api/auth/retrievebranche", { headers }).then(
function (response) {
this.branches = response.data;
}.bind(this)
);
},



getData() {

const token = localStorage.getItem("token");

// Configurez les en-têtes de la requête
const headers = {
Authorization: "Bearer " + token,
"x-access-token": token,
};

const yearSelected = this.year;

const params = {
year: yearSelected,
branch: this.branch,
};

axios
.get("/api/auth/stat/", {
params: params,
headers: headers,
})
.then((response) => {
this.contrat = response.data.contrat;
this.prospect = response.data.prospect;
this.sinistre = response.data.sinistre;
this.comissioncourtier = response.data.comissioncourtier;
this.comissionapporteur = response.data.comissionapporteur;
this.echeance = response.data.echeance;
this.countemission = response.data.countemission;
this.compagnies = response.data.compagnies;
const labels = response.data.primes.map((prime) => prime.name);
const data = response.data.primes.map((prime) => prime.y);

const label = response.data.accesoires.map(
(accesoire) => accesoire.name
);

const donnees = response.data.accesoires.map(
(accesoire) => accesoire.y
);

const titre = response.data.compagnies.map(
(compagnie) => compagnie.name
);

const graphs = response.data.compagnies.map(
(compagnie) => compagnie.y
);

this.chartData = {
labels: labels,
datasets: [
{
label: "Chiffre d'affaire par mois dans l'année",
backgroundColor: ['#123E6B', '#97B0C4', '#A5C8ED', '#F26D85', '#4CAF50', '#FFC107', '#9C27B0', '#FF5722', '#795548', '#009688'],
data: data,
},
],
};

this.chartDonnees = {
labels: label,
datasets: [
{
label: "Chiffres d'affaires par branche",
backgroundColor: ['#123E6B', '#97B0C4', '#A5C8ED', '#F26D85', '#4CAF50', '#FFC107', '#9C27B0', '#FF5722', '#795548', '#009688'],
data: donnees,
},
],
};

this.chartGraphs = {
labels: titre,
datasets: [
{
label: "Chiffres d'affaires par compagnie",
backgroundColor: ['#123E6B', '#97B0C4', '#A5C8ED', '#F26D85', '#4CAF50', '#FFC107', '#9C27B0', '#FF5722', '#795548', '#009688'],
data: graphs,
},
],
};
})
.catch((error) => console.log(error));
},
},
});
