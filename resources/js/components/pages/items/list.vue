<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row ">
          <div class="col-sm-6">
            <h4>Items</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'items'}">Items</router-link></li>
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
                        <div class="col-auto">
                          <label for="" class="form-label">Category</label>
                        </div>
                        <div class="col-4">
                          <select v-model="category_id" @change="select_category()" class="form-control form-control-sm">
                            <option v-for="c in categories" :key="c.category_id" :value="c.category_id">
                              <span>{{ c.category_desc }}</span>
                            </option>
                          </select>
                        </div>
                        <div class="col-4"></div>
                      </div>
                    </div>
                    <div class="card-body">
                      <table class="table table-sm table-hover">
                        <thead>
                          <tr>
                            <th width="6%">Item ID</th>
                            <th width="30%">Description</th>
                            <th class="text-center" width="6%">Homis Stock</th>
                            <th class="text-center" width="6%">MMO Stock</th>
                            <th witdh="6%">Batch No</th>
                            <th width="12%">Brand</th>
                            <th witdh="8%">Expiration Date</th>
                            <th witdh="6%">Cost</th>
                            <th class="text-center" width="8%">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="item in items" :key="item.item_id">
                            <td>{{ item.item_id }}</td>
                            <td>{{ item.item_desc }}</td>
                            <td class="text-right">{{ item.homis_stock }}</td>
                            <td class="text-right">{{ item.mmo_stock }}</td>
                            <td>
                              <div class="row mr-1 ml-1" v-for="batch in item.batches" :key="batch.batch_no">
                                {{ batch.batch_no }}
                              </div>
                            </td>
                            <td>
                              <div class="row mr-1 ml-1" v-for="batch in item.batches" :key="batch.batch_no">
                                {{ batch.brand_desc }}
                              </div>
                            </td>
                            <td>
                              <div class="row mr-1 ml-1" v-for="batch in item.batches" :key="batch.batch_no">
                                {{ batch.expiration_date }}
                              </div>
                            </td>
                            <td>
                              <div class="row mr-1 ml-1" v-for="batch in item.batches" :key="batch.batch_no">
                                {{ batch.cost }}
                              </div>
                            </td>
                            <td>
                            </td>
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
            category_id: '',
        }
    },
    methods: {
        ...mapActions([
            'getItems', 'getCategories', 'getItemsPerCategory'
        ]),
        select_category(){
          this.getItemsPerCategory(this.category_id);
        },
        get_all(){
            // this.getItems();
            this.getCategories();
        },
    },
    created(){
        this.get_all();
    },
    computed: {
        ...mapState([
          'items',
        ]),
        ...mapGetters([
            'categories',
        ]),
    },
}
</script>

<style>

</style>