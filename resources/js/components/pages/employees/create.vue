<template>
<div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>New Employee</h1>
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
          <div class="row justify-content-center">
              <div class="col-md-8">
                  <div class="card">
                    <div class="card-header">
                        <label for="" class="form-label">
                            Employee Form
                        </label>
                    </div>
                    <form @submit.prevent="store_employee()">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="" class="form-label">
                                    Employee ID
                                </label>
                                <input type="text" class="form-control form-control-sm" v-model="employee.employee_id">
                            </div>
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
                                    <option v-for="dept in departments" :key="dept.department_id" :value="dept.department_id">
                                        {{ dept.department_desc }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-right">
                            <button class="btn btn-warning" type="reset">Cancel</button>
                            <button class="btn btn-primary" type="submit">Submit</button>
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
        store_employee(){
            axios.post('employee', {
                employee_id: this.employee_id,
                first_name: this.first_name,
                middle_initial: this.middle_initial,
                last_name: this.last_name,
                department_id: this.department_id,
            }).then(() => {
                
            }).catch(() => {

            });
        },
    },
    created(){
        this.getDepartments();
    },
    computed:{
        ...mapGetters([
            'departments'
        ]),
    },

}
</script>
<style lang="css" scoped>

</style>