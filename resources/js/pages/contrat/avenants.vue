<template>
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
            <a href="" class="btn btn-success btn-add-emp" data-bs-toggle="modal" data-bs-target="#create_project"
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
  
                      <div id="add_file" class="modal custom-modal fade" role="dialog">
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
                      </div>
  
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
  
                      <a href="#" @click="fetchAvenant(avenant.id_avenant)" data-bs-toggle="modal"
                        data-bs-target="#delete_avenant" title="Supprimer"><i class="fas fa-trash-alt"></i>
                      </a>
  
                      <a v-if="avenant.solder == 0" href="#" data-bs-toggle="modal" data-bs-target="#solder_contrat"
                        @click="fetchAvenant(avenant.id_avenant)" title="Solder"><i class="fas fa-balance-scale"></i>
                      </a>
  
                      <a v-if="avenant.solder == 1 && avenant.reverser == 0" href="#" data-bs-toggle="modal"
                        data-bs-target="#reverser_contrat" @click="fetchAvenant(avenanr.id_avenant)" title="Reverser"><i
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
  
    <div id="create_project" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Ajouter une emission</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <input type="hidden" v-model="id_contrat" :modelValue="id_contrat" />
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Type</label>
                    <Multiselect v-model="type" :options="modes" placeholder="Choisir le mode" :searchable="true" />
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Prime nette</label>
                    <input type="number" class="form-control" placeholder="Entrez la prime nette" v-model="prime_nette" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Accessoires</label>
                    <input type="number" class="form-control" placeholder="Entrez ..." v-model="accessoires" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Frais courtier</label>
                    <input type="number" class="form-control" placeholder="Frais courtier" v-model="frais_courtier" />
                  </div>
                </div>
                <!-- <div class="col-sm-12">
                                  <div class="form-group">
                                      <label>CFGA</label>
                                      <input type="text" class="form-control" placeholder="CFGA" v-model="cfga" />
                                  </div>
                              </div>-->
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Taxes totales</label>
                    <input type="number" class="form-control" placeholder="Taxes totales" v-model="taxes_totales" />
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Prime ttc</label>
                    <input type="number" class="form-control" placeholder="Entrez la prime ttc" v-model="prime_ttc" />
                  </div>
                </div>
              </div>
  
              <div class="form-group">
                <label>Date de debut</label>
                <input class="form-control" placeholder="Date de debut" type="date" v-model="date_debut" />
              </div>
              <div class="form-group">
                <label>Date de fin</label>
                <input class="form-control" placeholder="Date de fin" type="date" v-model="date_fin" />
              </div>
              <div class="submit-section">
                <button type="button" class="btn btn-primary cancel-btn" data-bs-dismiss="modal" aria-label="Close">
                  Annuler
                </button>
                <button type="button" data-bs-dismiss="modal" class="btn btn-primary submit-btn" @click="addAvenant">
                  Ajouter
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  
    <div id="assign_leader" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Fichier</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <ul class="chat-user-list">
                <template v-for="file in files" :key="file.id_fileavenant">
  
  
                  <div class="media d-flex">
                    <div class="media-body align-self-center text-nowrap flex-grow-1">
                      <div class="user-name">
                        Nom du fichier: {{ file.titre }}
                      </div>
                      <span class="designation">Fichier:
                        <a :href="'/images/piece_avenant/' + file.nom_file" download>{{ file.nom_file }}</a></span>
                    </div>
  
  
                  </div>
                  <div>
                    <iframe v-bind:src="'/images/piece_avenant/' + file.nom_file" type="" width="750" height="500"></iframe>
                  </div>
  
                </template>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <div class="modal custom-modal fade" id="delete_avenant" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body">
            <div class="form-header">
              <h3>Supprimer avenant</h3>
              <p>Voulez vous supprimer l'avenant?</p>
            </div>
            <div class="modal-btn delete-action">
              <div class="row">
                <div class="col-6">
                  <a href="javascript:void(0);" class="btn btn-primary continue-btn" data-bs-dismiss="modal"
                    @click="deleteAvenant">supprimer</a>
                </div>
                <div class="col-6">
                  <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary cancel-btn">Annuler</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <div id="view_facture" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Voir la facture</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
            <div class="page-header">
              <div class="row align-items-center">
                <div class="col-auto float-end ms-auto">
                  <div class="btn-group btn-group-sm">
                    <button class="btn btn-white">CSV</button>
                    <button class="btn btn-white" @click="downloadPDF()">PDF</button>
                    <button class="btn btn-white" @click="print">
                      <i class="fa fa-print fa-lg"></i> Imprimer
                    </button>
                  </div>
                </div>
              </div>
            </div>
  
            <div class="row" id="printMe">
              <div class="invoice">
                <div class="row">
                  <br /><br /><br />
                  <br /><br /><br />
                  <br /><br /><br />
                  <div class="col-7">
                    <img src="" class="logo" />
                  </div>
                  <div class="col-5">
                    <br /><br /><br /><br /><br /><br /><br /><br />
                    <p class="addressDriver">
                      <strong> {{ factures.nom_client }}</strong><br />
                      <strong>{{ factures.postal_client }}</strong> <br />
                      <strong> {{ factures.adresse_client }}</strong><br />
  
                    </p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-7">
                    <br /><br /><br />
                    <p class="addressDriver">
                      N client &emsp;&emsp;: <strong>{{ factures.numero_client }}</strong><br />
                      Contrat &emsp;&emsp;: <strong>{{ factures.numero_police }}</strong><br />
                      Compagnie &ensp;: <strong>{{ factures.nom_compagnie }}</strong><br />
                      Categorie &ensp;&ensp;: <strong>{{ factures.nom_branche }}</strong>
                    </p>
                  </div>
                  <div class="col-5">
                    <br /><br /><br />
  
                  </div>
                </div>
                <br />
                <br />
                <br />
                <br />
                <br />
                <center>
                  <strong>
                    <h2> PRIME N°{{ factures.code_avenant }} </h2>
  
                  </strong><br />
                </center>
                <br />
  
                
                  <p v-if="factures.type === 'Terme' || factures.type === 'Complememtaire'"
                    style="text-align: justify; font-size:20px">
  
                    la somme de {{ factures.payer }} F CFA au titre de la prime
                    émise pour la période du {{ factures.date_debut }} au
                    {{ factures.date_fin }} selon de décompte ci après :
  
                  </p>
              
  
                
                  <p v-if="factures.type === 'Ristourne'" style="text-align: justify; font-size:20px">
  
                    Nous avons le plaisir de vous remettre deux exemplaires de l avenant à la police citée en objet portant
                    sur la
                    période du {{ factures.date_debut }} au {{ factures.date_fin }} .
                    Si comme nous le pensons ce document retient votre agrément, nous vous serions reconnaissants de bien
                    vouloir nous en retourner un exemplaire dûment signé.
                    Dès réception de ces pièces, nous vous règlerons ou porterons au crédit de votre compte la somme de
                    {{ factures.payer }} FCFA.
                  </p>
  
      
  
                <br />
                <br />
                <br />
                <br />
                <br />
  
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Prime nette</th>
                      <th>Accessoires</th>
                      <th>Taxes</th>
                      <th>A payer</th>
                    </tr>
                  </thead>
                  <tbody>
  
                    <tr>
                      <td v-text="factures.prime_nette"></td>
                      <td v-text="factures.accessoires"></td>
                      <td v-text="factures.taxes_totales"></td>
                      <td v-text="factures.payer"></td>
                    </tr>
                  </tbody>
                </table>
  
                <br />
                <br />
  
                <p style="text-align: justify; font-size:20px" class="conditions"
                  v-if="factures.type === 'Terme' || factures.type === 'Complememtaire'">
                  Par application de l'article 13 du code CIMA, la prise d'effet des garanties est subordonnée au paiement
                  intégral de la
  
                  <br />
                  prime par l'assuré.
                  <br /><br />
  
                  <br />
  
                  <br />
                  Nous vous remercions par avance de votre rêglement et vous prions d'agréer, Monsieurs, l'expression de nos
                  sentiments
                  <br />
                  distingués
                </p>
  
                <br />
                <br />
                <br />
                <br />
  
                <p class="bottom-page text-left" style="display: flex;justify-content: end;">
                  POUR LA COMPAGNIE<br />
  
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <div class="modal custom-modal fade" id="solder_contrat" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body">
            <div class="form-header">
              <h3>Solder avenant</h3>
              <p>L'avenant est il solde ?</p>
            </div>
            <div class="modal-btn delete-action">
              <div class="row">
                <input type="hidden" class="form-control" v-model="result.id_avenant" />
                <div class="col-6">
                  <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary continue-btn"
                    @click="ChangeSolde">Solder</a>
                </div>
                <div class="col-6">
                  <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary cancel-btn">Annuler</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <div class="modal custom-modal fade" id="reverser_contrat" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body">
            <div class="form-header">
              <h3>Reverser contrat</h3>
              <p>L'avenant est il reversé ?</p>
            </div>
            <div class="modal-btn delete-action">
              <div class="row">
                <input type="hidden" class="form-control" v-model="result.id_avenant" />
                <div class="col-6">
                  <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary continue-btn"
                    @click="ChangeReverse">Reverser</a>
                </div>
                <div class="col-6">
                  <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary cancel-btn">Annuler</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  <script>
  // import $ from "jquery";
  import Multiselect from "@vueform/multiselect";
  import axios from "axios";
  import Form from "vform";
  import { HasError } from "vform/src/components/bootstrap5";
  import { createToaster } from "@meforma/vue-toaster";
  // import $ from "jquery";
  const toaster = createToaster({
    /* options */
  });
  export default {
  
    components: {
      Multiselect,
      HasError,
    },
  
    data() {
      return {
        form: Form.make({
          id_avenant: "",
          titre: "",
          file: null,
        }),
        result: "",
        aveantoedit: "",
        avenants: {},
        factures: "",
        files: {},
        type: "",
        prime_ttc: "",
        prime_nette: "",
        ristourne: "",
        retrocession: "",
        commission: "",
        prise_charge: "",
        date_emission: "",
        taxes_totales: "",
        frais_courtier: "",
        accessoires: "",
        date_debut: "",
        date_fin: "",
        id_contrat: "",
        roles: "",
        value: null,
        contrats: {},
        output: null,
  
        modes: ["Terme", "Ristourne", "Complementaire"],
      };
    },
    created() {
      this.viewRoute();
      this.getavenant();
      this.fetchAvenant();
      this.getClient();
      this.getRole();
    },
    mounted() {
      this.getavenant();
      this.getRole();
      this.getClient();
    },
  
    methods: {
      viewRoute() {
        let urlParams = new URLSearchParams(window.location.search);
        let myParam = urlParams.get("contrat");
        this.id_contrat = myParam;
      },
  
      fetchAvenant(id_avenant) {
        axios
          .get("editAvenant/" + id_avenant)
          .then((response) => {
            this.result = response.data;
            this.form.id_avenant = response.data.id_avenant;
            console.log(response.data)
          })
          .catch((error) => console.log(error));
      },
  
      viewFacture(id_avenant) {
        axios
          .get("getFactures/" + id_avenant)
          .then((response) => {
            this.factures = response.data;
          })
          .catch((error) => console.log(error));
      },
  
      print() {
        // Pass the element id here
        this.$htmlToPaper('printMe');
      },
  
      getavenant() {
        let urlParams = new URLSearchParams(window.location.search);
        let myParam = urlParams.get("contrat");
        axios
          .get("getAvenantContrat?contrat=" + myParam)
          .then((response) => {
            this.avenants = response.data;
            console.log(response.data)
          })
          .catch((error) => {
            this.error = error.response.data.message || error.message;
          });
      },
  
      ChangeSolde() {
        axios
          .post("/soldeAvenant", {
            id_avenant: this.result.id_avenant,
          })
          .then((response) => {
            this.getavenant();
            if (response.status === 200) {
              toaster.success(`Avenant solde`, {
                position: "top-right",
              });
            }
          });
      },
  
      ChangeReverse() {
        axios
          .post("/reverseAvenant", {
            id_avenant: this.result.id_avenant,
          })
          .then((response) => {
            this.getavenant();
            if (response.status === 200) {
              toaster.success(`Avenant reverse`, {
                position: "top-right",
              });
            }
          });
      },
  
      getClient() {
        let urlParams = new URLSearchParams(window.location.search);
        let myParam = urlParams.get("contrat");
        axios
          .get("getInfoAvenant?contrat=" + myParam)
          .then((response) => {
            this.contrats = response.data;
          })
          .catch((error) => {
            this.error = error.response.data.message || error.message;
          });
      },
  
      getRole() {
        axios
          .get("/getrole")
          .then((response) => {
            this.roles = response.data;
          })
          .catch((error) => console.log(error));
      },
  
  
  
      fetchFile(id_avenant) {
        axios
          .get("getFileAvenant/" + id_avenant)
          .then((response) => {
            this.files = response.data;
          })
          // .then((response) => console.log(response.data))
          .catch((error) => console.log(error));
      },
  
      addAvenant() {
        axios
          .post("/postAvenant", {
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
  
      deleteAvenant() {
        axios
          .patch("/deleteAvenant/" + this.result.id_avenant)
          .then((response) => {
            this.getavenant();
            if (response.status === 200) {
              toaster.success(`Avenant supprimé avec succes`, {
                position: "top-right",
              });
            }
          })
          .catch((error) => console.log(error));
      },
  
  
      handleFile(event) {
        // We'll grab just the first file...
        // You can also do some client side validation here.
        const file = event.target.files[0];
  
        // Set the file object onto the form...
        this.form.file = file;
        // this.form.id_sinistre = file
        // php artisan make:migration create_item_order_table --create="item_order" file_sinistres
      },
  
      async submit() {
        const response = await this.form.post("/postFileAvenant", {}).then((res) => {
          if (res.status === 200) {
            toaster.success(`Fichier avenant ajouté avec succès`, {
              position: "top-right",
            });
  
            this.form.reset();
          }
        });
      },
  
  
    },
  };
  </script>
  <style></style>
  