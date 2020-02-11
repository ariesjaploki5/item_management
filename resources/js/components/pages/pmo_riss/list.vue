<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Lists of Generated Requisition and Issue Slip</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'pmo_riss'}">Requisition Slips</router-link></li>
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
                                    <form @submit.prevent="search_ris()">
                                        <div class="form-group row">
                                            <input type="text" class="form-control form-control-sm col-6 mr-2" v-model="search_word" required>
                                            <button class="btn btn-sm btn-primary" type="submit">search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-4 text-right">
                                <div class="card-tools">
                                    <button class="btn btn-sm btn-primary" type="button" @click="create_ris()">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Control No.:</th>
                                    <th>Requested By</th>
                                    <th>Requested Date</th>
                                    <th>Issued By</th>
                                    <th>Issued Date</th>
                                    <th>Received By</th>
                                    <th>Received Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="ris in pmo_riss" :key="ris.control_no" @click="view_ris(ris.control_no)">
                                    <td>{{ ris.control_no }}</td>
                                    <td>{{ ris.requested_name }}</td>
                                    <td>{{ ris.ris_date }}</td>
                                    <td>{{ ris.issued_name }}</td>
                                    <td>{{ ris.issued_date }}</td>
                                    <td>{{ ris.received_name }}</td>
                                    <td>{{ ris.received_date }}</td>
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
            headers: [],
            pmo_riss: [],
        }
    },
    methods: {
        view_ris(id){
            this.$router.push({ name: 'pmo_ris_show', params: { id: id } });
        },
        print_ris(id){
            this.$router.push({ name: 'pmo_ris_print', params: { id: id } });
        },
        receive_ris(id){
            axios.put('receive/'+id).then(() => {
                this.$router.push({ name: 'pmo_ris_show', params: { id: id } });
            }).catch(() => {

            });
        },
        create_ris(){
            this.$router.push({ name: 'pmo_ris_create' });
        },
        get_pmo_riss(){
            axios.get('pmo_ris').then(({data}) => {
                this.pmo_riss = data;
            })
        },
    },
    created(){
        this.get_pmo_riss();
    },
    computed: {

    },
}
</script>
<style>

</style>