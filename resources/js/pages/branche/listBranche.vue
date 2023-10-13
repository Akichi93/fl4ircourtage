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
                                Ajouter
                                branche</router-link>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-row">
                        <input type="text" class="form-control" placeholder="Rechercher une branche" />
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

                                </tbody>
                            </table>
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
//   import { getBranchesList } from "../../services/brancheservice";


export default {
    created() {
        if (!User.loggedIn()) {
            this.$router.push({ name: 'welcome' })
        }
    },
    name: "listBranche",
    data() {
        return {
            user_list: null,
        };
    },

    created() {
        const token = localStorage.getItem("token")

        axios
            .get("http://localhost:5000/api/auth/user", {
                headers: {
                    Authorization: 'Bearer ' + token,
                    'x-access-token': token
                }
            })
    },


    components: { Header, Sidebar },
};
</script>
<style></style>
    