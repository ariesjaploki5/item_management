<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
              <h1>IARS</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'pmo_iars'}">IARS</router-link></li>
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
                            <div class="col-8">
                                <div class="card-tools">
                                    <form @submit.prevent="search_iar()">
                                        <div class="form-group row">
                                            <input type="text" class="form-control form-control-sm col-6 mr-2" v-model="search_word" required>
                                            <button class="btn btn-sm btn-primary" type="submit">search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- <div class="col-4 text-right">
                                <div class="card-tools">
                                    <button class="btn btn-sm btn-primary" type="button" @click="create_iar()">Create</button>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>IAR No.:</th>
                                    <th>IAR Date</th>
                                    <th>PO No.:</th>
                                    <th>Ref No.:</th>
                                    <th>Ref Date</th>
                                    <th>Inspection Officer</th>
                                    <th>Inspection Date</th>
                                    <th>Receiving Officer</th>
                                    <th>Received Date</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="iar in pmo_iars" :key="iar.iar_no" @click="view_iar(iar.iar_no)">
                                    <td>{{ iar.iar_no }}</td>
                                    <td>{{ iar.iar_date }}</td>
                                    <td>{{ iar.po_no }}</td>
                                    <td>{{ iar.ref_no }}</td>
                                    <td>{{ iar.ref_date }}</td>
                                    <td>{{ iar.inspection_officer_name }}</td>
                                    <td>{{ iar.inspection_date }}</td>
                                    <td>{{ iar.receiving_officer_name }}</td>
                                    <td>{{ iar.received_date }}</td>
                                    
                                    <!-- <td>
                                        <div class="btn-group dropleft">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                               <button class="dropdown-item" type="button" @click="view_iar(iar.iar_no)">View</button>
                                               <button class="dropdown-item" type="button" @click="print_iar(iar.iar_no)">Print</button>
                                            </div>
                                        </div>
                                    </td> -->
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
            pmo_iars: [],
        }
    },
    methods: {

        view_iar(id){
            this.$router.push({ name: 'pmo_iar_show', params: { id: id } });
        },
        print_iar(id){
            this.$router.push({ name: 'pmo_iar_print', params:{ id: id } });
        },
        receive_iar(id){
            axios.put('receive/'+id).then(() => {
                this.$router.push({ name: 'pmo_iar_show', params: { id: id } });
            }).catch(() => {

            });
        },
        get_pmo_iars(){
            axios.get('pmo_iar').then(({data}) => {
                this.pmo_iars = data;
            })
        }

    },
    created(){
        this.get_pmo_iars();
    },
    computed: {

    },
}
</script>

<style>

</style>