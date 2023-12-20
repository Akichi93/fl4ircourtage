<template>
    <div class="modal custom-modal fade" id="add_flotte" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Ajouter une flotte</h3>
                    </div>
                    <div class="modal-btn delete-action">
                        <h3 class="card-title">
                            Automobiles
                            <a href="BDapporteur.xlsx" download class="edit-icon"><i class="fas fa-download"
                                    title="Télécharger le model"></i>
                            </a>
                        </h3>

                        <div v-if="error" class="error-message">
                            {{ error }}
                        </div>

                        <div class="form-group">
                            <label>Téléverser fichier</label>
                            <input class="form-control" type="file" ref="fileInput" @change="handleFileChange" accept=".csv"
                                required />
                        </div>
                        <div class="submit-section">
                            <button v-if="!loading" @click="uploadFile" :disabled="loading"
                                class="btn btn-primary submit-btn">
                                Importer la base de donnée
                            </button>

                            <!-- Afficher l'indicateur de chargement si le fichier est en cours d'envoi -->
                            <div v-if="loading" class="loading-container">
                                <div class="loading-progress" :style="{ transform: 'rotate(' + (progress * 3.6) + 'deg)' }">
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
import { useAutofileStore } from '../../store/autofile';
import { createToaster } from "@meforma/vue-toaster";
// import $ from "jquery";
const toaster = createToaster({
    /* options */
});
export default {
    props: ["avenantoedit"],
    methods: {
        methods: {
            handleFileChange(event) {
                this.autoFileStore.handleFileChange(event);
            },
            async uploadFile() {
                await this.autoFileStore.uploadFile(axios);
            },
        },
        computed: {
            autoFileStore() {
                return useAutofileStore();
            },
            selectedFile() {
                return this.autoFileStore.selectedFile;
            },
            loading() {
                return this.autoFileStore.loading;
            },
            progress() {
                return this.autoFileStore.progress;
            },
            error() {
                return this.autoFileStore.error;
            },
        },

    }
}
</script>
<style scoped>
.loading-container {
    position: relative;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: 4px solid #e0e0e0;
    margin: 20px auto;
    animation: rotation 1s linear infinite;
}

.loading-progress {
    height: 100%;
    width: 100%;
    border-radius: 50%;
    border: 4px solid #4caf50;
    border-top: 4px solid transparent;
    animation: rotation 1s linear infinite;
}

@keyframes rotation {
    to {
        transform: rotate(360deg);
    }
}

.loading-container p {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-weight: bold;
    color: #000;
}
</style>