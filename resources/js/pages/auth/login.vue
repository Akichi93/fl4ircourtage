<template>
    <div class="account-page">
        <div class="main-wrapper">
            <div class="account-content">
                <div class="container">
                    <div class="account-logo">
                        <a href=""><img src="assets/img/logo4.png" alt="COURTAGE" style="width: 30%;"></a>
                    </div>

                    <div class="account-box">
                        <div class="account-wrapper">
                            <h3 class="account-title">Connexion</h3>
                            <p class="account-subtitle">Accès au tableau de bord</p>

                            <form @submit.prevent="login">
                                <div class="form-group">
                                    <label>Adresse email</label>
                                    <input class="form-control" type="email" v-model="form.email">

                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label>Mot de passe</label>
                                        </div>
                                        <div class="col-auto">
                                            <router-link class="text-muted" to="/forgot">
                                                Mot de passe oublié?
                                            </router-link>
                                        </div>
                                    </div>
                                    <input class="form-control" type="password" v-model="form.password">

                                </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-primary account-btn" type="submit">Connexion</button>


                                </div>
                                <div class="account-footer">
                                    <p>Vous n'avez pas encore de compte ? <router-link to="/register">Demande de
                                            compte</router-link></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import User from "../../utils/helpers/User";
export default {
  
    data() {
        return {
            form: {
                email: '',
                password: ''
            },
            errors: []
        }
    },
    methods: {       
        login() {
            axios.post('/api/auth/login', this.form)
                .then(res => {
                    User.responseAfterLogin(res)
                    this.$router.push({ name: 'dashboard' })
                })
                .catch(error => console.log(error.message))
        }
    }


}
</script>
