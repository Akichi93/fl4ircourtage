<template>
  <div class="main-wrapper">
    <Header />

    <Sidebar />
    <div class="page-wrapper">
      <div class="content container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="page-head-box">
              <h3>Emissions - {{ contrats.nom_client }} - {{ contrats.numero_police }} - {{ contrats.nom_branche }}</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="/home">Tableau de bord</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Contrats
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>

        <div class="row filter-row">
          <div class="col-md-8"></div>
          <div class="col-md-4">
            <div class="add-emp-section">
              <a href="" class="btn btn-success btn-add-emp" data-bs-toggle="modal" data-bs-target="#add_avenant"
                style="width: auto"><i class="fas fa-plus"></i>
                Nouvelle emission
              </a>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-row">
            <input type="text" class="form-control" placeholder="Rechercher un avenant" v-model="q" @keyup="searchtask" />
          </div>
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-striped custom-table mb-0">
                <thead>
                  <tr>
                    <th>Type</th>
                    <th>Compagnie</th>
                    <th>Numéro police</th>
                    <th>Branche</th>
                    <th>Année</th>
                    <th>Mois</th>
                    <th>Prime TTC</th>
                    <th>Com courtier</th>
                    <th>Com apporteur</th>
                    <th>Date de saisie</th>
                    <th>Date d'effet</th>
                    <th>Date d'échéance</th>
                    <th>Solder</th>
                    <th>Reverser</th>
                    <th class="text-end">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <template v-for="avenant in avenants" :key="avenant.id_avenant">
                    <tr>
                      <td>{{ avenant.type }}</td>
                      <td>{{ avenant.nom_compagnie }}</td>
                      <td>{{ avenant.numero_police }}</td>
                      <td>{{ avenant.nom_branche }}</td>
                      <td>{{ avenant.annee }}</td>
                      <td>{{ avenant.mois }}</td>
                      <td>{{ avenant.prime_ttc }}</td>
                      <td>{{ avenant.commission_courtier }}</td>
                      <td>{{ avenant.commission }}</td>
                      <td>{{ avenant.date_emission }}</td>
                      <td>{{ avenant.date_debut }}</td>
                      <td>{{ avenant.date_fin }}</td>
                      <td v-if="avenant.solder == 0">
                        <span class="badge badge-pill bg-danger">NON</span>
                      </td>
                      <td v-else>
                        <span class="badge badge-pill bg-success">OUI</span>
                      </td>
                      <td v-if="avenant.reverser == 0">
                        <span class="badge badge-pill bg-danger">NON</span>
                      </td>
                      <td v-else>
                        <span class="badge badge-pill bg-success">OUI</span>
                      </td>
                      <td class="text-end ico-sec d-flex justify-content-end">

                        <a href="#" @click="fetchAvenant(avenant.id_avenant)" data-bs-toggle="modal"
                          data-bs-target="#add_file" title="Ajouter fichier"><i class="fas fa-plus"></i>
                        </a>

                        <!-- <div id="add_file" class="modal custom-modal fade" role="dialog">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Ajouter pièce</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                  <i class="fas fa-times"></i>
                                </button>
                              </div>
                              <div class="modal-body">
                                <b-form @submit="submit" @keydown="form.onKeydown($event)">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <input v-model="form.id_avenant" type="hidden" name="name"
                                        :modelValue="avenant.id_avenant" />
                                      <HasError :form="form" field="name" class="form-control" />

                                      <b-form-group id="titre" label="Titre de la pièce" label-for="titre" description="">
                                        <b-form-input id="titre" v-model="form.titre" type="text"
                                          placeholder="Titre de la pièce" required>
                                        </b-form-input>
                                      </b-form-group>

                                      <b-form-group id="piece" label="Pièce" label-for="piece" description="">
                                        <input type="file" name="file" @change="handleFile" class="form-control"
                                          accept="image/*,.pdf" />
                                        <HasError :form="form" field="file" />
                                      </b-form-group>
                                    </div>
                                  </div>

                                  <b-form-group class="mt-3">
                                    <b-button type="submit" variant="primary" class="m-3">Ajouter</b-button>
                                    <b-button type="reset" variant="danger" class="ml-3">Annuler</b-button>
                                  </b-form-group>
                                </b-form>
                              </div>
                            </div>
                          </div>
                        </div> -->

                        <!-- <a href="#" @click="fetchAvenant(avenant.id_avenant)" data-bs-toggle="modal"
                        data-bs-target="#add_file" title="Ajouter fichier"><i class="fas fa-pen"></i>
                      </a> -->

                        <a href="#" @click="fetchFile(avenant.id_avenant)" data-bs-toggle="modal"
                          data-bs-target="#assign_leader" title="Voir fichier"><i class="fas fa-file"></i>
                        </a>

                        <a href="#" @click="viewFacture(avenant.id_avenant)" data-bs-toggle="modal"
                          data-bs-target="#view_facture" title="Voir la facture">
                          <i class="fas fa-eye"></i>
                        </a>

                        <a href="#" @click="editAvenant(avenant.id_avenant)" data-bs-toggle="modal"
                          data-bs-target="#delete_avenant" title="Supprimer"><i class="fas fa-trash-alt"></i>
                        </a>

                        <a v-if="avenant.solder == 0" href="#" data-bs-toggle="modal" data-bs-target="#solder_contrat"
                          @click="editAvenant(avenant.id_avenant)" title="Solder"><i class="fas fa-balance-scale"></i>
                        </a>

                        <a v-if="avenant.solder == 1 && avenant.reverser == 0" href="#" data-bs-toggle="modal"
                          data-bs-target="#reverser_contrat" @click="editAvenant(avenanr.id_avenant)" title="Reverser"><i
                            class="fa fa-times"></i>
                        </a>

                      </td>
                    </tr>
                  </template>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</template>
