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
              <li class="breadcrumb-item"><router-link :to="{ name: 'requisition_slips'}">Requisition Slips</router-link></li>
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
                            <div class="col-6">

                            </div>
                            <div class="col-6 text-right">
                                <button class="btn btn-sm btn-primary" type="button" @click="print_ofs_ris()">
                                    print
                                </button>
                            </div>
                        </div>
                    </div>
                    <form @submit.prevent="update_ofs_ris()">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group row">
                                    <div class="col-sm-3 text-left">
                                        <label for="" class="form-label">
                                            Division:
                                        </label>
                                    </div>  
                                    <div class="col-sm-auto text-left">
                                        {{ ris.division_desc }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3 text-left">
                                        <label for="" class="form-label">
                                            Department:
                                        </label>
                                    </div>  
                                    <div class="col-sm-auto text-left">
                                        {{ ris.department_desc }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <div class="col-2">
                                        <label for="" class="form-label">RIS No.:</label>
                                    </div>
                                    <div class="col-auto">
                                        <span v-show="!editmode">{{ ris.ris_no }}</span>
                                        <span v-show="editmode">
                                            <input type="text" class="form-control form-control-sm" v-model="ris.ris_no" required>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-2">
                                        <label for="" class="form-label">RIS Date:</label>
                                    </div>
                                    <div class="col-auto">
                                        <span>{{ ris.ris_date }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <table class="table table-sm table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="50%">Item Description</th>
                                    <th width="15%">Unit</th>
                                    <th width="15%">Requested Quantity</th>
                                    <th width="15%">Issued Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in ris.items" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.item_desc }}</td>
                                    <td>{{ item.unit_desc }}</td>
                                    <td>{{ item.requested_quantity }}</td>
                                    <td>
                                        <span v-show="!editmode">{{ item.issued_quantity }}</span>
                                        <span v-show="editmode"><input type="number" class="form-control form-control-sm text-right" v-model="item.issued_quantity" required></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-right" v-show="user.role_id == 3">
                        <button v-show="editmode" type="button" class="btn btn-sm btn-warning" @click="cancel_ofs_ris()">Cancel</button>
                        <button v-show="!editmode" type="button" class="btn btn-sm btn-success" @click="edit_ofs_ris()">Edit</button>
                        <button v-show="editmode" type="submit" class="btn btn-sm btn-success">Save</button>
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
                items: []
            },
            message_box: '',
        }
    },
    methods: {

        get_ris(){
            axios.get('ris/'+this.$route.params.id).then(({data}) => {
                this.ris = data;
            }).catch(() => {

            });
        },
        edit_ofs_ris(){
            this.editmode = true;
        },
        cancel_ofs_ris(){
            this.editmode = false;
        },
        update_ofs_ris(){
            axios.put('update_ofs_ris/'+this.ris.control_no,{
                ris_no: this.ris.ris_no,
                items: this.ris.items,
            }).then(() => {
                this.$router.push({ name: 'requisition_slips' });
                this.editmode = false;
            }).catch(() => {

            });
        },
        print_ofs_ris(){
            this.$router.push({ name: 'requisition_slip_print', params: { id: this.$route.params.id } });
        },
        receive_ris(id){
            axios.put('receive/'+id).then(() => {
                this.$router.push({ name: 'requisition_slip_show' });
            }).catch(() => {

            });
        },
    },
    created(){
        this.get_ris();
    },
    computed:{
        ...mapState([
            'user'
        ]),
    },
}
</script>

<style>

</style>