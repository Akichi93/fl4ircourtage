<template>
    <div id="client_tab" class="pro-overview tab-pane fade show active">
        <div class="row">
            <div class="col-md-12 d-flex">
                <div class="card profile-box flex-fill">
                    <div class="card-body">
                        <h3 class="card-title">
                            Clients
                            <a href="BDclient.xlsx" download class="edit-icon"><i class="fas fa-download"
                                    title="Télécharger le model"></i>
                            </a>
                        </h3>



                        <div class="form-group">
                            <label>Téléverser fichier</label>
                            <input class="form-control" type="file" name="import_client" accept=".csv" required
                                @change="handleFileChange" />
                        </div>
                        <div class="submit-section">
                            <button @click="uploadFile" class="btn btn-primary submit-btn">
                                Importer la base de donnée
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "upload",
    data() {
        return {
            selectedFile: null,
        };
    },
    methods: {
        handleFileChange(event) {
            this.selectedFile = event.target.files[0];
        },

        uploadFile() {
            const formData = new FormData();
            formData.append('file', this.selectedFile);

            // Use axios or any other HTTP library to send the file to the server
            // Example using axios:
            axios.post('/api/auth/importclient', formData)
                .then(response => {
                    console.log(response.data);
                })
                .catch(error => {
                    console.error(error);
                });
        },
    },

}
</script>