<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Reports</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
              <li class="breadcrumb-item"><router-link :to="{ name: 'requisition_slips'}">Requisition Slips</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'requisition_slip_reports'}">Reports</router-link></li>
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
                        <form >
                            <div class="form-group row">
                                <div class="col-3">
                                    <input type="date" v-model="report.date_from" class="form-control form-control-sm">
                                </div>
                                <div class="col-3">
                                    <input type="date" v-model="report.date_to" class="form-control form-control-sm">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                   
                    <div class="card-body">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th colspan="4">Fund Cluster</th>
                                </tr>
                                <tr>
                                    <th rowspan="2">RIS No.:</th>
                                    <th rowspan="2">Issued Quantity</th>
                                    <th rowspan="2"></th>
                                    <th rowspan="2"></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-right">
                        
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

import{ mapActions, mapGetters, mapMutations } from 'vuex'

export default {
    data(){
        return{
            report: {
                date_form: '',
                date_to: '',
            }
        }
    },
    methods: {
        
    },
    created(){
        
    },
    computed: {
       
    },
}
</script>

<style>

</style>