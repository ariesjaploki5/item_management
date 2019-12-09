<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row ">
          <div class="col-sm-6">
            <h1>Batches</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'batches'}">Batches</router-link></li>
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
                        <div class="col-4 text-right">
                            <button class="btn btn-sm btn-primary" type="button" @click="create_batch()">
                                add
                            </button>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Batch No</th>
                                    <th>Iar No</th>
                                    <th>Item</th>
                                    <th>Brand</th>
                                    <th>Cost</th>
                                    <th>Total Quantity</th>
                                    <th>Remaining Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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
            category_id: null,
        }
    },
    methods: {
        ...mapActions([
            'getCategories',
            'getBatches',
        ]),
        create_batch(){
            this.$router.push({ name: 'batch_create' });
        }
    },
    created(){  
        this.getCategories();
        this.getBatches();
    },
    computed: { 
        ...mapGetters([
            'categories',
            'batches'
        ]),
    },
}
</script>

<style>

</style>