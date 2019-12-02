<template>
     <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Create IAR</h1>
            </div>
            <div class="col-sm-6">

                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
                <li class="breadcrumb-item"><router-link :to="{ name: 'purchase_orders'}">Purchase Order</router-link></li>
                <li class="breadcrumb-item"><router-link :to="{ name: 'purchase_order_show', params: { id: $route.params.id }}">{{ $route.params.id }}</router-link></li>
                <li class="breadcrumb-item active"><router-link :to="{ name: 'create_iar', params: { id: $route.params.id }}">Create IAR</router-link></li>
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
                            <div class="col-5">
                                <label for="" class="form-label">
                                    PO No.: {{ purchase_order_details.po_no }}
                                </label>
                                <div class="w-100"></div>
                                <label for="" class="form-label">
                                    PR No.: {{ purchase_order_details.pr_no }}
                                </label>
                            </div>
                            <div class="col-6">
                                <label for="" class="form-label">
                                    Supplier: {{ purchase_order_details.supplier_name }}
                                </label>
                                <div class="w-100"></div>
                                <label for="" class="form-label">
                                    OBRS No.: {{ purchase_order_details.obrs }}
                                </label>
                            </div>
                            <div class="col-1">
                                <!-- <button class="btn btn-sm btn-primary" type="button" @click="add_obrs(purchase_order_details.po_no)" >Add Serial No</button> -->
                                <!-- <button class="btn btn-sm btn-primary" type="button" @click="create_iar(purchase_order_details.po_no)" >Create Iar</button> -->
                            </div>
                        </div>
                    </div>
                    <form @submit.prevent="store_iar()">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-7">
                                <label for="" class="form-label">
                                    Inspection Officer:
                                </label>
                                
                                <select class="form-control form-control-sm" v-model="iar.inspection_officer_id" required>
                                    <option v-for="officer in inspection_officers" :key="officer.inspection_officer_id" :value="officer.inspection_officer_id">{{ officer.name }}</option>
                                </select>

                                <div class="w-100"></div>
                                <label for="" class="form-label">
                                    Receiving Officer:
                                </label>
                                <select class="form-control form-control-sm" v-model="iar.receiving_officer_id" required>
                                    <option v-for="officer in inspection_officers" :value="officer.inspection_officer_id" :key="officer.inspection_officer_id">{{ officer.name }}</option>
                                </select>
                                <div class="w-100"></div>
                                <label for="" class="form-label">
                                    Ref No.:
                                </label>
                                <input type="text" class="form-control form-control-sm" v-model="iar.ref_no" required>
                            </div>
                            <div class="col-5">
                                <label for="" class="form-label">
                                    Inspection Date.:
                                </label>
                                <input type="date" class="form-control form-control-sm" v-model="iar.inspection_date" required>
                                <div class="w-100"></div>
                                <label for="" class="form-label">
                                    Recieved Date.:
                                </label>
                                <input type="date" class="form-control form-control-sm" v-model="iar.received_date" required>
                                <div class="w-100"></div>
                                <label for="" class="form-label">
                                    Ref Date.:
                                </label>
                                <input type="date" class="form-control form-control-sm" v-model="iar.ref_date" required>
                            </div>
                        </div>
                            <form @submit.prevent="add_item()">
                                <div class="row mt-3">
                                    <div class="col-auto">
                                        <label for="" class="form-label">Please Select Item: </label>
                                    </div>
                                    <div class="col-8">
                                        <select class="form-control form-control-sm" v-model="selected_item" required>
                                            <option v-for="(item, index) in purchase_order_details.items" :key="index" :value="item">{{ item.item_desc }}</option>
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <button  v-show="selected_item !== null"  class="btn btn-sm btn-primary" type="submit"  data-toggle="tooltip" data-placement="top" title="Add item">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            
                        
                        <table class="table table-sm table-hover table-bordered" v-show="batches.length > 0">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th class="text-center">Batch No.:</th>
                                    <th class="text-center" width="12%">Unit Cost</th>
                                    <th class="text-center" width="10%">Quantity</th>
                                    <th class="text-center" width="10%">Total cost</th>
                                    <th class="text-center" width="10%">Expiration Date</th>
                                    <th>Remarks</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(batch, index) in batches" :key="batch.temp_id">
                                    <td>
                                        {{ batch.item_desc }}
                                        <div class="w-100" v-show="batch.brand_desc !== null"></div>
                                        <label v-show="batch.brand_desc !== null" for="" class="form-label">Brand: </label>{{ batch.brand_desc }}
                                        <!-- <div class="w-100"></div>
                                        <label for="" class="form-label">Packaging: </label>{{ batch.packaging_desc }}
                                        <div class="w-100"></div>
                                        <label for="" class="form-label">Manufacturer: </label>{{ batch.manufacturer_desc }}
                                        <div class="w-100"></div>
                                        <label for="" class="form-label">Country: </label>{{ batch.country_desc }} -->
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm" v-model="batch.batch_no" required>
                                    </td>
                                    <td>
                                        <input type="float" class="form-control form-control-sm text-right" v-model="batch.cost" required>
                                    </td>
                                    <td>
                                        <input type="float" class="form-control form-control-sm text-right" v-model="batch.received_quantity" required>
                                    </td>
                                    <td class="text-right">    
                                        <span v-show="batch.received_quantity">{{ batch.cost * batch.received_quantity }}</span>
                                    </td>
                                    <td>
                                        <input type="date" class="form-control form-control-sm" v-model="batch.expiration_date" required>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm" v-model="batch.remarks">
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" type="button" @click="remove_item(index)"  data-toggle="tooltip" data-placement="top" title="Remove Item">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- /.card-body -->
                    <div class="card-footer text-right" v-show="batches.length > 0">

                        <button class="btn btn-sm btn-warning" type="reset">Cancel</button>
                        <button class="btn btn-sm btn-success" type="submit">Submit</button>
                    </div>
                    </form>
                    <!-- /.card-footer-->
                </div>
              </div>
          </div>
      </div>
    </section>
    <div class="modal fade" id="success_modal" tabindex="-1" role="dialog" aria-labelledby="success_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="success_modalLabel">Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 text-center">
                        <h4>Success IAR NO.: {{ iar_no }}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-block btn-primary" data-dismiss="modal" type="button">Create Another IAR for this PO</button>
                    </div>
                    <div class="col-12 mt-2">
                        <button class="btn btn-block btn-primary" data-dismiss="modal" type="button" @click="go_to_pos()">Go to PO List</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import { mapActions, mapState, mapGetters } from 'vuex'
