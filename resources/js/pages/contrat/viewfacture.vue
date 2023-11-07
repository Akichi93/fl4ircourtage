<template>
    <div class="content container-fluid pb-0">
      <div class="content container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="page-head-box">
              <h3>Facture</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="/home">Tableau de bord</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Contrat
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
  
        <div class="page-header">
          <div class="row align-items-center">
            <div class="col-auto float-end ms-auto">
              <div class="btn-group btn-group-sm">
                <button class="btn btn-white">CSV</button>
                <button class="btn btn-white" @click="downloadPDF()">PDF</button>
                <button class="btn btn-white" @click="printWindow()">
                  <i class="fa fa-print fa-lg"></i> Imprimer
                </button>
              </div>
            </div>
          </div>
        </div>
  
        <div class="row" id="printable-content">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-6 m-b-20"></div>
                  <div class="col-sm-6 m-b-20">
                    <div class="invoice-details">
                      <h3 class="text-uppercase">
                        {{ factures.nom_client }}
                      </h3>
                      <h3 class="text-uppercase">
                        {{ factures.postal_client }}
                      </h3>
                      <h3 class="text-uppercase">
                        {{ factures.adresse_client }}
                      </h3>
                    </div>
                  </div>
                </div>
  
                <div class="row">
                  <div class="col-sm-6 col-lg-7 col-xl-8 m-b-20">
                    <h5></h5>
                    <ul class="list-unstyled">
                      <li>
                        <h5>
                          N client: <strong>{{ factures.numero_client }}</strong>
                        </h5>
                      </li>
                      <li>
                        Contrat: <strong>{{ factures.numero_police }}</strong>
                      </li>
                      <li>
                        Compagnie: <strong>{{ factures.nom_compagnie }}</strong>
                      </li>
                      <li>
                        Categorie: <strong>{{ factures.nom_branche }}</strong>
                      </li>
                    </ul>
                  </div>
                  <div class="col-sm-6 col-lg-5 col-xl-4 m-b-20"></div>
                </div>
                <div>
                  <div class="row invoice-payment">
                    <div class="col-sm-7"></div>
                  </div>
                  <div class="invoice-info">
                    <p>
                      la somme de {{ factures.payer }} F CFA au titre de la prime
                      émise pour la période du {{ factures.date_debut }} au
                      {{ factures.date_fin }} selon de décompte ci après :
                    </p>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Prime nette</th>
                        <th class="d-none d-sm-table-cell">Acessoires</th>
                        <th>Taxes</th>
                        <th>A payer</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>#</td>
                        <td v-text="factures.prime_nette"></td>
                        <td v-text="factures.accessoires"></td>
                        <td v-text="factures.taxes_totales"></td>
                        <td v-text="factures.payer"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div>
                  <div class="row invoice-payment">
                    <div class="col-sm-7"></div>
                  </div>
                  <div class="invoice-info">
                    <p>
                      Par application de l'article 13 du code CIMA, la prise
                      d'effet des garanties est subordonnée au paiement intégral de la prime par l'assuré.
                    </p>
                    <p>
                      Nous vous remercions par avance de votre rêglement et vous
                      prions d'agréer, Monsieurs, l'expression de nos sentiments distingués.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  <script>
  import axios from "axios";
  export default {
    data() {
      return {
        factures: "",
      };
    },
    created() {
      this.viewRoute();
      this.getavenant();
    },
    mounted() {
      this.getavenant();
    },
  
    methods: {
      viewRoute() {
        let urlParams = new URLSearchParams(window.location.search);
        let myParam = urlParams.get("avenant");
        this.id_contrat = myParam;
      },
  
  
      // printWindow: function () {
      //   const printableContent = document.getElementById('printable-content')
      //   window.print(printableContent);
  
      //   // var divContents = document.getElementById("printable-content").innerHTML;
      //   // var a = window.open('', '', 'height=500, width=500');
      //   // a.document.write('<html>');
      //   // a.document.write('<body > <h1>Div contents are <br>');
      //   // a.document.write(divContents);
      //   // a.document.write('</body></html>');
      //   // a.document.close();
      //   // a.print();
      // },
  
      getavenant() {
        let urlParams = new URLSearchParams(window.location.search);
        let myParam = urlParams.get("avenant");
        axios
          .get("get/factures?avenant=" + myParam)
          .then((response) => {
            this.factures = response.data;
          })
          .catch((error) => {
            // this.loading = false;
            this.error = error.response.data.message || error.message;
          });
      },
  
    
    },
  };
  </script>
  <style>
  img {
    max-width: 100%;
    height: 100%;
  }
  </style>
  