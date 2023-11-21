<template>
    <div class="tab-pane fade" id="apporteurs">
        <div class="row">
            <div class="col-md-12 d-flex">
                <div class="card profile-box flex-fill">
                    <div class="card-body">
                        <h3 class="card-title">
                            Apporteurs
                            <a href="" download class="edit-icon"><i class="fas fa-download"
                                    title="Télécharger le model"></i>
                            </a>
                        </h3>

                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Téléverser fichier</label>
                                <input class="form-control" type="file" name="import_apporteur" accept=".csv" required />
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">
                                    Importer la base de donnée
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import { createToaster } from "@meforma/vue-toaster";
// import $ from "jquery";
const toaster = createToaster({
    /* options */
});

export default {
    data() {
        return {
            selectedFile: null,
            loading: false, // Ajout de la variable pour l'indicateur de chargement
            progress: 0, // Ajout de la variable pour le progrès de l'envoi
            error: null, // Ajout de la variable d'erreur
        };
    },
    methods: {
        handleFileChange(event) {
            this.selectedFile = event.target.files[0];
        },
        uploadFile() {
            if (!this.selectedFile) {
                // alert('Veuillez sélectionner un fichier CSV.');
                toaster.error("Veuillez sélectionner un fichier CSV.", {
                    position: "top-right",
                });
                return;
            }

            this.loading = true; // Activer l'indicateur de chargement

            const formData = new FormData();
            formData.append('import_client', this.selectedFile);

            const token = localStorage.getItem("token");

            const headers = {
                Authorization: "Bearer " + token,
                "x-access-token": token,
            };

            axios.post('/api/auth/importapporteur', formData, {
                headers,
                onUploadProgress: progressEvent => {
                    // Mettez à jour l'indicateur de chargement en fonction du progrès de l'envoi
                    this.progress = Math.round((progressEvent.loaded / progressEvent.total) * 100);
                },
            })
                .then(response => {
                    console.log(response.data);
                    this.selectedFile = ""; // Réinitialiser le champ de fichier après l'envoi réussi
                    toaster.success("Fichier importé avec succès.", {
                        position: "top-right",
                    });
                    // alert('Fichier importé avec succès.');
                    // Traitez les erreurs ici si nécessaire
                    if (response.data.error) {
                        // Affichez ou traitez les erreurs côté client
                        console.error(response.data.error);
                    }

                    // Traitez les données réussies ici si nécessaire
                    if (response.data.success) {
                        // Affichez un message de réussite ou effectuez d'autres actions
                        console.log(response.data.success);
                    }

                    // Traitez les lignes invalides ici si nécessaire
                    if (response.data.details && response.data.details.invalid_rows) {
                        // Affichez ou traitez les lignes invalides côté client
                        console.error(response.data.details.invalid_rows);
                    }

                    // Traitez les doublons ici si nécessaire
                    if (response.data.details && response.data.details.duplicate_rows) {
                        // Affichez ou traitez les doublons côté client
                        console.error(response.data.details.duplicate_rows);
                    }
                })
                .catch(error => {
                    console.error(error);
                    toaster.error("Une erreur s\'est produite lors de l\'envoi du fichier.", {
                        position: "top-right",
                    });
                    // alert('Une erreur s\'est produite lors de l\'envoi du fichier.');
                })
                .finally(() => {
                    this.loading = false; // Désactiver l'indicateur de chargement, peu importe le résultat
                    this.progress = 0; // Réinitialiser le progrès une fois terminé
                });
        },
    },
};
</script>

<style scoped>
.loading-container {
    position: relative;
    width: 100%;
    height: 20px;
    background-color: #f0f0f0;
    border-radius: 5px;
    overflow: hidden;
}

.loading-progress {
    height: 100%;
    background-color: #4caf50;
    width: 0;
    animation: progress-animation 1s ease-in-out forwards;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
}

@keyframes progress-animation {
    to {
        width: 100%;
    }
}

.loading-container span {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #000000;
}
</style>