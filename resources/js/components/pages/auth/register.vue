<template>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-lg-5 col-md-7 col-sm-9">
        <div class="card">
              <div class="col-md-12 text-center">
                    <img :src="'/img/BGHMC_LOGO.gif'" alt="BGHMC Logo" style="opacity: 1" width="250px" height="250px">
                </div>
          <form @submit.prevent="login()">
            <div class="card-body">
              <div class="form-group row">
                <div class="col-4">
                  <label for="" class="form-label">Username:</label>
                </div>
                <div class="col-8">
                  <input type="text" class="form-control form-control-sm">
                </div>
              </div>
              <div class="form-group row mt-2">
                <div class="col-4">
                  <label for="" class="form-label">Password:</label>
                </div>
                <div class="col-8">
                  <input type="password" class="form-control form-control-sm">
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">Login</button>
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
  name: 'login',

  computed:{

  },
  }

</script>

<style lang="css" scoped>
body{
    background-color: #4A6572 !important;
}
</style>