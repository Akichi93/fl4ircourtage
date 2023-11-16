<template>
    <div id="edit_tauxcompagnie" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier taux</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input hidden="hidden" v-model="tauxtoedit.id_tauxcomp" />
                    <form>
                        <div class="form-group">
                            <label>Taux</label>
                            <input type="text" class="form-control" min="0" max="100" v-model="tauxtoedit.tauxcomp" />
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary cancel-btn" data-bs-dismiss="modal"
                                aria-label="Close">Annuler</button>
                            <button class="btn btn-primary submit-btn" type="button" @click.prevent="editTaux"
                                data-bs-dismiss="modal">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { createToaster } from "@meforma/vue-toaster";
// import $ from "jquery";
const toaster = createToaster({
  /* options */
});
export default {
    props: ['tauxtoedit'],
    name: "edittauxcompagnie",
    methods: {
        editTaux() {
            axios
                .post("/api/auth/updateTauxCompagnie", {
                    id_tauxcomp: this.tauxtoedit.id_tauxcomp,
                    tauxcomp: this.tauxtoedit.tauxcomp,
                    id: this.tauxtoedit.id_compagnie,
                })
                .then((response) => {
                    this.$emit('tauxcompagnie-updated', response)
                    if (response.status === 200) {
                        toaster.success(`Taux modifié`, {
                            position: "top-right",
                        });
                    }
                });
        },
    }
}
</script>