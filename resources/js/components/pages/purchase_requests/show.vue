<template>
<div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>PR No.: {{ $route.params.id }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
              <li class="breadcrumb-item"><router-link :to="{ name: 'purchase_requests'}">Purchase Requests</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'purchase_request_show', params: { id: $route.params.id }}">{{ $route.params.id }}</router-link></li>
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
                                    PR No.: {{ purchase_request_details.pr_no }}
                                </label>
                            </div>
                            <div class="col text-right">
                                <button class="btn btn-sm btn-primary" type="button" @click="create_po(purchase_request_details.pr_no)">Create PO</button>
                                <button class="btn btn-sm btn-primary" type="button" @click="create_rfq(purchase_request_details.pr_no)">Create RFQ</button>
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
                                    <th class="text-center"  width="15%">Total Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in purchase_request_details.items" :key="index">
                                    <td class="text-right">{{ index + 1 }}</td>
                                    <td>{{ item.item_desc }}</td>
                                    <td class="text-right">{{ item.cost }}</td>
                                    <td class="text-right">{{ item.quantity }}</td>
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
            'getPurchaseRequestDetails'
        ]),
        create_po(id){
            this.$router.push({ name: 'purchase_order_create', params: { id: id } });
        },
        create_rfq(id){
            this.$router.push({ name: 'create_rfq', params: { id: id } });
        }
    },
    created(){
        this.getPurchaseRequestDetails(this.$route.params.id);
    },
    computed:{

        ...mapState([
            'purchase_request_details'
        ]),
    },
}
</script>

<style>

</style>