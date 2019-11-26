<template>
     <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Disbursement Vouchers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'disbursement_vouchers'}">Disbursement Vouchers</router-link></li>
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
                            <div class="col-8">
                                <div class="card-tools">
                                    <form @submit.prevent="search_dvs()">
                                        <div class="form-group row">
                                            <input type="text" class="form-control form-control-sm col-6 mr-2" v-model="search_word" required>
                                            <button class="btn btn-sm btn-primary" type="submit">search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-4 text-right">
                                <div class="card-tools">
                                    <button class="btn btn-sm btn-primary" type="button" @click="create_dvs()">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>DV No.:</th>
                                    <th>DV Date</th>
                                    <th>PO No.:</th>
                                    <th>Mode of Procurement</th>
                                    <th>Supplier</th>
                                    <th>ORS/BURS No.:</th>
                                    <th>Date Faxed</th>
                                    <th>Due Date</th>
                                    <th>Delivery Term</th>
                                    <th>Action</th>
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
                                    <td></td>
                                    <td></td>
                                    <td></td>
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
import { mapGetters, mapActions } from 'vuex'

export default {
    data(){
        return{
            search_word: '',
        }
    },
    methods: {
        ...mapActions([
            'getDvs'
        ]),
        
    },
    created(){
        this.getDvs();

    },
    computed:{
        ...mapGetters([
            'dvs'
        ]),

    },
}
</script>

<style>

</style>