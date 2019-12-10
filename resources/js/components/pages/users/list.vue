<template>
<div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'users'}">Employees</router-link></li>
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
                        <div class="row">
                            <div class="col-6">
                                <form @submit.prevent="search_users()">
                                    <div class="form-group row">
                                        <input type="text" class="form-control form-control-sm col-4 mr-2" v-model="search_word" required>
                                        <button class="btn btn-sm btn-primary" type="submit">search</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-6 text-right">
                                <!-- <button class="btn btn-sm btn-primary" @click="create_po()">Creat PO</button> -->
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Division</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users" :key="user.id">
                                    <td>{{ user.employee_id }}</td>
                                    <td>{{ user.employee_name }}</td>
                                    <td>{{ user.department }}</td>
                                    <td>{{ user.division }}</td>
                                    <td>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                
                    </div>
                    <!-- /.card-footer-->
                </div>
              </div>
          </div>
      </div>

    </section>
</div>
    
</template>
<script>

import{ mapActions, mapGetters, mapState } from 'vuex'
export default {

    data(){
        return{
            search_word: '',
        }
    },

    methods:{
        ...mapActions([
            'getUsers', 'searchUsers'
        ]),
        search_users(){
            this.searchUsers(this.search_word);
            // axios.get('search_users/'+this.search_word).then(({data}) => {
            //     this.users = data;
            // }).catch(() => {

            // });
        }
    },
    created(){
        this.getUsers();

    },
    computed:{
        ...mapGetters([
            'users'
        ]),

    },

}
</script>
<style lang="css" scoped>

</style>