<script>
import Header from "../../layout/Header.vue";
import Sidebar from "../../layout/Sidebar.vue";
export default {

  components: {
    Header,
    Sidebar,
  },

  data() {
    return {
      aveantoedit: "",
      avenants: {},
      id_contrat: "",
      contrats:{}
    };
  },
  created() {
    this.fetchTask();
    this.editAvenant();
  },

  methods: {
    editAvenant(id_avenant) {
      axios
        .get("/api/auth/editAvenant/" + id_avenant)
        .then((response) => {
          this.result = response.data;
          
          // this.form.id_avenant = response.data.id_avenant;
        })
        .catch((error) => console.log(error));
    },

    // viewFacture(id_avenant) {
    //   axios
    //     .get("/api/auth/getFactures/" + id_avenant)
    //     .then((response) => {
    //       this.factures = response.data;
    //     })
    //     .catch((error) => console.log(error));
    // },

    // print() {
    //   // Pass the element id here
    //   this.$htmlToPaper('printMe');
    // },

    fetchTask() {
      var that = this;
      alert(this.$route.params.id_contrat)
      axios
        .all([
          axios.get(`/api/auth/getAvenantContrat/${this.$route.params.id_contrat}`),
          axios.get(`/api/auth/getInfoContrat/${this.$route.params.id_contrat}`),
        ])
        .then(
          axios.spread(function (avenants, contrats) {
            that.avenants = avenants.data;
            that.contrats = contrats.data;

            console.log(contrats)

          })
        );
    },

    addAvenant() {
      axios
        .post("/api/post/postAvenant", {
          type: this.type,
          prime_ttc: this.prime_ttc,
          retrocession: this.retrocession,
          prime_nette: this.prime_nette,
          commission: this.commission,
          ristourne: this.ristourne,
          accessoires: this.accessoires,
          frais_courtier: this.frais_courtier,
          prise_charge: this.prise_charge,
          date_emission: this.date_emission,
          taxes_totales: this.taxes_totales,
          date_debut: this.date_debut,
          date_fin: this.date_fin,
          id_contrat: this.id_contrat,
        })
        .then((response) => {
          this.getavenant();
          this.type =
            this.prime_ttc =
            this.accessoires =
            this.prime_nette =
            this.commission =
            this.ristourne =
            this.prise_charge =
            this.date_emission =
            this.date_debut =
            this.date_fin =
            "";
          toaster.success(`Avenant ajouté avec succès`, {
            position: "top-right",
          });
        })
        .catch(() => {
          this.$toast.error(
            "Aveant Impossible, Veuillez renseigner tous les champs",
            {
              // override the global option
              position: "top-right",
            }
          );
        });
    },




  },
};
</script>
  