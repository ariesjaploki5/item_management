<template>
<div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Purchase Request</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
              <li class="breadcrumb-item"><router-link :to="{ name: 'purchase_requests'}">Purchase Requests</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'purchase_request_create'}">Create</router-link></li>
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
                            <div class="col-2">
                                <label for="" class="form-label">
                                    Category:
                                </label>
                            </div>
                            <div class="col-4">
                                <select class="form-control form-control-sm" @change="get_items()" v-model="pr.category_id">
                                    <option  v-for="category in categories" :key="category.category_id" :value="category.category_id">{{ category.category_desc }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="w-100 mt-2">
                            
                        </div>
                        <form @submit.prevent="check_item_if_exists()">
                            <div class="row">
                                <div class="col-2">
                                    <label for="" class="form-label">
                                        Item:
                                    </label>
                                </div>
                                <div class="col-6">
                                    <input type="text" v-model="item.item_desc" list="items" class="form-control form-control-sm" :disabled="items.length == 0" required>
                                    <datalist id="items">
                                        <option v-for="item in items" :key="item.item_id">{{item.item_desc}}</option>
                                    </datalist>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-sm btn-primary"  :disabled="items.length == 0">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <div class="col-12 text-center">
                                    <span class="text-danger" v-show="message">{{ message }}</span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <form @submit.prevent="store_pr()" v-show="pr.items.length">
                        <div class="card-body">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th width="3%">#</th>
                                        <th width="40%">Item</th>
                                        <th class="text-center" width="15%">Unit of Meassure</th>
                                        <th class="text-center" width="12%">Unit Cost</th>
                                        <th class="text-center" width="12%">Quantity</th>
                                        <th class="text-center" width="12%">Total Cost</th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in pr.items" :key="index" :class="{ 'table-warning': item.item_id === null}">
                                        <td class="text-right">{{ index + 1 }}</td>
                                        <td class="text-left">
                                            <div>{{ item.item_desc }}</div>
                                            <div class="text-center"><small v-show="item.item_id === null">new item</small></div>
                                        </td>
                                        <td class="text-center">
                                            <span v-if="item.item_id !== null">{{ item.unit_desc }}</span>
                                            <span v-else><input type="text" class="form-control form-control-sm text-center" v-model="item.unit_desc" required></span>
                                        </td>
                                        <td class="">
                                            <input type="float" class="form-control form-control-sm text-right" v-model="item.cost" required>
                                        </td>
                                        <td class="">
                                            <input type="number" class="form-control form-control-sm text-right" v-model="item.quantity" required>
                                        </td>
                                        <td class="text-right">
                                            <span v-show="item.cost > 0 && item.quantity > 0">{{ item.cost * item.quantity }}</span>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" @click="remove_item(index)" class="btn btn-sm btn-danger">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row mt-2">
                                <div class="col-auto">Purpose: </div>
                                <div class="col-8">
                                    <textarea v-model="pr.purpose" rows="4" class="form-control form-control-sm" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary btn-sm" type="submit">Submit</button>
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

import{ mapActions, mapGetters } from 'vuex'
export default {

    data(){
        return{
            pr: {
                category_id: '',
                purpose: '',
                items: [],
            },
            item: {
                item_desc: '',
                unit_desc: '',
            },
            message: '',
            unit_desc: '',
            new_item: 0,
            pr_id: '',

        }
    },
    methods: {
        ...mapActions([
            'getCategories',
            'getItemsPerCategory'
        ]),
        get_items(){
            this.getItemsPerCategory(this.pr.category_id);
        },
        check_item_if_exists(){
            axios.post('check_item_if_exists', {
                item_desc: this.item.item_desc,
            }).then(({data}) => {
                this.item.item_desc = data.item_desc;
                this.item.item_id = data.item_id;
                this.item.unit_desc = data.unit_desc;

                this.add_item();
            }).catch(() => {

            });
        },
        add_item(){
            this.message = null;
            var a = this.pr.items
            var index = a.findIndex( x => x.item_desc == this.item.item_desc )
            if(index === -1){
                this.pr.items.push(this.item);
                this.item = {
                    item_id: '',
                    item_desc: '',
                    unit_desc: '',

                };
            } else {
                this.message = "Item already exists";
            }
        },
        remove_item(index){
            this.pr.items.splice(index, 1);
        },
        store_pr(){
            axios.post('purchase_request', {
                category_id: this.pr.category_id,
                purpose: this.pr.purpose,
                items: this.pr.items,
            }).then(() => {
                this.$router.push({ name: 'purchase_requests' });
            });
        },
        search_items(){
            
        },
    },
    created(){
        this.getCategories();
    },
    computed:{
        ...mapGetters([
            'categories',
            'items',
        ]),
    },
}
</script>

<style>

</style>