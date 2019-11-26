<template>
<div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            Print
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
              <li class="breadcrumb-item"><router-link :to="{ name: 'purchase_orders'}">Purchase Order</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'purchase_orders'}">{{ $route.params.id }}</router-link></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
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
                                    Supplier: {{ purchase_order_details.supplier }}
                                </label>
                                <label for="" class="from-label">
                                    OBRS No.: 
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-sm table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Item</th>
                                            <th>Unit Cost</th>
                                            <th>Quantity</th>
                                            <th>Total Cost</th>
                                            <th>Total Received</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in purchase_order_details.items" :key="index">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ item.description }}</td>
                                            <td>{{ item.item_cost }}</td>
                                            <td>{{ item.item_qty }}</td>
                                            <td>{{ item.item_ecost }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
import{ mapActions, mapGetters } from 'vuex'
export default {
    data(){
        return{

        }
    },
    methods: {
        ...mapActions([
            'getPurchaseOrderDetails'
        ]),
    },
    created(){
        this.getPurchaseOrderDetails(this.$route.params.id);
    },
    computed:{
        ...mapGetters([
            'purchase_order_details'
        ]),
    },
}
</script>

<style>

</style>