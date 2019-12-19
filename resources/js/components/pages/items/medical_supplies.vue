<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row ">
          <div class="col-sm-6">
            <h4>Medical Supplies</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
              <li class="breadcrumb-item"><router-link :to="{ name: 'items'}">Items</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'item_md' }">Medical Supplies</router-link></li>
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
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th width="15%">Stock No</th>
                                    <th width="45%">Description</th>
                                    <th width="15%">Brand</th>
                                    <th width="15%">Stock</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in items" :key="item.item_id" @click="view_item(item)">
                                    <td>{{ item.sl_code }}</td>
                                    <td>{{ item.item_desc }}</td>
                                    <td>{{ item.brand_desc }}</td>
                                    <td>{{ item.stock }}</td>
                                    <td>
                                        <div class="btn-group dropleft">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                                <button class="dropdown-item" type="button" @click="view_item(item.sl_code)">View</button>
                                                <button class="dropdown-item" type="button" @click="edit_stock(item.sl_code)">Edit</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
          </div>
      </div>

    </section>
    <section>
      
    </section>
</div>
</template>

<script>


import{ mapActions, mapGetters, mapMutations, mapState } from 'vuex'
export default {

    data(){
        return{
            items: [],
            item: {}
        }
    },
    methods: {
        get_medical_supplies(){
            axios.get('medical_supplies').then(() => {

            }).catch(() => {

            });
        }

    },
    created(){
        this.get_medical_supplies();
    },
    computed: {

    },
}
</script>

<style>

</style>