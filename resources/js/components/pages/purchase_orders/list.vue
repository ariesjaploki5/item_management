<template>
<div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Purchase Orders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'purchase_orders'}">Purchase Orders</router-link></li>
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
                            <div class="col-6">
                                <form @submit.prevent="search_pos()">
                                    <div class="form-group row">
                                        <input type="text" class="form-control form-control-sm col-4 mr-2" v-model="search_word" required>
                                        <button class="btn btn-sm btn-primary" type="submit">search</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-6 text-right">
                                <!-- <button class="btn btn-sm btn-primary" @click="create_po()">Creat PO</button> -->
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>PO No.:</th>
                                    <th>PO Date</th>
                                    <th>PR No.:</th>
                                    <th>Supplier</th>
                                    <th>Department</th>
                                    <th>Mode</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(po, index) in purchase_orders" :key="index">
                                    <td>{{ po.po_no }}</td>
                                    <td>{{ po.po_date }}</td>
                                    <td>{{ po.pr_no }}</td>
                                    <td>{{ po.supplier_name }}</td>
                                    <td>{{ po.dept_name }}</td>
                                    <td>{{ po.mode_desc }}</td>
                                    <td>
                                        <div class="btn-group dropleft">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                               <button class="dropdown-item" type="button" @click="view_po(po.po_no)">View</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                
                    </div>
                    <!-- /.card-footer-->
                </div>
              </div>
          </div>
      </div>

    </section>
</div>
    
</template>
<script>

import{ mapActions, mapGetters, mapMutations } from 'vuex'
export default {

    data(){
        return{
            search_word: '',
        }
    },

    methods:{
        create_po(){
            this.$router.push({ name: 'purchase_order_create' });
        },
        async search_pos(){

            this.searchPurchaseOrders(this.search_word);

        },
        ...mapActions([
            'getPurchaseOrders', 
            'searchPurchaseOrders',
            'getPurchaseOrderDetails'
        ]),
        async view_po(id){
            this.getPurchaseOrderDetails(id);
            this.$router.push({ name: 'purchase_order_show', params: { id: id } });
        },
        async print_po(id){
            this.$router.push({ name: 'purchase_order_print', params: { id: id } });
        },
    },
    computed:{
        ...mapGetters([
            'purchase_orders', 
        ]),
    },
    created(){
        this.getPurchaseOrders();
    },
}
</script>
<style lang="css" scoped>

</style>