<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-4 col-md-6 col-sm -8">
        <div class="card">
          <div class="card-header">
            Login 
          </div>
          <form @submit.prevent="login()">
            <div class="card-body">
              <div class="form-group row">
                <div class="col-4">
                  <label for="" class="form-label">Username</label>
                </div>
                <div class="col-8">
                  <input type="text" class="form-control form-control-sm">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-4">
                  <label for="" class="form-label">Password</label>
                </div>
                <div class="col-8">
                  <input type="password" class="form-control form-control-sm">
                </div>
              </div>
            </div>
            <div class="card-footer">
              
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
  }
</script>

<style>

</style>