<template>
<div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Employee</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
              <li class="breadcrumb-item"><router-link :to="{ name: 'employees'}">Employees</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'purchase_orders'}">Show</router-link></li>
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
                        <div class="row">
                            <div class="col-3">
                                <label for="" class="form-label">
                                    Employee ID
                                </label>
                            </div>
                            <div class="col">
                                {{ employee.employee_id }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="" class="form-label">
                                    Employee Name
                                </label>
                            </div>
                            <div class="col">
                                {{ employee.employee_name }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="" class="form-label">
                                    Department
                                </label>
                            </div>
                            <div class="col">
                                {{ employee.department_desc }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="" class="form-label">
                                    Division
                                </label>
                            </div>
                            <div class="col">
                                {{ employee.division_desc }}
                            </div>
                        </div>
                      </div>
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

        }
    },

    methods:{
        ...mapActions([
            'getEmployee'
        ]),
    },
    created(){
        this.getEmployee(this.$route.params.id);
    },
    computed:{
        ...mapGetters([
            'employee'
        ]),
    },

}
</script>
<style lang="css" scoped>

</style>