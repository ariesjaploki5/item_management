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
                            <div class="form-group row">
                                <div class="col-2">
                                    <label for="" class="form-label">
                                        Category:
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <select class="form-control form-control-sm" v-model="category_id" @change="check_category()">
                                        <option v-for="c in categories" :key="c.category_id" :value="c.category_id">{{ c.category_desc }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-2">
                                    <label for="" class="form-label">
                                        Search:
                                    </label>
                                </div>
                                <div class="col-6">
                                    <input class="form-control form-control-sm" type="text" v-model="search_word" required :disabled="category_id == null">
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-sm btn-primary" type="submit" :disabled="category_id == null">Search</button>
                                </div>
                            </div>
                        </form>
                        <!-- <table class="table table-sm table-hover">
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
                            <tbody style="height: ;">
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
                                        <button class="btn btn btn-sm btn-primary" type="button" @click="add_batch(batch)">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table> -->
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Item Description</th>
                                    <th>Unit</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody style="height: ;">
                                <tr v-for="(item, index) in items" :key="item.item_id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.item_desc }}</td>
                                    <td>{{ item.unit_desc }}</td>
                                    <td>
                                        <button class="btn btn btn-sm btn-primary" type="button" @click="add_batch(item)">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="w-100 border-bottom border-dark"></div>
                    <!-- <form @submit.prevent="store_ris()">
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
                                        <td><input type="number" class="form-control form-control-sm text-right" v-model="batch.requested_quantity"></td>
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
                    </form> -->
                    <form @submit.prevent="store_ofs_ris()">
                        <div class="card-body" v-show="selected_batches.length > 0">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Item Description</th>
                                        <th>Unit</th>
                                        <th width="20%">Request Bal.</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(batch, index) in selected_batches" :key="index">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ batch.item_desc }}
                                            <div class="w-100"></div>
                                        </td>
                                        <td>{{ batch.unit_desc }}</td>
                                        <td><input type="number" class="form-control form-control-sm text-right" v-model="batch.requested_quantity"></td>
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
            category_id: null,
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
            'getItems',
            'getCategories',
        ]),
        check_category(){
            if(this.category_id === 5){
                this.get_office_supplies();
            }
        },
        get_office_supplies(){
            axios.get('office_supplies').then(({data}) => {
                this.items = data;
            }).catch(() => {

            });
        },
        get_medical_supplies(){
            axios.get('medical_supplies').then(({data}) => {
                this.items = data;
            }).catch(()=> {

            });
        },
        get_other_supplies(){
            axios.get('other_supplies').then(() => {

            }).catch(() => {

            });
        }
        // search_batch(){
        //     axios.get('search_batch/'+this.search_word).then(({data}) => {
        //         this.batches = data;
        //     }).catch(() => {

        //     });
        // },
        // store_ris(){
        //     axios.post('ris', {
        //         batches: this.selected_batches,
                
        //     }).then(() => {
        //         this.$router.push({ name: 'pmo_riss'});
        //     }).catch(() => {

        //     });
        // },
        // add_batch(batch){
        //     this.message = null;
        //     var a = this.selected_batches;
        //     var index = a.findIndex( x => x.batch_no == batch.batch_no )
        //     if(index === -1){
        //         this.selected_batches.push({
        //             batch_no: batch.batch_no,
        //             item_desc: batch.item_desc,
        //             brand_desc: batch.brand_desc,
        //             unit_desc: batch.unit_desc,
        //             expiration_date: batch.expiration_date,
        //             requested_quantity: null,
        //             remaining_quantity: batch.remaining_quantity,
        //         });
        //         this.batch = {
        //             batch_no: '',
        //             item_desc: '',
        //             brand_desc: '',
        //             unit_desc: '',
        //             expiration_date: '',
        //             requested_quantity: '',
        //             remaining_quantity: '',
        //         };
        //     } else {
        //         this.message = "Item already exists";
        //     }

        // },
        // remove_batch(index){
        //     this.selected_batches.splice(index, 1);
        //     // this.pending_batches.splice(index, 1);
        // },
    },
    created(){
        this.getItems();
        this.getCategories();
    },
    computed: {
        ...mapGetters([
            'items',
            'categories',
        ]),
    },
}
</script>

<style>

</style>