<template>
  <div class="main-wrapper">
    <Header />

    <Sidebar />
    <div class="page-wrapper">
      <div class="content container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="page-head-box">
              <h3>Branches</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="">Tableau de bord</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Branche
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>

        <div class="row filter-row">
          <div class="col-md-8"></div>
          <div class="col-md-4">
            <div class="add-emp-section">
              <router-link
                to="/createbranche"
                class="btn btn-success btn-add-emp"
                style="width: auto"
              >
                Ajouter branche
              </router-link>
            </div>
          </div>
        </div>

        <div class="row">
          <searchbranche
            :placeholder="'Rechercher une branche'"
            v-model="q"
            @keyup="searchtask"
          ></searchbranche>

          <div class="col-md-12">
            <div>
              <table class="table table-striped custom-table mb-0">
                <thead>
                  <tr>
                    <th style="width: 30px">#</th>
                    <th>Nom de la branche</th>
                    <th class="text-end">Action</th>
                  </tr>
                </thead>
                <tbody>
                
                    <tr v-for="(branche, i) in branches" :key="i">
                      <td v-text="branche.id_branche"></td>
                      <td v-text="branche.nom_branche"></td>
                      <td class="text-end ico-sec d-flex justify-content-end">
                        <a
                          href="#"
                          data-bs-toggle="modal"
                          data-bs-target="#edit_branche"
                          @click="editbranche(branche.id_branche)"
                          ><i class="fas fa-pen"></i
                        ></a>
                        <a
                          href="#"
                          data-bs-toggle="modal"
                          data-bs-target="#delete_branche"
                          @click="editbranche(branche.id_branche)"
                          ><i class="far fa-trash-alt"></i
                        ></a>
                      </td>
                    </tr>
                 
                </tbody>
              </table>
            </div>

            <!-- <paginationbranche></paginationbranche> -->
          </div>
        </div>
      </div>

      <editbranche v-bind:branchetoedit="branchetoedit" @task-updated="refresh"></editbranche>
      <deletebranche v-bind:branchetoedit="branchetoedit" @task-delete="refresh"></deletebranche>
    </div>
  </div>
</template>
<script>
import Header from "../../layout/Header.vue";
import Sidebar from "../../layout/Sidebar.vue";
import { getBranchesList } from "../../services/brancheservice";
import editbranche from "./editbranche.vue";
import deletebranche from "./deletebranche.vue";
// import paginationbranche from "../../components/pagination/paginationbranche.vue";
import searchbranche from "../../components/search/searchbranche.vue";

export default {
  data() {
    return {
      branches: [],
      branchetoedit: "",
      q: "",
    };
  },
  created() {
    this.getBranches();
  },
  methods: {
    getBranches: function () {
      getBranchesList().then((result) => {
        console.log(result);
        this.branches = result;
      });
    },

    editbranche(id_branche) {
      axios
        .get("api/auth/editBranche/" + id_branche)
        .then((response) => {
          this.branchetoedit = response.data;
        })
        .catch((error) => console.log(error));
    },

    searchtask() {
      // alert(this.q.length)
      if (this.q.length > 0) {
        axios
          .get("/api/auth/branchesList/" + this.q)
          .then(
            (response) => (
              (this.branches = response.data.data), console.log(response.data)
            )
          )
          .catch((error) => console.log(error));
      } else {
        axios
          .get("/api/auth/branchesList/")
          .then(
            (response) => (
              (this.branches = response.data), console.log(response.data)
            )
          )
          .catch((error) => console.log(error));
      }
    },

    refresh(branches){
      this.branches = branches.data;
    }
  },
  components: {
    Header,
    Sidebar,
    editbranche,
    deletebranche,
    // paginationbranche,
    searchbranche,
  },
};
</script>
    