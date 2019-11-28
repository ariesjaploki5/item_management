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
              <li class="breadcrumb-item"><router-link :to="{ name: 'employees'}">Employees</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'purchase_orders'}">New</router-link></li>
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
                        <label for="" class="form-label">
                            New Employee
                        </label>
                    </div>
                    <form @submit.prevent="store_employee()">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="" class="form-label">
                                    Firstname
                                </label>
                                <input type="text" class="form-control form-control-sm" v-model="employee.first_name">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">
                                    M.I.
                                </label>
                                <input type="text" class="form-control form-control-sm" v-model="employee.middle_initial">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">
                                    Lastname
                                </label>
                                <input type="text" class="form-control form-control-sm" v-model="employee.last_name">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">
                                    Department
                                </label>
                                <select class="form-control form-control-sm" v-model="employee.department_id">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                    <!-- /.card-footer-->
                </div>
              </div>
          </div>
      </div>

    </section>
</div>
    
</template>
<script>

import{ mapActions, mapGetters } from 'vuex'
export default {

    data(){
        return{
            employee: {
                employee_id: null,
                first_name: null,
                middle_initial: null,
                last_name: null,
                department_id: null,
            }
        }
    },

    methods:{
        ...mapActions([
            'getDepartments'
        ]),
    },
    created(){
        this.getDepartments();
    },
    computed:{
        ...mapGetters([
            'departments'
        ]),
    },
    created(){
    
    },
}
</script>
<style lang="css" scoped>

</style>