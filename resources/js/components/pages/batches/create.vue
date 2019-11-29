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
              <li class="breadcrumb-item"><router-link :to="{ name: 'batches'}">Batches</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'batches'}">Create</router-link></li>
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
            'getCategories'
        ]),
    },
    created(){  
        this.getCategories();
    },
    computed: { 
        ...mapGetters([
            'categories'
        ]),
    },
}
</script>

<style>

</style>