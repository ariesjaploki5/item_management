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
                    <!-- <div class="card-header">
                        
                    </div> -->
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
                        <div v-show="category_id == 3">
                            <laboratory_supplies></laboratory_supplies>
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
import { mapActions, mapGetters, mapMutations } from 'vuex'

import office_supplies from '../ris/office_supplies.vue';
import dental_supplies from '../ris/dental_supplies.vue';
import drugs_and_medicines from '../ris/drugs_and_medicines.vue';
import medical_supplies from '../ris/medical_supplies.vue';
import other_supplies from '../ris/other_supplies.vue';

export default {
    components:{
        office_supplies,
        dental_supplies,
        drugs_and_medicines,
        medical_supplies,
        other_supplies
    },
    data(){
        return{
            category_id: null,

        }
    },
    methods: {
        ...mapActions([
            'getCategories',
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