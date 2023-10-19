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
              <router-link to="/createbranche" class="btn btn-success btn-add-emp" style="width: auto">
                Ajouter branche</router-link>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-row">
            <input type="text" class="form-control" placeholder="Rechercher une branche" v-model="q"
              @keyup="searchtask" />
          </div>
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
                  <template v-for="(branche, i) in branches" :key="i">
                    <tr>
                      <td v-text="branche.id_branche"></td>
                      <td v-text="branche.nom_branche"></td>
                      <td class="text-end ico-sec d-flex justify-content-end">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#edit_branche"
                          @click="editbranche(branche.id_branche)"><i class="fas fa-pen"></i></a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#delete_project"><i
                            class="far fa-trash-alt"></i></a>
                      </td>
                    </tr>
                  </template>
                </tbody>
              </table>
            </div>

            <paginationbranche></paginationbranche>
            
          </div>
        </div>
      </div>

      

      <editbranche v-bind:branchetoedit="branchetoedit"></editbranche>


    </div>
  </div>
</template>
<script>
import Header from "../../layout/Header.vue";
import Sidebar from "../../layout/Sidebar.vue";
import { getBranchesList } from "../../services/brancheservice";
import editbranche from "./editbranche.vue";
import paginationbranche from "../../components/pagination/paginationbranche.vue";


export default {
  data() {
    return {
      branches: null,
      branchetoedit: "",
    };
  },
  created() {
    this.getBranches();
  },
  methods: {
    getBranches: function () {
      getBranchesList().then((result) => {
        // console.log(result);
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
  },
  components: { Header, Sidebar, editbranche, paginationbranche },
};
</script>
    