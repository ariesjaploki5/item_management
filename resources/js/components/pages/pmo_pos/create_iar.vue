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
                    <li class="breadcrumb-item"><router-link :to="{ name: 'pmo_pos'}">Purchase Order</router-link></li>
                    <li class="breadcrumb-item"><router-link :to="{ name: 'pmo_po_show', params: { id: $route.params.id }}">{{ $route.params.id }}</router-link></li>
                    <li class="breadcrumb-item active"><router-link :to="{ name: 'pmo_po_create_iar', params: { id: $route.params.id }}">Create IAR</router-link></li>
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
                                    PO No.: {{ pmo_po.po_no }}
                                </label>
                                <div class="w-100"></div>
                                <label for="" class="form-label">
                                    PR No.: {{ pmo_po.pr_no }}
                                </label>
                            </div>
                            <div class="col-6">
                                <label for="" class="form-label">
                                    Supplier: {{ pmo_po.supplier_name }}
                                </label>
                                <div class="w-100"></div>
                                <label for="" class="form-label">
                                    OBRS No.: {{ pmo_po.obrs }}
                                </label>
                            </div>
                            <div class="col-1">
                                <!-- <button class="btn btn-sm btn-primary" type="button" @click="add_obrs(pmo_po.po_no)" >Add Serial No</button> -->
                                <!-- <button class="btn btn-sm btn-primary" type="button" @click="create_iar(pmo_po.po_no)" >Create Iar</button> -->
                            </div>
                        </div>
                    </div>
                    <form @submit.prevent="store_iar()">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
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
                                <!-- <div class="w-100"></div>
                                <label for="" class="form-label">
                                    Ref No.:
                                </label>
                                <input type="text" class="form-control form-control-sm" v-model="iar.ref_no" required> -->
                            </div>
                            <div class="col-4">
                                <!-- <label for="" class="form-label">
                                    Inspection Date.:
                                </label>
                                <input type="date" class="form-control form-control-sm" v-model="iar.inspection_date" required>
                                <div class="w-100"></div>
                                <label for="" class="form-label">
                                    Recieved Date.:
                                </label>
                                <input type="date" class="form-control form-control-sm" v-model="iar.received_date" required>
                                <div class="w-100"></div> -->
                                <label for="" class="form-label">
                                    Ref No.:
                                </label>
                                <input type="text" class="form-control form-control-sm" v-model="iar.ref_no" required>
                                <div class="w-100"></div>
                                <label for="" class="form-label">
                                    Ref Date.:
                                </label>
                                <input type="date" class="form-control form-control-sm" v-model="iar.ref_date" required>
                            </div>
                            <div class="col-3">
                                <label for="" class="form-label">
                                    Days Delayed:
                                </label>
                                <input type="number" class="from-control form-control" v-model="iar.days_delayed" required>
                            </div>
                        </div>
                            <form @submit.prevent="add_item()">
                                <div class="row mt-3">
                                    <div class="col-auto">
                                        <label for="" class="form-label">Please Select Item: </label>
                                    </div>
                                    <div class="col-8">
                                        <select class="form-control form-control-sm" v-model="selected_item" required>
                                            <option v-for="(item, index) in pmo_po.items" :key="index" :value="item">{{ item.item_desc }}</option>
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
                                    <th width="25%">Item</th>
                                    <th class="text-center" width="18%">Batch No.:</th>
                                    <th class="text-center" width="9%">Unit Cost</th>
                                    <th class="text-center" width="9%">Quantity</th>
                                    <th class="text-center" width="9%">Total cost</th>
                                    <th class="text-center" width="18%">Expiration Date</th>
                                    <th width="8%">Remarks</th>
                                    <th width="4%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(batch, index) in batches" :key="batch.temp_id">
                                    <td>
                                        {{ batch.item_desc }}
                                        <div class="w-100" v-show="batch.brand_desc !== null"></div>
                                        <label v-show="batch.brand !== null" for="" class="form-label">Brand: </label>{{ batch.brand }}
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-9">
                                                <input type="text" class="form-control form-control-sm" v-model="batch.batch_no" required :disabled="batch.batch_check">
                                            </div>
                                            <div class="col-3">
                                                <input type="checkbox" class="form-check" v-model="batch.batch_check"> N/A
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="float" class="form-control form-control-sm text-right" v-model="batch.cost" required>
                                    </td>
                                    <td>
                                        <input type="float" class="form-control form-control-sm text-right" v-model="batch.received_quantity" required>
                                    </td>
                                    <td class="text-right">    
                                        <span v-show="batch.received_quantity">{{ batch.cost * batch.received_quantity | round_off }}</span>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-9">
                                                <input type="date" class="form-control form-control-sm" v-model="batch.expiration_date" required :disabled="batch.exp_check">
                                            </div>
                                            <div class="col-3">
                                                <input type="checkbox" class="form-check" v-model="batch.exp_check"> N/A
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <textarea rows="1" class="form-control form-control-sm" v-model="batch.remarks"></textarea>
                                        <!-- <input type="text" class="form-control form-control-sm" v-model="batch.remarks"> -->
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
                    <div class="card-footer text-right" v-show="batches.length > 0">
                        <button class="btn btn-sm btn-warning" type="reset">Cancel</button>
                        <button class="btn btn-sm btn-success" type="submit">Submit</button>
                    </div>
                    </form>
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
                days_delayed: '',
            },
            iar_no: '',
            pmo_po: {
                po_no: '',
                pr_no: '',
            },
        }
    },
    methods:{
        ...mapActions([
            'getInspectionOfficers'
        ]),
        add_item(){
            this.batches.push({
                temp_id: this.batches.length + 1,
                item_unit: this.selected_item.item_unit,
                item_id: this.selected_item.item_id,
                item_desc: this.selected_item.item_desc,
                brand: this.selected_item.brand,
                cost: this.selected_item.cost,
                batch_no: null,
                batch_check: false,
                exp_check: false,
                received_quantity: this.selected_item.quantity - this.selected_item.total_received,
                expiration_date: null,
                remarks: null,
            });
        },
        remove_item(index){
            this.batches.splice(index, 1);
        },
        store_iar(){
            if(this.batches.length > 0){
                axios.post('pmo_iar', {
                    batches: this.batches,
                    po_no: this.$route.params.id,
                    receiving_officer_id: this.iar.receiving_officer_id,
                    // received_date: this.iar.received_date,
                    inspection_officer_id: this.iar.inspection_officer_id,
                    // inspection_date: this.iar.inspection_date,
                    ref_no: this.iar.ref_no,
                    ref_date: this.iar.ref_date,
                    days_delayed: this.iar.days_delayed,
                }).then(({data}) => {
                    this.iar_no = data;
                    // this.$router.push({ name: 'purchase_orders'});
                    this.selected_item = '',
                    this.batches = [],
                    this.iar = {
                        receiving_officer_id: '',
                        inspection_officer_id: '',
                        // inspection_date: '',
                        ref_no: '',
                        ref_date: '',
                    },
                    $("#success_modal").modal("show");
                }).catch(() => {

                })
            }
        },
        go_to_pos(){
            this.$router.push({ name: 'pmo_pos'});
        },
        get_pmo_po(){
            axios.get('pmo_po/'+this.$route.params.id).then(({data}) => {
                this.pmo_po = data;
            }).catch(() => {

            });
        },
    },
    created(){
        this.get_pmo_po();
        this.getInspectionOfficers();
    },
    computed:{
        ...mapGetters([
            'inspection_officers',
        ]),

    }
}
</script>

<style>

</style>