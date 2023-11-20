<template>
    <div id="emp_profile" class="pro-overview tab-pane fade show">
        <div class="row">
            <div class="col-md-12 d-flex">
                <div class="card profile-box flex-fill">
                    <div class="card-body">
                        <h3 class="card-title">
                            Prospects
                            <a href="" download class="edit-icon"><i class="fas fa-download"
                                    title="Télécharger le model"></i>
                            </a>
                        </h3>


                        <form action="" method="POST" enctype="multipart/form-data">

                            <div class="form-group">
                                <label>Téléverser fichier</label>
                                <input class="form-control" type="file" name="import_prospect" accept=".csv" required />
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">
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
</script>