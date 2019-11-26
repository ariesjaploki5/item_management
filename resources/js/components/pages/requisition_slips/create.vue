<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Requisition Slips</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
              <li class="breadcrumb-item"><router-link :to="{ name: 'requisition_slips'}">Requisition Slips</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'requisition_slip_create'}">Create</router-link></li>
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
                            <div class="col-12">
                                <div class="card-tools">
                                    <button type="button" class="btn btn-sm btn-primary" @click="select_batch()">Select Item</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form @submit.prevent="store_ris()">
                    <div class="card-body">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Unit</th>
                                    <th>Quantity</th>
                                    <th>Batch No</th>
                                    <th>Remaining Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(batch, index) in selected_batches" :key="index">
                                    <td>
                                        {{ batch.item_desc }}
                                        <div class="w-100"></div>
                                        <label for="" class="form-label">brand: </label> {{ batch.brand_desc }}
                                    </td>
                                    <td>
                                        {{ batch.unit_desc }}
                                    </td>
                                    <td>
                                        <input type="float" class="form-control form-control-sm text-right"  v-model="batch.requested_quantity" :max="batch.remainining_quantity">
                                    </td>
                                    <td>{{ batch.batch_no }}</td>
                                    <td>{{ batch.remaining_quantity }}</td>
                                    <td>
                                        <button type="button" @click="remove_batch(index)" class="btn btn-sm btn-danger">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-sm btn-success">Submit</button>
                    </div>
                    <!-- /.card-footer-->
                    </form>
                </div>
              </div>
          </div>
      </div>

    </section>
    <div class="modal fade" id="select_batch_modal" tabindex="-1" role="dialog" aria-labelledby="select_batch_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl  modal-dialog-scrollable" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="select_batch_modalLabel">Select Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <div class="row">
                    <div class="col-4">
                        <input type="text" class="form-control form-contro-sm">
                    </div>
                    <div class="col-4">

                    </div>
                </div> -->
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th width="35%">Item</th>
                            <th class="text-center">Homis Stock</th>
                            <th class="text-center">MMO Stock</th>
                            <th class="text-center">Brand</th>
                            <th class="text-center">Batch No</th>
                            <th class="text-center">Expiration Date</th>
                            <th class="text-center">Cost</th>
                            <th class="text-center">Remaining Quantity</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in items" :key="index">
                            <td>{{ item.item_desc }}</td>
                            <td class="text-right">{{ item.homis_stock}}</td>
                            <td class="text-right">{{ item.mmo_stock }}</td>
                            <td>
                                <tr v-for="batch in item.batches" :key="batch.batch_no"> 
                                    <td><input type="checkbox"  v-model="pending_batches" :value="batch"></td>
                                    <td>{{ batch.brand_desc }}</td>  
                                </tr>
                            </td>
                            <td>
                                <tr v-for="batch in item.batches" :key="batch.batch_no"> 
                                    <td>{{ batch.batch_no }}</td>  
                                </tr>
                            </td>
                            <td>
                                <tr v-for="batch in item.batches" :key="batch.batch_no"> 
                                    <td class="text-center"> {{ batch.expiration_date }}</td>
                                </tr>
                            </td>
                            <td>
                                <tr v-for="batch in item.batches" :key="batch.batch_no"> 
                                    <td class="text-right">{{ batch.cost }}</td>
                                </tr>
                            </td>
                            <td>
                                <tr v-for="batch in item.batches" :key="batch.batch_no"> 
                                    <td class="text-right"> {{ batch.remaining_quantity }}</td>
                                </tr>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" @click="transfer_batch()">OK</button>
            </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import{ mapActions, mapGetters, mapMutations } from 'vuex'
export default {
    data(){
        return{
            pending_batches: [],
            selected_batches: [],
        }
    },
    methods: {
        ...mapActions([
            'getItems'
        ]),
        store_ris(){
            axios.post('ris', {
                batches: this.selected_batches,
                
            }).then(() => {
                this.$router.push({ name: 'requisition_slips'});
            }).catch(() => {

            });
        },
        select_batch(){
            $("#select_batch_modal").modal("show");
        },
        transfer_batch(){
            this.selected_batches = this.pending_batches;
            $("#select_batch_modal").modal("hide");
        },
        add_batch(batch){
            this.batches.push({
                batch_no: batch.batch_no,
                item_desc: batch.item_desc,
                brand_desc: batch.brand_desc,
                unit_desc: batch.unit_desc,
                requested_quantity: null,
                remaining_quantity: batch.remaining_quantity,
            });
        },
        remove_batch(index){
            this.selected_batches.splice(index, 1);
            this.pending_batches.splice(index, 1);
        },
    },
    created(){
        this.getItems();
    },
    computed: {
        ...mapGetters([
            'items'
        ]),
    },
}
</script>

<style>

</style>