<template>
    <div class="modal custom-modal fade" id="delete_prospect" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Supprimer prospect</h3>
                        <p>Voulez vous supprimer le prospect ?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <a href="javascript:void(0);" class="btn btn-primary continue-btn" data-bs-dismiss="modal"
                                    @click="deleteProspect">supprimer</a>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0);" data-bs-dismiss="modal"
                                    class="btn btn-primary cancel-btn">Annuler</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script></script>

<!-- deleteProspect() {
    axios
        .patch("/deleteProspect/" + this.prospectoedit.id_prospect)
        .then((response) => {
            this.listprospect();
            if (response.status === 200) {
                toaster.success(`Prospect supprimé avec succes`, {
                    position: "top-right",
                });
            }
        })
        .catch((error) => console.log(error));
}, -->