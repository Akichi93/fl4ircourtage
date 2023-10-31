<template>
    <div id="edit_taux" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier taux</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <form>
                        <div class="form-group">
                            <label>Taux</label>
                            <input class="form-control" type="text" v-model="tauxtoedit.taux">
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary cancel-btn" data-bs-dismiss="modal"
                                aria-label="Close">Annuler</button>
                            <button class="btn btn-primary submit-btn" type="button"
                                data-bs-dismiss="modal" @click.prevent="editTaux">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
</template>
<script>
export default {
  props: ['tauxtoedit'],
  name: "edittauxapporteur",
  methods: {
    editTaux() {
      axios
        .post("/api/auth/updateTauxApporteur", {
          id_tauxapp: this.tauxtoedit.id_tauxapp,
          taux: this.tauxtoedit.taux,
          id: this.tauxtoedit.id_apporteur,
        })
        .then((response) => {
            this.$emit('taux-update', response)
          if (response.status === 200) {
            toaster.success("Taux modifié", {
              position: "top-right",
            });
          }
        });
    },
    // apporteurUpdate() {
    //   axios.patch("/api/auth/updateBranche/" + this.apporteurtoedit.id_branche, {
    //     nom_apporteur: this.apporteurstoedit.nom_apporteur,
    //     email_apporteur: this.apporteurstoedit.email_apporteur,
    //     contact_apporteur: this.apporteurstoedit.contact_apporteur,
    //     adresse_apporteur: this.apporteurstoedit.adresse_apporteur,
    //     code_postal: this.apporteurstoedit.code_postal,
    //   })
    //     .then((response) => {
    //       this.$emit('apporteur-updated', response)
    //     })
    //     .catch((error) => {
    //       console.log(error)
    //     });
    // }
    
  },
}
</script>

