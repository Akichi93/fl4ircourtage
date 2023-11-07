<template>
  <div id="add_avenant" class="modal custom-modal fade" role="dialog">
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
</template>
<script></script>