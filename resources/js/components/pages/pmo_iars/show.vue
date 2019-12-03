<template>
<div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>IAR No.: {{ $route.params.id }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
              <li class="breadcrumb-item"><router-link :to="{ name: 'requisition_slips'}">Purchase Order</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'requisition_slip_show', params: { id: $route.params.id }}">{{ $route.params.id }}</router-link></li>
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
                                    PO No.: {{ iar.po_no }}
                                </label>
                                <div class="w-100"></div>
                                <label for="" class="form-label">
                                    PR No.: {{ iar.po.pr_no }}
                                </label>
                            </div>
                            <div class="col-6">
                                <label for="" class="form-label">
                                    Supplier: {{ iar.po.supplier_name }}
                                </label>
                                <div class="w-100"></div>
                                <label for="" class="form-label">
                                    OBRS No.: {{ iar.po.obrs }}
                                </label>
                            </div>
                            <div class="col-1">
                                
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th width="15%" class="text-center">Stock / Property No.</th>
                                    <th width="23%" class="">Description</th>
                                    <th width="10%" class="text-center">Quantity</th>
                                    <th width="12%" class="text-center">Unit Cost</th>
                                    <th width="15%" class="text-center">Total</th>
                                    <th width="15%" class="text-center">Lot/Batch No.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="batch in iar.batches" :key="batch.batch_no">
                                    <td class="text-center"></td>
                                    <td class="text-left">{{ batch.item_desc }}</td>
                                    <td class="text-right">{{ batch.quantity }}</td>
                                    <td class="text-right">{{ batch.cost }}</td>
                                    <td class="text-right">{{ batch.total_cost }}</td>
                                    <td class="text-center">{{ batch.batch_no}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-right">
                        
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
            iar: {
                iar_no: '',
                po_no: '',
                po:{
                    pr_no: '',
                },
                batches: []
            },
        }
    },
    methods: {

        get_iar(){
            axios.get('pmo_iar/'+this.$route.params.id).then(({data}) => {
                this.iar = data;
            }).catch(() => {

            });
        },

    },
    created(){
        this.get_iar();
    },
    computed:{

    },
}
</script>

<style>

</style>