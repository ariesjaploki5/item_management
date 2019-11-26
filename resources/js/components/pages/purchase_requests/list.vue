<template>
<div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Purchase Requests</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'purchase_requests'}">Purchase Requests</router-link></li>
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
                                <form @submit.prevent="search_prs()">
                                    <div class="form-group row">
                                        <input type="text" class="form-control form-control-sm col-4 mr-2" v-model="search_word" required>
                                        <button class="btn btn-sm btn-primary" type="submit">search</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-6 text-right">
                                <button class="btn btn-sm btn-primary" @click="create_pr()">Creat PR</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>PR No.:</th>
                                    <th>PR Date</th>
                                    <th>Department</th>
                                    <th>Category</th>
                                    <th>Requested By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(pr, index) in purchase_requests" :key="index">
                                    <td>{{ pr.pr_no }}</td>
                                    <td>{{ pr.pr_date }}</td>
                                    <td>{{ pr.department_desc }}</td>
                                    <td>{{ pr.category_desc }}</td>
                                    <td>{{ pr.requested_by }}</td>
                                    <td>
                                        <div class="btn-group dropleft">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                               <button class="dropdown-item" type="button" @click="view_pr(pr.pr_no)">View</button>
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
        create_pr(){
            this.$router.push({ name: 'purchase_request_create' });
        },
        async search_prs(){

            this.searchPurchaseRequests(this.search_word);

        },
        ...mapActions([
            'getPurchaseRequests', 
            'searchPurchaseRequests',
            'getPurchaseRequestDetails'
        ]),
        async view_pr(id){
            this.getPurchaseRequestDetails(id);
            this.$router.push({ name: 'purchase_request_show', params: { id: id } });
        },
        async print_po(id){
            this.$router.push({ name: 'purchase_request_print', params: { id: id } });
        },
    },
    computed:{
        ...mapGetters([
            'purchase_requests', 
        ]),
    },
    created(){
        this.getPurchaseRequests();
    },
}
</script>
<style lang="css" scoped>

</style>