export default {
    data(){
        return{
            selected_item: '',
            batches: [],
            iar: {
                inspection_officer_id: '',
                inspection_date: '',
                receiving_officer_id: '',
                received_date: '',
                ref_no: '',
                ref_date: '',
            },
            iar_no: '',
        }
    },
    methods:{
        ...mapActions([
            'getPurchaseOrderDetails',
            'getInspectionOfficers'
        ]),
        add_item(){
            this.batches.push({
                temp_id: this.batches.length + 1,
                item_id: this.selected_item.item_id,
                item_desc: this.selected_item.item_desc,
                brand_id: this.selected_item.brand_id,
                brand_desc: this.selected_item.brand_desc,
                packaging_id: this.selected_item.packaging_id,
                packaging_desc: this.selected_item.packaging_desc,
                manufacturer_id: this.selected_item.manufacturer_id,
                manufacuter_desc: this.selected_item.manufacuter_desc,
                country_id: this.selected_item.country_id,
                country_desc: this.selected_item.country_desc,
                cost: this.selected_item.cost,
                received_quantity: '',
                expiration_date: '',
                remarks: '',
            });
        },
        remove_item(index){
            this.batches.splice(index, 1);
        },
        store_iar(){
            if(this.batches.length > 0){
                axios.post('iar', {
                    batches: this.batches,
                    po_no: this.$route.params.id,
                    receiving_officer_id: this.iar.receiving_officer_id,
                    received_date: this.iar.received_date,
                    inspection_officer_id: this.iar.inspection_officer_id,
                    inspection_date: this.iar.inspection_date,
                    ref_no: this.iar.ref_no,
                    ref_date: this.iar.ref_date,
                }).then(({data}) => {
                    this.iar_no = data;
                    // this.$router.push({ name: 'purchase_orders'});
                    this.selected_item = '',
                    this.batches = [],
                    this.iar = {
                        received_date: '',
                        inspection_officer_id: '',
                        inspection_date: '',
                        ref_no: '',
                        ref_date: '',
                    },
                    $("#success_modal").modal("show");
                }).catch(() => {

                })
            }
        },
        go_to_pos(){
            this.$router.push({ name: 'purchase_orders'});
        },

    },
    created(){
        this.getPurchaseOrderDetails(this.$route.params.id);
        this.getInspectionOfficers();
    },
    computed:{
        ...mapGetters([
            'inspection_officers',
        ]),
        ...mapState([
            'purchase_order_details',
        ]),
    }
}
</script>

<style>

</style>