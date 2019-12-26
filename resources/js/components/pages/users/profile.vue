<template>
<div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'profile', params: { id: this.$route.params.id }}">User Profile</router-link></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                  <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                      <table class="table table-sm">
                        <tbody>
                          <tr>
                            <td>
                              Id
                            </td>
                            <td>
                              <span>{{ user.employee_id }}</span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="card-footer">
                
                    </div>
                </div>
              </div>
          </div>
      </div>

    </section>
</div>
    
</template>

<script>
import { mapState } from 'vuex';

export default {
  data(){
    return{
      
    }
  },
  methods:{

  },
  created(){

  },
  computed:{
    ...mapState([
      'user',
    ])
  }
}
</script>

<style lang="css" scoped>

</style>