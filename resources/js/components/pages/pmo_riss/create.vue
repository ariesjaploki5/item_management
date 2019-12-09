<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Requisition Slips</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
              <li class="breadcrumb-item"><router-link :to="{ name: 'requisition_slips'}">Requisition Slips</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'requisition_slip_create'}">Create</router-link></li>
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

                    </div>
                    <div class="card-body">
                        <form @submit.prevent="search_batch()">
                            <div class="row mb-1">
                                <div class="col-6">
                                    <input type="text" class="form-control form-control-sm" v-model="search_word" required>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-sm btn-primary" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Item Description</th>
                                    <th>Unit</th>
                                    <th>Batch</th>
                                    <th>Expiry</th>
                                    <th>Balance</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(batch, index) in batches" :key="batch.batch_no">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ batch.item_desc }}</td>
                                    <td>{{ batch.unit_desc }}</td>
                                    <td>{{ batch.batch_no }}</td>
                                    <td>{{ batch.expiration_date }}</td>
                                    <td>{{ batch.remaining_quantity }}</td>
                                    <td>
                                        <button class="btn btn btn-sm btn-primary" type="button" @click="add_batch(batch)">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="w-100 border-bottom border-dark"></div>
                    <form @submit.prevent="store_ris()">
                    <div class="card-body">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Item Description</th>
                                    <th>Unit</th>
                                    <th>Batch</th>
                                    <th>Expiry</th>
                                    <th>Balance</th>
                                    <th>Request Bal.</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(batch, index) in selected_batches" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ batch.item_desc }}
                                        <div class="w-100"></div>
                                        <label for="" class="form-label">brand: </label> {{ batch.brand_desc }}
                                    </td>
                                    <td>{{ batch.unit_desc }}</td>
                                    <td>{{ batch.batch_no }}</td>
                                    <td>{{ batch.expiration_date }}</td>
                                    <td>{{ batch.remaining_quantity }}</td>
                                    <td><input type="number" class="form-control form-control-sm" v-model="batch.requested_quantity"></td>
                                    <td>
                                        <button type="button" @click="remove_batch(index)" class="btn btn-sm btn-danger">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-sm btn-success">Submit</button>
                    </div>
                    </form>
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
            pending_batches: [],
            selected_batches: [],
            search_word: null,
            batches: null,
            batch: {
                batch_no: '',
                item_desc: '',
                brand_desc: '',
                unit_desc: '',
                expiration_date: '',
                requested_quantity: '',
                remaining_quantity: '',
            },
            message: '',
        }
    },
    methods: {
        ...mapActions([
            'getItems'
        ]),
        search_batch(){
            axios.get('pmo_search_batch/'+this.search_word).then(({data}) => {
                this.batches = data;
            }).catch(() => {

            });
        },
        store_ris(){
            axios.post('pmo_ris', {
                batches: this.selected_batches,
                
            }).then(() => {
                this.$router.push({ name: 'requisition_slips'});
            }).catch(() => {

            });
        },

        add_batch(batch){
            this.message = null;
            var a = this.selected_batches;
            var index = a.findIndex( x => x.item_desc == batch.item_desc )
            if(index === -1){
                this.selected_batches.push({
                    batch_no: batch.batch_no,
                    item_desc: batch.item_desc,
                    brand_desc: batch.brand_desc,
                    unit_desc: batch.unit_desc,
                    expiration_date: batch.expiration_date,
                    requested_quantity: null,
                    remaining_quantity: batch.remaining_quantity,
                });
                this.batch = {
                    batch_no: '',
                    item_desc: '',
                    brand_desc: '',
                    unit_desc: '',
                    expiration_date: '',
                    requested_quantity: '',
                    remaining_quantity: '',
                };
            } else {
                this.message = "Item already exists";
            }

        },
        remove_batch(index){
            this.selected_batches.splice(index, 1);
            // this.pending_batches.splice(index, 1);
        },
    },
    created(){
        this.getItems();
    },
    computed: {
        ...mapGetters([
            'items'
        ]),
    },
}
</script>

<style>

</style>