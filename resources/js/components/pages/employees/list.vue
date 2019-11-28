<template>
<div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Employees</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'employees'}">Employees</router-link></li>
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
                                <form @submit.prevent="search_employees()">
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
                                <tr v-for="emp in employees" :key="emp.employee_id">
                                    <td>{{ emp.employee_id }}</td>
                                    <td>{{ emp.employee_name }}</td>
                                    <td>{{ emp.department_name }}</td>
                                    <td>{{ emp.division_name }}</td>
                                    <td>
                                        <div class="btn-group dropleft">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                               <button class="dropdown-item" type="button" @click="view_employee(emp.employee_id)">View</button>
                                               <button class="dropdown-item" type="button" @click="edit_employee(emp.employee_id)">Edit</button>
                                            </div>
                                        </div>
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
import{ mapActions, mapGetters, mapMutations, mapState } from 'vuex'
export default {
    data(){
        return{
            search_word: '',
        }
    },

    methods:{
        ...mapActions([
            'getEmployees'
        ]),
        get_employees(){
            axios.get('employee').then(({data}) => {
                console.table(data);
            });
        }
    },
    created(){
        this.getEmployees();
    },
    computed:{
        ...mapGetters([
            'employees'
        ]),
    },
    created(){
    
    },
}
</script>
<style lang="css" scoped>

</style>