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
              <li class="breadcrumb-item"><router-link :to="{ name: 'requisition_slips'}">Requisition Slips</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'requisition_slip_show', params: { id: $route.params.id }}">{{ $route.params.id }}</router-link></li>
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
                                    <th>Stock No.:</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>Unit Cost</th>
                                    <th>Lot/Batch</th>
                                    <th  v-show="ris.received_date !== null">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(batch, index) in ris.batches" :key="index">
                                    <td>
                                        
                                    </td>
                                    <td>
                                        {{ batch.requested_quantity }}
                                    </td>
                                    <td>
                                        {{ batch.unit_desc }}
                                    </td>
                                    <td>
                                        {{ batch.item_desc }}
                                        <div class="w-100"></div>
                                        <label for="" class="form-label">Brand: </label>{{ batch.brand_desc }}
                                    </td>
                                    <td>
                                        <input v-if="ris.received_date == null && ris.issued_date == null" type="float" class="form-control form-control-sm text-right" v-model="batch.issued_quantity" :max="batch.requested_quantity" required>
                                        <span v-else>{{ batch.issued_quantity }}</span>
                                    </td>
                                    <td>
                                        {{ batch.unit_desc }}
                                    </td>
                                    <td>
                                        {{ batch.cost }}
                                    </td>
                                    <td>
                                        {{ batch.batch_no }}
                                    </td>
                                    <td v-show="ris.received_date !== null">
                                        <button type="button" v-show="batch.accepted == 0" class="btn btn-success btn-sm" @click="accept_batch(batch.batch_ris_id)">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button type="button" v-show="batch.accepted == 1" disabled class="btn btn-warning btn-sm" @click="accept_batch(batch.batch_ris_id)">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                            
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-sm btn-success">Save</button>
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
            ris: {
                batches: []
            },
            message_box: '',
        }
    },
    methods: {

        get_ris(){
            axios.get('ris/'+this.$route.params.id).then(({data}) => {
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
        save_ris(){
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

<style>

</style>