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
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-auto">
                                <label for="" class="form-label">
                                    Category:
                                </label>
                            </div>
                            <div class="col-4">
                                <select class="form-control form-control-sm" v-model="category_id">
                                    <option v-for="c in categories" :key="c.category_id" :value="c.category_id">{{ c.category_desc }}</option>
                                </select>
                            </div>
                        </div>
                        <div v-show="category_id == 1">
                            <drugs_and_medicines></drugs_and_medicines>
                        </div>
                        <div v-show="category_id == 2">
                            <medical_supplies></medical_supplies>
                        </div>
                        <div v-show="category_id == 4">
                            <office_supplies></office_supplies>
                        </div>
                        <div v-show="category_id == 5">
                            <office_supplies></office_supplies>
                        </div>
                        <div v-show="category_id == 6">
                            <office_supplies></office_supplies>
                        </div>
                    </div>
                </div>
              </div>
          </div>
      </div>
    </section>
</div>
</template>

<script>
import drugs_and_medicines from './drugs_and_medicines.vue';
import medical_supplies from './medical_supplies.vue';
import office_supplies from './office_supplies.vue';
import other_supplies from './other_supplies.vue';

import{ mapActions, mapGetters, mapMutations, mapState } from 'vuex'
export default {
    components: {
      drugs_and_medicines,
      medical_supplies,
      office_supplies,
      other_supplies,
    },
    data(){
        return{
            category_id: '',
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
            'categories',
        ]),
    },
}
</script>

<style>

</style>