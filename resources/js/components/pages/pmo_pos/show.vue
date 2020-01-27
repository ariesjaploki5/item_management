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
              <li class="breadcrumb-item"><router-link :to="{ name: 'pmo_pos'}">Purchase Order</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'pmo_po_show', params: { id: $route.params.id }}">{{ $route.params.id }}</router-link></li>
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
                                    <div class="row">
                                        <div class="col-auto">
                                            OBRS No.: 
                                        </div>
                                        <div class="col">
                                            <span v-show="!edit_obrs_mode">
                                                {{ pmo_po.obrs }}
                                            </span>
                                            <span v-show="!edit_obrs_mode && !edit_fund_cluster_mode">
                                                <button class="btn btn-sm btn-success" @click="edit_obrs()">
                                                    <i class="fa fa-pen"></i>
                                                </button>
                                            </span>
                                            <span v-show="edit_obrs_mode">
                                                <form @submit.prevent="update_obrs()">
                                                    <div class="row">
                                                        <div class="col">
                                                            <input type="text" class="form-control form-control-sm" v-model="pmo_po.obrs">
                                                            
                                                        </div>
                                                        <div class="col-auto">
                                                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </span>
                                        </div>
                                    </div>
                                
                                </label>
                                <div class="w-100"></div>
                                <label for="" class="form-label">
                                    <div class="row">
                                        <div class="col-auto">
                                            Fund Cluster.: 
                                        </div>
                                        <div class="col">
                                            <span v-show="!edit_fund_cluster_mode">
                                                {{ pmo_po.fund_cluster }}
                                            </span>
                                            <span v-show="!edit_fund_cluster_mode && !edit_obrs_mode">
                                                <button class="btn btn-sm btn-success" @click="edit_fund_cluster()">
                                                    <i class="fa fa-pen"></i>
                                                </button>
                                            </span>
                                            <span v-show="edit_fund_cluster_mode">
                                                <form @submit.prevent="update_fund_cluster()">
                                                    <div class="row">
                                                        <div class="col">
                                                            <input type="text" class="form-control form-control-sm" v-model="pmo_po.fund_cluster">
                                                            
                                                        </div>
                                                        <div class="col-auto">
                                                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="col-1">
                                <div class="row">
                                    <button class="btn btn-sm btn-primary" type="button" @click="create_iar(pmo_po.po_no)" >Create Iar</button>
                                </div>
                                <div class="row">
                                    <button class="btn btn-sm btn-primary" type="button" @click="create_dv(pmo_po.po_no)" >Create Dv</button>
                                </div>
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
                                <tr v-for="(item, index) in pmo_po.items" :key="index">
                                    <td class="text-right">{{ index + 1 }}</td>
                                    <td>{{ item.item_desc }}</td>
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
            pmo_po: {
                po_no: '',
                pr_no: '',
            },
            edit_obrs_mode: false,
            edit_fund_cluster_mode: false,
        }
    },
    methods: {
        ...mapActions([
            
        ]),
        get_pmo_po(){
            axios.get('pmo_po/'+this.$route.params.id).then(({data}) => {
                this.pmo_po = data;
            }).catch(() => {

            });
        },
        create_iar(id){
            this.$router.push({ name: 'pmo_po_create_iar', params: { id: id } });
        },
        create_dv(id){
            this.$router.push({ name: 'pmo_po_create_dv', params: { id: id } });
        },
        edit_obrs(){
            this.edit_obrs_mode = true;
            
        },
        edit_fund_cluster(){
            this.edit_fund_cluster_mode = true;
            
        },
        update_obrs(){
            axios.put('pmo_po/'+this.$route.params.id+'/obrs',{
                obrs: this.pmo_po.obrs,
            }).then(() => {
                this.edit_obrs_mode = false;
            });
        },
        update_fund_cluster(){
            axios.put('pmo_po/'+this.$route.params.id+'/fund_cluster',{
                fund_cluster: this.pmo_po.fund_cluster,
            }).then(() => {
                this.edit_fund_cluster_mode = false;
            });
        },
    },
    created(){
        this.get_pmo_po();
    },
    computed:{

        ...mapState([
            
        ]),
    },
}
</script>

<style>

</style>