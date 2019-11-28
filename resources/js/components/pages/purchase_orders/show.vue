<template>
<div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>PO No.: {{ $route.params.id }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
              <li class="breadcrumb-item"><router-link :to="{ name: 'purchase_orders'}">Purchase Order</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'purchase_order_show', params: { id: $route.params.id }}">{{ $route.params.id }}</router-link></li>
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
                                <button class="btn btn-sm btn-primary" type="button" @click="create_iar(purchase_order_details.po_no)">Create Iar</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th width="2%">#</th>
                                    <th width="48%">Item</th>
                                    <th class="text-center"  width="15%">Unit Cost</th>
                                    <th class="text-center"  width="10%">Quantity</th>
                                    <th class="text-center"  width="10%">Total Received</th>
                                    <th class="text-center"  width="15%">Total Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in purchase_order_details.items" :key="index">
                                    <td class="text-right">{{ index + 1 }}</td>
                                    <td>
                                        {{ item.item_desc }}
                                        <div v-show="item.brand_desc !== null" class="w-100"></div>
                                        <label v-show="item.brand_desc !== null" class="form-label">Brand: </label>{{ item.brand_desc }}
                                        <!-- <div class="w-100"></div>
                                        <label for="" class="form-label">Packaging: </label>{{ item.packaging_desc }}
                                        <div class="w-100"></div>
                                        <label for="" class="form-label">Manufacturer: </label>{{ item.manufacturer_desc }}
                                        <div class="w-100"></div>
                                        <label for="" class="form-label">Country: </label>{{ item.country_desc }} -->
                                    </td>
                                    <td class="text-right">{{ item.cost }}</td>
                                    <td class="text-right">{{ item.quantity }}</td>
                                    <td class="text-right">{{ item.total_received }}</td>
                                    <td class="text-right">{{ item.total_cost }}</td>

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
import{ mapActions, mapGetters, mapState } from 'vuex'
export default {
    data(){
        return{

        }
    },
    methods: {
        ...mapActions([
            'getPurchaseOrderDetails'
        ]),
        create_iar(id){
            this.$router.push({ name: 'create_iar', params: { id: id } });
        },
    },
    created(){
        this.getPurchaseOrderDetails(this.$route.params.id);
    },
    computed:{

        ...mapState([
            'purchase_order_details'
        ]),
    },
}
</script>

<style>

</style>