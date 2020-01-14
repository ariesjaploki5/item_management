<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Requisition Slips</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'requisition_slips'}">Requisition Slips</router-link></li>
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
                            <div class="col-8">
                                <div class="card-tools">
                                    <form @submit.prevent="search_ris()">
                                        <div class="form-group row">
                                            <div class="col-auto">
                                                <label for="" class="form-label">
                                                    Category:
                                                </label>
                                            </div>
                                            <div class="col-4">
                                                <select class="form-control form-control-sm" v-model="category_id" @change="get_riss()">
                                                    <option v-for="c in categories" :value="c.category_id" :key="c.category_id">
                                                        {{ c.category_desc }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-auto">
                                                <label for="" class="form-label">
                                                    Control No:
                                                </label>
                                            </div>
                                            <input :disabled="category_id === null" type="text" class="form-control form-control-sm col-4 ml-1" v-model="search_word" required>
                                            <!-- <button class="btn btn-sm btn-primary" type="submit">search</button> -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-4 text-right">
                                <div class="card-tools">
                                    <button class="btn btn-sm btn-primary" type="button" @click="create_ris()">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Control No.:</th>
                                    <th>Category</th>
                                    <th>Department</th>
                                    <th>Requested By</th>
                                    <th>Requested Date</th>
                                    <th>Issued By</th>
                                    <th>Issued Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="ris in filteredRiss" :key="ris.control_no" @click="view_ris(ris.control_no)">
                                    <td>{{ ris.control_no }}</td>
                                    <td>{{ ris.category_desc }}</td>
                                    <td>{{ ris.department_desc }}</td>
                                    <td>{{ ris.requested_by_user }}</td>
                                    <td>{{ ris.ris_date }}</td>
                                    <td>{{ ris.issued_by_user }}</td>
                                    <td>{{ ris.issued_date }}</td>
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


import{ mapActions, mapGetters, mapMutations } from 'vuex'
export default {

    data(){
        return{
            search_word: '',
            headers: [],
            riss: [],
            category_id: null,
        }
    },
    methods: {
        ...mapActions([
            'getCategories'
        ]),
        view_ris(id){
            this.$router.push({ name: 'requisition_slip_show', params: { id: id } });
        },

        create_ris(){
            this.$router.push({ name: 'requisition_slip_create' });
        },
        get_riss(){
            axios.get('riss_by_category/'+this.category_id).then(({data}) => {
                this.riss = data;
            }).catch(() => {

            })
        }

    },
    created(){
        this.getCategories();
    },
    computed: {
        ...mapGetters([
            'categories'
        ]),
        filteredRiss(){
            let matcher = new RegExp(this.search_word, 'i')
            return this.riss.filter(function(ris){
                return matcher.test(ris.control_no)
            });
        },
    },
}
</script>

<style>

</style>