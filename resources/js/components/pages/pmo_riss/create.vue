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
      </div>
    </section>
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
                                <tr v-if="batches == null">
                                    <td colspan="7" class="text-center"><span>No Items Please Search</span></td>
                                </tr>
                                <tr v-else v-for="(batch, index) in batches" :key="batch.batch_no">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ batch.item_desc }}</td>
                                    <td>{{ batch.unit_desc }}</td>
                                    <td>{{ batch.batch_no }}</td>
                                    <td>{{ batch.expiration_date }}</td>
                                    <td>{{ batch.remaining_quantity }}</td>
                                    <td>
                                        <button v-show="batch.remaining_quantity > 0" class="btn btn btn-sm btn-primary" type="button" @click="add_batch(batch)">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="w-100 border-bottom border-dark"></div>
                    <form @submit.prevent="store_ris()">
                    <div class="card-body" v-show="selected_batches.length > 0">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Item Description</th>
                                    <th>Unit</th>
                                    <th>Batch</th>
                                    <th>Expiry</th>
                                    <th>Balance</th>
                                    <th width="20%">Request Bal.</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(batch, index) in selected_batches" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ batch.item_desc }}
                                        <div class="w-100"></div>
                                        <label for="" class="form-label" v-show="batch.brand_desc !== null">brand: </label> {{ batch.brand_desc }}
                                    </td>
                                    <td>{{ batch.unit_desc }}</td>
                                    <td>{{ batch.batch_no }}</td>
                                    <td>{{ batch.expiration_date }}</td>
                                    <td class="text-right">{{ batch.remaining_quantity }}</td>
                                    <td><input type="number" class="form-control form-control-sm text-right" v-model="batch.requested_quantity" required></td>
                                    <td>
                                        <button type="button" @click="remove_batch(index)" class="btn btn-sm btn-danger">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-auto">
                                Purpose
                            </div>
                            <div class="col-6">
                                <select class="form-control" v-model="purpose">
                                    <option v-for="p in purposes" :key="p.chrgcode" :value="p.chrgcode">
                                        {{ p.chrgdesc }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right" v-show="selected_batches.length > 0">
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
            purposes: [],
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
            purpose: '',
        }
    },
    methods: {
        ...mapActions([
            'getItems'
        ]),
        get_purpose(){
            axios.get('hcharge').then(({data}) => {
                this.purposes = data;
            }).catch(() => {

            });
        },
        search_batch(){
            axios.get('pmo_search_batch/'+this.search_word).then(({data}) => {
                this.batches = data;
            }).catch(() => {

            });
        },
        store_ris(){
            axios.post('pmo_ris', {
                batches: this.selected_batches,
                user_id: this.user.id,
                purpose: this.purpose,
            }).then(() => {
                this.$router.push({ name: 'pmo_riss'});
            }).catch(() => {

            });
        },
        add_batch(batch){
            this.message = null;
            var a = this.selected_batches;
            var index = a.findIndex( x => x.batch_no == batch.batch_no )
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
        this.get_purpose();
    },
    computed: {
        ...mapGetters([
            'items',
            'user',
        ]),
    },
}
</script>

<style>

</style>