<template>
    <div class="row">
        <div class="col-6 mt-5 shadow-lg p-3 mb-5 bg-white up"
            style="width:50%; !important; margin:auto; border-radius: 25px;">
            <div class="row">
                <div class="col-4 border-0">
                    <div class="mt-5 border-0">
                        <div class="mt-5 img-thumbnail border-0 ">
                            <img :src="'/img/BGHMC_LOGO.gif'" style="opacity: 1" width="100%">
                        </div>
                    </div>
                </div>
                <div class="col-8 border-0">
                    <div class="border-0">
                        <div class="card-header border-0 mt-3">
                            <h2>Baguio General Hospital and Medical Center</h2>
                            <h4>Procurement Management Information System (MMO)</h4>
                        </div>
                        <div class="card-body border-0 mb-5">
                            <h3>Login</h3>
                            <form @submit.prevent="login()">
                                <label>Username</label>
                                <input v-model="username" type="text" style="border-radius: 25px;" class="form-control" required autofocus>
                                <br>
                                <label>Password</label>
                                <input v-model="password" type="password" style="border-radius: 25px;"
                                    class="form-control" required>
                                <button type="submit" class="btn btn-primary mt-3" style="border-radius: 25px;">Login</button>
                            </form>
                        </div>
                        <div class="card-footer text-center">
                            <small>Created by: MIS Section | Local 202</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
    export default {
        props: {
            dataSuccessMessage: {
                type: String,
            }
        },
        data() {
            return {
                username: '',
                password: '',
                serverError: '',
                successMessage: this.dataSuccessMessage,
                loading: false,
            }
        },
        methods: {
            login() {
                this.loading = true;
                this.$store.dispatch('retrieveToken', {

                    username: this.username,
                    password: this.password,

                }).then(() => {

                    this.loading = false;

                    this.$router.push({
                        name: 'home'
                    });
                    this.$store.dispatch('retrieveUser');

                }).catch(error => {

                    this.loading = false;
                    this.serverError = error.response.data;
                    this.password = '';
                    this.successMessage = '';

                });
            },
        },
        computed: {

        },
    }

</script>

<style>
    body {
        background-color: #4A6572 !important;
    }

  .up{
    margin-top: 15rem !important;
  }

</style>
