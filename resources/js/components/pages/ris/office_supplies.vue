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
    <table class="table table-sm table-hover" id="table_1">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="75%">Item Description</th>
                <th width="20%">Unit</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
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
            <table class="table table-sm table-hover" id="table_1">
            <thead>
                <tr>
                <th width="5%">#</th>
                <th width="60%">Item Description</th>
                <th width="20%">Unit</th>
                <th width="15%" class="text-center">Quantity</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(item, index) in selected_items" :key="item.item_id">
                <td width="5%">{{ index + 1 }}</td>
                <td width="60%">{{ item.item_desc }}</td>
                <td width="20%">{{ item.unit_desc }}</td>
                <td width="15%">
                    <input type="float" v-model="item.requested_quantity" class="form-control form-control-sm text-right">
                </td>
                <td>
                    <button type="button" @click="remove_item(index)" class="btn btn-sm btn-danger">
                        <i class="fas fa-times"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
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

            search_word: '',

            items: [],
            selected_items: [],
            message: null,
        }
    },
    methods: {

        get_office_supplies(){
            axios.get('office_supplies').then(({data}) => {
                this.items = data;
            }).catch(() => {

            });
        },

        add_item(item){
            var a = this.selected_items;
            var index = a.findIndex( x => x.item_id == item.item_id )
            if(index === -1){
                this.selected_items.push(item);
            } 

        },
        remove_item(index){
            this.selected_items.splice(index, 1);
        },
        store_ofs_ris(){
            axios.post('store_ofs_ris', {
                items: this.selected_items,
            }).then(({data}) => {
                this.selected_items = [];
                this.message = "success";
                this.$router.push({ name: 'requisition_slip_print', params: { id: data } });
            }).catch((error) => {
                this.message = error;
            });
        }
    },
    created(){
        this.get_office_supplies();
        
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

<style scoped>
    table  {
        height: 13rem !important;
      
        table-layout:fixed;
    }
    tbody {
        overflow-y: scroll;      
        height: 11rem;           
        width: 96%;
        position: absolute;
    }



</style>