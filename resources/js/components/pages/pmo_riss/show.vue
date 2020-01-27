<template>
<div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Control No.: {{ $route.params.id }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
              <li class="breadcrumb-item"><router-link :to="{ name: 'pmo_riss'}">Requisition Slips</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'pmo_ris_show', params: { id: $route.params.id }}">{{ $route.params.id }}</router-link></li>
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
                            <div class="col"></div>
                            <div class="col-1">
                                <button type="button" @click="print()" class="btn btn-sm btn-primary">print</button>
                            </div>
                        </div>
                    </div>
                    <form @submit.prevent="save_ris()">
                    <div class="card-body">

                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <tr>
                                    <th>#</th>
                                    <th>Item Description</th>
                                    <th>Unit</th>
                                    <th>Batch</th>
                                    <th>Expiry</th>
                                    <th width="10%">Balance</th>
                                    <th width="10%">Request Bal.</th>
                                    <th width="10%">Issued Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(batch, index) in ris.items" :key="index" :class="{ 'table-danger' : batch.item_id == null}">
                                    <td>{{ index + 1}}</td>
                                    <td>{{ batch.item_desc }}</td>
                                    <td>{{ batch.item_unit }}</td>
                                    <td>{{ batch.batch_no }}</td>
                                    <td>{{ batch.expiration_date }}</td>
                                    <td class="text-right">{{ batch.balance }}</td>
                                    <td class="text-right">{{ batch.requested_quantity }}</td>
                                    <td class="text-right">
                                        <span v-show="!editmode">
                                            {{ batch.issued_quantity }}
                                        </span>
                                        <span v-show="editmode">
                                            <input type="text" class="form-control form-control-sm" v-model="batch.issued_quantity" required>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-right">
                        <button type="button" v-show="!editmode && user.role_id == 2" class="btn btn-sm btn-success" @click="edit_ris()">Edit or Issue Quantity</button>
                        <button type="button" v-show="editmode && user.role_id == 2" class="btn btn-sm btn-warning" @click="cancel_edit()">Cancel</button>
                        <button type="submit" v-show="editmode && user.role_id == 2" class="btn btn-sm btn-success">Save or Update</button>
                        <button type="button" v-show="user.role_id == 3 && ris.issued_date !== null && ris.received_date == null" class="btn btn-sm btn-success" @click="receive()">Receive</button>
                    </div>
                    </form>
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
            editmode: false,
            ris: {
                batches: []
            },
            message_box: '',
        }
    },
    methods: {  
        ...mapActions([
            'retrieveUser'
        ]),
        get_ris(){
            axios.get('pmo_ris/'+this.$route.params.id).then(({data}) => {
                this.ris = data;
            }).catch(() => {

            });
        },

        receive(){
            axios.put('pmo_ris_receive/'+this.$route.params.id, {
                batches: this.ris.items,
            }).then(({data}) => {
                console.log(data);
                this.get_ris();
            }).catch(() => {

            });
        },
        cancel_edit(){
            this.editmode = false;
        },
        edit_ris(){
            this.editmode = true;
        },
        save_ris(){
            this.editmode = false;
            axios.put('pmo_ris_issue/'+this.$route.params.id,{
                batches: this.ris.items,
            }).then(() => {
                this.editmode = false;
                this.get_ris();
                // this.$router.push({ name: 'pmo_ris_show' });
            }).catch(() => {

            });
        },
        print(){
            this.$router.push({ name: 'pmo_ris_print', params: { id: this.$route.params.id } });
        },
    },
    created(){
        this.get_ris();
        this.retrieveUser();
    },
    computed:{
        ...mapGetters([
            'user'
        ]),
    },
}
</script>

<style scoped>
    table tbody tr td{
        height: 20px !important;
    }
</style>