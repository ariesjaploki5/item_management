<template>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-lg-5 col-md-7 col-sm-9">
        <div class="card">
            <div class="card-header">
                <div class="col-md-12 text-center">
                    <img :src="'/img/BGHMC_LOGO.gif'" alt="BGHMC Logo" style="opacity: 1" width="250px" height="250px">
                </div>
            </div>
              
          <form @submit.prevent="login()">
            <div class="card-body">
              <div class="form-group row">
                <div class="col-4">
                  <label for="" class="form-label">Username:</label>
                </div>
                <div class="col-8">
                  <input type="text" class="form-control form-control-sm" v-model="username">
                </div>
              </div>
              <div class="form-group row mt-2">
                <div class="col-4">
                  <label for="" class="form-label">Password:</label>
                </div>
                <div class="col-8">
                  <input type="password" class="form-control form-control-sm" v-model="password">
                </div>
              </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </div>
            </div>
          </form>
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
                
                this.$router.push({ name: 'home' });
                this.$store.dispatch('retrieveUser');
            
            }).catch(error => {
                
                this.loading = false;
                this.serverError = error.response.data;
                this.password = '';
                this.successMessage = '';
            
            });
        },
    },
    computed:{

    },
  }

</script>

<style lang="css" scoped>
body{
    background-color: #4A6572 !important;
}
</style>