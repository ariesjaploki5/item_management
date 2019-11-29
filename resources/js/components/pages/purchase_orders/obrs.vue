<template>
<div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>PO No.: {{ $route.params.id }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
                <li class="breadcrumb-item"><router-link :to="{ name: 'purchase_orders'}">Purchase Order</router-link></li>
                <li class="breadcrumb-item"><router-link :to="{ name: 'purchase_order_show', params: { id: $route.params.id }}">{{ $route.params.id }}</router-link></li>
                <li class="breadcrumb-item active"><router-link :to="{ name: 'purchase_order_obrs', params: { id: $route.params.id }}">Serial</router-link></li>
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
                    <form @submit.prevent="store_obrs()">
                      <div class="card-body">
                          <div class="row">
                              <div class="col-7">
                                  <div class="form-group row">
                                      <div class="col-4">
                                          <label for="" class="form-label">
                                              Type of Obligation:
                                          </label>
                                      </div>
                                      <div class="col">
                                          <select class="form-control form-control-sm" v-model="obrs.type_of_obligation">
                                              <option value=""></option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <div class="col-4">
                                          <label for="" class="form-label">
                                              Allotment Class
                                          </label>
                                      </div>
                                      <div class="col">
                                          <select class="form-control form-control-sm" v-model="obrs.type_of_obligation">
                                              <option value=""></option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <div class="col-4">
                                          <label for="" class="form-label">
                                              Funding Source
                                          </label>
                                      </div>
                                      <div class="col">
                                          <select class="form-control form-control-sm" v-model="obrs.type_of_obligation">
                                              <option value=""></option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <div class="col-4">
                                          <label for="" class="form-label">
                                              Type of Appropriation
                                          </label>
                                      </div>
                                      <div class="col">
                                          <select class="form-control form-control-sm" v-model="obrs.type_of_obligation">
                                              <option value=""></option>
                                          </select>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-5">
                                  <div class="row">
                                      <div class="col-6">UACS Object Code/Expenditure</div>
                                      <div class="col-6">Total Amount:</div>
                                  </div>
                                  <div class="row">
                                      <div class="col-8">
                                          <select class="form-control form-control-sm">
                                              <option value=""></option>
                                          </select>
                                      </div>
                                      <div class="col-4">
                                          <input type="number" class="form-control form-control-sm">
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                        <div class="row">
                          <div class="col-12 text-right">
                            <button class="btn btn-success" type="submit">Submit</button>
                          </div>
                        </div>
                      </div>
                    </form>
                    <!-- /.card-footer-->
                </div>
              </div>
          </div>
      </div>

    </section>
</div>
    
</template>

<script>
import{ mapActions, mapGetters, mapState } from 'vuex'
export default {
    data(){
        return{
          obrs: {
              allotment_id: null,
              type_of_obligation: null,
              fund_source: null,
              type_of_appropriation: null,
          },
        }
    },
    methods: {
        ...mapActions([

        ]),
        store_obrs(){

        }
    },  
    created(){

    },
    computed:{
      ...mapGetters([

      ]),

    },

}
</script>

<style>

</style>