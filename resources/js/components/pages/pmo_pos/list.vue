<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row ">
          <div class="col-sm-6">
            <h1>PMO Purchase Orders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'pmo_pos'}">PO</router-link></li>
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
                                <form @submit.prevent="search_pmo_pos()">
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
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>PO No.:</th>
                                    <th>PO Date</th>
                                    <th>PR No.:</th>
                                    <th>Supplier</th>
                                    <th>Department</th>
                                    <th>Mode</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="po in filteredPos" :key="po.po_no" @click="view_pmo_po(po.po_no)">
                                    <td>{{ po.po_no }}</td>
                                    <td>{{ po.po_date }}</td>
                                    <td>{{ po.pr_no }}</td>
                                    <td>{{ po.supplier_name }}</td>
                                    <td>{{ po.dept_name }}</td>
                                    <td>{{ po.procurement_mode }}</td>
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


import{ mapActions, mapGetters, mapMutations, mapState } from 'vuex'
export default {

    data(){
        return{
            search_word: '',
            pmo_pos: [],
        }
    },
    methods: {

        view_pmo_po(id){
            this.$router.push({ name: 'pmo_po_show', params: { id: id } });
        },
        get_pmo_pos(){
            axios.get('pmo_po').then(({data}) => {
                this.pmo_pos = data;
            })
        },
        search_pmo_pos(){
            axios.post('search_pmo_po', {
                search_word: this.search_word
            }).then(({data}) => {
                this.pmo_pos = data
            }).catch(() => {

            });
        },
    },
    created(){
        this.get_pmo_pos();
    },
    computed: {
        filteredPos: function(){
            let matcher = new RegExp(this.search_word, 'i')
            return this.pmo_pos.filter(function(po){
                return matcher.test(po.po_no)
            });
        },
    },
}
</script>

<style scoped>
tr {
        width: 100%;
        display: inline-table;
        table-layout: fixed;
    }

    table {
        height:28rem;             
        display: -moz-groupbox;    
    }

    tbody {
        overflow-y: scroll;      
        height: 26rem;           
        width: 98.5%;
        position: absolute;
    }
</style>