<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row ">
          <div class="col-sm-6">
            <h4>Office Supplies</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
              <li class="breadcrumb-item"><router-link :to="{ name: 'items'}">Items</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'item_ofs' }">Offices Supplies</router-link></li>
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
                            <div class="col-4">
                                <input type="text" class="form-control form-control-sm" v-model="search_word">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th width="20%">Stock No</th>
                                    <th width="40%">Description</th>
                                    <th width="15%">Brand</th>
                                    <th width="15%">Stock</th>
                                    <th width="10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in filteredItems" :key="item.item_id">
                                    <td width="20%">{{ item.sl_code }}</td>
                                    <td width="40%">{{ item.item_desc }}</td>
                                    <td width="15%">{{ item.brand_desc }}</td>
                                    <td width="15%" class="text-right">{{ item.stock }}</td>
                                    <td width="10%" class="text-center">
                                        <div class="btn-group dropleft">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                               <button class="dropdown-item" type="button" @click="view_item(item)">Adjust Balance</button>
                                               <button class="dropdown-item" type="button" @click="edit_beginning_balance(item)">Update Beginning Balance</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
          </div>
      </div>
    </section>
    <section class="content_modal">
        <div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="itemModalLabel">Adjust Balance</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-auto">
                            <label for="" class="form-label">Item:</label>
                        </div>
                        <div class="col-8">
                            {{ item.item_desc }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto">
                            <label for="" class="form-label">Brand</label>
                        </div>
                        <div class="col-auto">
                            {{ item.brand_desc }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto">
                            <label for="" class="form-label">
                                Stock:
                            </label>
                        </div>
                        <div class="col-8">
                            {{ item.stock }}
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-sm btn-success" type="button" @click="edit_stock()">
                                update
                            </button>
                        </div>
                    </div>

                </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Adjust Balance</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="update_stock()">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-auto">
                                <input type="radio" value="1" v-model="form.type_id">
                            </div>
                            <div class="col-auto">
                                <label for="" class="form-label">Increase</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-auto">
                                <input type="radio" value="2" v-model="form.type_id">
                                
                            </div>
                            <div class="col-auto">
                                <label for="" class="form-label">Decrease</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-auto">
                                <label for="" class="form-label">Quantity</label>
                            </div>
                            <div class="col-auto">
                                <input type="float" class="form-contol form-control-sm text-right" v-model="form.quantity">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-sm btn-success" type="submit">Save</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editBeginningBalanceModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Update Beginning Balance</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="update_beginning_balance()">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-auto">
                                <label for="" class="form-label">Quantity</label>
                            </div>
                            <div class="col-auto">
                                <input type="number" class="form-control form-control-sm text-right" v-model="item.stock">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-sm btn-success" type="submit">update</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </section>
</div>
</template>

<script>


import{ mapActions, mapGetters, mapMutations, mapState } from 'vuex'
export default {

    data(){
        return{
            search_word: '',
            items: [],
            item: {},
            form: {
                quantity: null,
                type_id: null,
            },
        }
    },
    methods: {
        get_office_supplies(){
            axios.get('office_supplies').then(({data}) => {
                this.items = data;
            }).catch(() => {

            });
        },
        edit_stock(item){
            $('#editModal').modal('show');
        },
        view_item(item){
            this.item = item;
            $('#itemModal').modal('show');
        },
        store_stock(){
            axios.post('stock', {
                
            }).then(() => {

            }).catch(() => {

            });
        },
        update_stock(){
            axios.put('stock/'+this.item.sl_code, {
                quantity: this.form.quantity,
                type_id: this.form.type_id,
            }).then(({data}) => {
                $('#editModal').modal('hide');
                $('#itemModal').modal('hide');
            }).catch(() => {

            });
        },
        edit_beginning_balance(item){
            this.item = item;
            $('#editBeginningBalanceModal').modal('show');
        },
        update_beginning_balance(){
            axios.put('update_beginning_balance/'+this.item.sl_code, {
                stock: this.item.stock,
            }).then(() => {
                $('#editBeginningBalanceModal').modal('hide');
            }).catch(() => {

            });
        },
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
    mounted(){

    }
}
</script>

<style scoped>
    table  {
        height: 32rem !important;
        table-layout:fixed;
    }
    tbody {
        overflow-y: scroll;      
        height: 30rem;           
        width: 96%;
        position: absolute;
    }

</style>