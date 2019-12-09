<template>
<div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Control No.: {{ $route.params.id }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
              <li class="breadcrumb-item"><router-link :to="{ name: 'pmo_riss'}">Requisition Slips</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'pmo_ris_show', params: { id: $route.params.id }}">{{ $route.params.id }}</router-link></li>
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
                    <form @submit.prevent="save_ris()">
                    <div class="card-body">

                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <tr>
                                    <th>#</th>
                                    <th>Item Description</th>
                                    <th>Unit</th>
                                    <th>Batch</th>
                                    <th>Expiry</th>
                                    <th>Balance</th>
                                    <th>Request Bal.</th>
                                    <th width="20%">Issued Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(batch, index) in ris.items" :key="index">
                                    <td>{{ index + 1}}</td>
                                    <td>{{ batch.item_desc }}</td>
                                    <td>{{ batch.item_unit }}</td>
                                    <td>{{ batch.batch_no }}</td>
                                    <td>{{ batch.expiration_date }}</td>
                                    <td>{{ batch.remaining_quantity }}</td>
                                    <td>{{ batch.requested_quantity }}</td>
                                    <td>
                                        <span v-show="editmode">
                                            <input type="text" class="form-control form-control-sm" v-model="batch.issued_quantity" required>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                            
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-right">
                        <button type="button" v-show="!editmode" class="btn btn-sm btn-success" @click="edit_ris()">Edit or Issue Quantity</button>
                        <button type="button" v-show="editmode" class="btn btn-sm btn-warning" @click="cancel_edit()">Cancel</button>
                        <button type="submit" v-show="editmode" class="btn btn-sm btn-success">Save or Update</button>
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
import{ mapActions, mapGetters, mapState } from 'vuex'
export default {
    data(){
        return{
            editmode: false,
            ris: {
                batches: []
            },
            message_box: '',
        }
    },
    methods: {

        get_ris(){
            axios.get('pmo_ris/'+this.$route.params.id).then(({data}) => {
                this.ris = data;
            }).catch(() => {

            });
        },
        accept_batch(id){
            axios.put('accept_batch/'+id).then(() => {
                this.get_ris();
                this.message_box = 'success';
            }).catch(() => {
                this.message_box = 'error';
            });
        },
        cancel_edit(){
            this.editmode = false;
        },
        edit_ris(){
            this.editmode = true;
        },
        save_ris(){
            this.editmode = false;
            axios.put('issue/'+this.$route.params.id,{
                batches: this.ris.batches,
            }).then(() => {
                this.$router.push({ name: 'requisition_slips' });
            }).catch(() => {

            });
        }
    },
    created(){
        this.get_ris();
    },
    computed:{

    },
}
</script>

<style scoped>
    table tbody tr td{
        height: 20px !important;
    }
</style>