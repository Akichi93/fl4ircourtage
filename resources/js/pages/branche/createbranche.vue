<template>
  <div class="main-wrapper">
    <Header />

    <Sidebar />
    <div class="page-wrapper">
      <div class="content container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="page-head-box">
              <h3>Création de branche</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="/home">Tableau de bord</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Branches
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xl-12 d-flex">
            <div class="card flex-fill">
              <div class="card-header">
                <h4 class="card-title mb-0">Branches</h4>
              </div>
              <div class="card-body">
                <form action="#">
                  <div class="form-group row">
                    <label class="col-lg-3 col-form-label"
                      >Nom de branche</label
                    >
                    <div class="col-lg-9">
                      <input
                        type="text"
                        v-model="form.nom_branche"
                        class="form-control"
                      />
                    </div>
                  </div>

                  <div class="text-end">
                    <button
                      type="submit"
                      class="btn btn-primary"
                      @click.prevent="storeBranche"
                    >
                      Créer
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Header from "../../layout/Header.vue";
import Sidebar from "../../layout/Sidebar.vue";
import { postBranche } from "../../services/brancheservice";
export default {
  components: { Header, Sidebar },
  data() {
    return {
      form: {
        nom_branche: null,
      },
    };
  },
  created() {
    if (!User.loggedIn()) {
      this.$router.push({ name: "/" });
    }
  },
  methods: {
    storeBranche: function () {
      postBranche(this.form)
        .then((response) => {
          this.$router.push("/listbranche");
        })
        .catch((error) => {
          console.log("error", error);
        });
    },
  },
};
</script>