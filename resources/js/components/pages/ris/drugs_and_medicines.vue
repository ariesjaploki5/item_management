<template>
  <div>
    <div class="form-group row mt-2 mb-2">
        <div class="col-auto">
            <label for="" class="form-label">
                Search: 
            </label>
        </div>
        <div class="col-6">
            <input type="text" class="form-control form-control-sm" v-model="search_word">
        </div>
    </div>
    <table class="table table-sm table-hover" id="table_1" style="height: 13rem !important; table-layout:fixed;">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="75%">Item Description</th>
                <th width="20%">Unit</th>
                <th></th>
            </tr>
        </thead>
        <tbody style="overflow-y: scroll; height: 11rem; width: 96%; position: absolute;">
            <tr v-for="(item, index) in filteredItems" :key="item.item_id">
                <td width="5%">{{ index + 1 }}</td>
                <td width="75%">{{ item.item_desc }}</td>
                <td width="20%">{{ item.unit_desc }}</td>
                <td>
                    <button type="button" @click="add_item(item)" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="w-100 border-bottom border-dark"  v-show="selected_items.length > 0"></div>
    <form @submit.prevent="store_ofs_ris()"  v-show="selected_items.length > 0">
        <div class="card-body">
            <table class="table table-sm table-hover" id="table_1" style="height: 13rem !important; table-layout:fixed;">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="60%">Item Description</th>
                        <th width="20%">Unit</th>
                        <th width="15%" class="text-center">Quantity</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody style="overflow-y: scroll; height: 11rem; width: 96%; position: absolute;">
                    <tr v-for="(item, index) in selected_items" :key="item.item_id">
                        <td width="5%">{{ index + 1 }}</td>
                        <td width="60%">{{ item.item_desc }}</td>
                        <td width="20%">{{ item.unit_desc }}</td>
                        <td width="15%">
                            <input type="number" v-model="item.requested_quantity" class="form-control form-control-sm text-right">
                        </td>
                        <td>
                            <button type="button" @click="remove_item(index)" class="btn btn-sm btn-danger">
                                <i class="fas fa-times"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-auto">
                    <label for="" class="form-label">
                        Purpose:
                    </label>
                </div>
                <div class="col-6">
                    <textarea  class="form-control form-control-sm" rows="1" v-model="purpose" required></textarea>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-sm btn-success">Submit</button>
        </div>
    </form>
               
</div>
</template>

<script>
import{ mapActions, mapGetters, mapMutations } from 'vuex'
export default {
    data(){
        return{
            category_id: null,
            pending_batches: [],
            selected_batches: [],
            selected_items: [],
            purpose: '',
            search_word: '',
            batches: null,
            batch: {
                batch_no: '',
                item_desc: '',
                brand_desc: '',
                unit_desc: '',
                expiration_date: '',
                requested_quantity: '',
                remaining_quantity: '',
            },
            message: '',
            items: [],
        }
    },
    methods: {
        get_items(){
            axios.get('item_drugs_and_medicines').then(({data}) => {
                this.items = data;
            }).catch(() => {

            });
        },
        search_batch(){
            axios.get('search_batch/'+this.search_word).then(({data}) => {
                this.batches = data;
            }).catch(() => {

            });
        },
        store_ris(){
            axios.post('ris', {
                batches: this.selected_batches,
                
            }).then(() => {
                this.$router.push({ name: 'pmo_riss'});
            }).catch(() => {

            });
        },
        add_batch(batch){
            this.message = null;
            var a = this.selected_batches;
            var index = a.findIndex( x => x.batch_no == batch.batch_no )
            if(index === -1){
                this.selected_batches.push({
                    batch_no: batch.batch_no,
                    item_desc: batch.item_desc,
                    brand_desc: batch.brand_desc,
                    unit_desc: batch.unit_desc,
                    expiration_date: batch.expiration_date,
                    requested_quantity: null,
                    remaining_quantity: batch.remaining_quantity,
                });
                this.batch = {
                    batch_no: '',
                    item_desc: '',
                    brand_desc: '',
                    unit_desc: '',
                    expiration_date: '',
                    requested_quantity: '',
                    remaining_quantity: '',
                };
            } else {
                this.message = "Item already exists";
            }

        },
        remove_batch(index){
            this.selected_batches.splice(index, 1);
            // this.pending_batches.splice(index, 1);
        },
    },
    created(){
        this.get_items();
    },
    computed: {
        filteredItems(){
            let matcher = new RegExp(this.search_word, 'i')
            return this.items.filter(function(item){
                return matcher.test(item.item_desc)
            });
        },
    },
}
</script>

<style>

</style>