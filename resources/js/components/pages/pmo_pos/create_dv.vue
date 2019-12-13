<template>
     <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Create DV</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
                    <li class="breadcrumb-item"><router-link :to="{ name: 'pmo_pos'}">Purchase Order</router-link></li>
                    <li class="breadcrumb-item"><router-link :to="{ name: 'pmo_po_show', params: { id: $route.params.id }}">{{ $route.params.id }}</router-link></li>
                    <li class="breadcrumb-item active"><router-link :to="{ name: 'pmo_po_create_dv', params: { id: $route.params.id }}">Create IAR</router-link></li>
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
                    <form @submit.prevent="store_dv()">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-auto">
                                <label for="" class="form-label">
                                    Item Description:
                                </label>
                            </div>
                            <div class="col">
                                {{ pmo_po.first_item }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-auto">
                                <label for="" class="form-label">
                                    Approving Officer:
                                </label>
                            </div>
                            <div class="col">
                                <select name="" id="" class="form-control form-control-sm">
                                    <option v-for="ao in approving_officers" :key="ao.approving_officer_id" :value="ao.approving_officer_id">
                                        {{ ao.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-right">

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
            pmo_po: {
                po_no: '',
                pr_no: '',
            },
        }
    },
    methods:{
        ...mapActions([
            'getApprovingOfficers'
        ]),
        add_item(){
            this.batches.push({
                temp_id: this.batches.length + 1,
                item_unit: this.selected_item.item_unit,
                item_id: this.selected_item.item_id,
                item_desc: this.selected_item.item_desc,
                brand: this.selected_item.brand,
                cost: this.selected_item.cost,
                received_quantity: '',
                expiration_date: '',
                remarks: '',
            });
        },
        remove_item(index){
            this.batches.splice(index, 1);
        },
        store_dv(){
            if(this.batches.length > 0){
                axios.post('pmo_iar', {
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
        this.getApprovingOfficers();
    },
    computed:{
        ...mapGetters([
            'approving_officers',
        ]),

    }
}
</script>

<style>

</style>