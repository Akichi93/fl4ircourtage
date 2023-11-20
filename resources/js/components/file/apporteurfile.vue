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
<script></script>