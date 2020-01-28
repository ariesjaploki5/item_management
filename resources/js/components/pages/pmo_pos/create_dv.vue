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
                        <li class="breadcrumb-item active"><router-link :to="{ name: 'pmo_po_create_dv', params: { id: $route.params.id }}">Create DV</router-link></li>
                    </ol>
                </div>
            </div>
        </div>
        </section>
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
                                        <select name="" id="" class="form-control form-control-sm" v-model="dv.approving_officer_id">
                                            <option v-for="ao in approving_officers" :key="ao.approving_officer_id" :value="ao.approving_officer_id">
                                                {{ ao.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-auto">
                                        <label for="" class="form-label">
                                            Liquidated Damages:
                                        </label>
                                    </div>
                                    <div class="col-sm">
                                        <table class="table table-sm table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th></th>
                                                    <th class="text-center">Taxes</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(lq, index) in liquidated_damages" :key="index">
                                                    <td>{{ index + 1 }}</td>
                                                    <td>{{ lq.iar_id }}</td>
                                                    <td class="text-right">{{ lq.liquidated_damage }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-auto">
                                        <label for="" class="form-label">
                                            Attachments
                                        </label>
                                    </div>
                                    <div class="col-sm">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th width="5%">#</th>
                                                    <th width="50%">Attachments</th>
                                                    <th width="40%">Number/Date/Particulars</th>
                                                    <th width="5%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(a, index) in po_attachments" :key="index">
                                                    <td>{{ index + 1 }}</td>
                                                    <td>{{ a.attachment.attachment_desc }}</td>
                                                    <td>{{ a.number_date_particulars }}</td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-sm btn-danger" @click="remove_attachment()"><i class="fa fa-times"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"></td>
                                                    <td class="text-center">
                                                        <div class="text-center">
                                                            <button type="button" class="btn btn-sm btn-primary" @click="add_attachment()"><i class="fa fa-plus"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-sm btn-warning" type="reset">Cancel</button>
                                <button class="btn btn-sm btn-success" type="submit">Submit</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade" id="attachment_modal" tabindex="-1" role="dialog" aria-labelledby="attachment_modal" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="attachment_modal">
                        <span>Add Attachment</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="store_po_attachment()">
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-4 text-right">
                                <label for="" class="form-label">
                                    Attachment:
                                </label>
                            </div>
                            <div class="col-sm-8">
                                <select class="form-control form-control-sm" v-model="po_attachment.attachment_id">
                                    <option v-for="(a, index) in attachments" :key="index" :value="a.attachment_id">
                                        {{ a.attachment_desc }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4 text-right">
                                <label for="" class="form-label">
                                    Number/Date/Particulars:
                                </label>
                            </div>
                            <div class="col-sm-8">
                                <textarea type="text" rows="3" class="form-control form-control-sm" v-model="po_attachment.number_date_particulars">
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-sm btn-success" type="submit">Submit</button>
                    </div>
                </form>
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
            liquidated_damages: [],
            
            dv: {
                approving_officer_id: '',
            },

            pmo_po: {
                po_no: '',
            },

            po_attachment: {
                attachment_id: '',
                number_date_particulars: '',
            },

            po_attachments: [],
            attachments: [],

        }
    },
    methods:{
        ...mapActions([
            'getApprovingOfficers'
        ]),
        get_attachments(){
            axios.get('attachment').then(({data}) => {
                this.attachments = data;
            }).catch(() => {

            });
        },
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
            axios.post('store_dv', {
                liquidated_damages: this.liquidated_damages,
                po_no: this.$route.params.id,
                approving_officer_id: this.approving_officer_id,
            }).then((data) => {
            
            });
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
        get_liquidated_damages(){
            axios.get('liquidated_damage/'+this.$route.params.id).then(({data}) => {
                this.liquidated_damages = data;
            }).catch(() => {

            });
        },
        get_po_attachments(){
            axios.get('po_attachments/'+this.$route.params.id).then(({data}) => {
                this.po_attachments = data;
            }).catch(() => {

            });
        },
        add_attachment(){
            $('#attachment_modal').modal('show');
        },
        store_po_attachment(){
            axios.post('store_po_attachment', {
                po_no: this.$route.params.id,
                attachment_id: this.po_attachment.attachment_id,
                number_date_particulars: this.po_attachment.number_date_particulars,
            }).then(() => {

            });
        }
    },
    created(){
        this.get_pmo_po();
        this.getApprovingOfficers();
        this.get_liquidated_damages();
        this.get_attachments();
        this.get_po_attachments();
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