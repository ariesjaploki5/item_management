<template>
<div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>New User</h1>
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
          <div class="row justify-content-center">
              <div class="col-md-8">
                  <div class="card">
                    <div class="card-header">

                    </div>
                    <form @submit.prevent="store_user()">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-3">
                                    <label for="" class="form-label">
                                        Employee
                                    </label>
                                </div>
                                <div class="col-9">
                                    <select class="form-control form-control-sm" v-model="user_form.employee_id" required>
                                        <option v-for="employee in employees" :key="employee.employee_id"   :value="employee.employee_id">
                                            <div class="row">
                                                <div class="col-8">{{ employee.employee_name }}</div>
                                                <div class="col-1"> - </div>
                                                <div class="col-3">{{ employee.employee_id }}</div>
                                            </div>
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3">
                                    <label for="" class="form-label">
                                        Employee
                                    </label>
                                </div>
                                <div class="col-9">
                                    <select class="form-control form-control-sm" v-model="user_form.employee_id" required>
                                        <option v-for="employee in employees" :key="employee.employee_id"   :value="employee.employee_id">
                                            <div class="row">
                                                <div class="col-8">{{ employee.employee_name }}</div>
                                                <div class="col-1"> - </div>
                                                <div class="col-3">{{ employee.employee_id }}</div>
                                            </div>

                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3">
                                    <label for="" class="form-label">
                                        Username
                                    </label>
                                </div>
                                <div class="col-9">
                                    <input type="text" class="form-control form-control-sm" v-model="user_form.username" :disabled="user_form.employee_id == null" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3">
                                    <label for="" class="form-label">
                                        Password
                                    </label>
                                </div>
                                <div class="col-9">
                                    <input type="password" class="form-control form-control-sm" v-model="user_form.password" :disabled="user_form.employee_id == null" required>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-sm btn-primary">
                                Submit
                            </button>
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
            user_form: {
                employee_id: null,
                role_id: null,
                username: null,
                password: null,
            },
        }
    },

    methods:{
        store_user(){
            axios.post('user',{
                employee_id: this.user_form.employee_id,
                role_id: this.user_form.role_id,
                username: this.user_form.username,
                password: this.user_form.password,
            }).then(() => {
                this.$router.push({ name: 'users' });
            }).catch(() => {

            });
        },
        ...mapActions([
            'getEmployees'
        ]),


    },
    created(){
        this.getEmployees();
    },
    computed:{
        ...mapGetters([
            'employees'
        ]),
        filteredEmployees: function(){
            let matcher = new RegExp(this.search_word, 'i')
            return this.employees.filter(function(emp)
                {
                    return matcher.test(emp.employee_name);
                }
            );
        },
    },
}
</script>
<style lang="css" scoped>

</style>