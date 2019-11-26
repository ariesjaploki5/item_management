<template>
<div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create PO</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
              <li class="breadcrumb-item"><router-link :to="{ name: 'purchase_orders'}">Purchase Order</router-link></li>
              <li class="breadcrumb-item active"><router-link :to="{ name: 'purchase_order_create'}">Create</router-link></li>
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
                            <label for="" class="form-label">PR No.:</label>
                          </div>
                          <div class="col-3">
                            <input type="text" class="form-control form-control-sm" v-model="po.pr_no" required>
                          </div>
                          <div class="col-auto">
                            <button class="btn btn-sm btn-primary" type="button" @click="check_pr_if_exists()">
                              select
                            </button>
                          </div>
                        </div>
                      <div class="row">
                        <div class="col-auto">
                          <label for="" class="form-label">Supplier Name</label>
                        </div>
                        <div class="col-5">
                          <input @blur="check_supplier_if_exists()" type="text" v-model="supplier.supplier_name" list="suppliers" class="form-control form-control-sm" :disabled="suppliers.length == 0" required>
                            <datalist id="suppliers">
                                <option v-for="supplier in suppliers" :key="supplier.supplier_id">{{supplier.supplier_name}}</option>
                            </datalist>
                        </div>
                        <div class="col-auto" >
                          <label for="" class="form-label">Supplier Address</label>
                        </div>
                        <div class="col-4" >
                          <input type="text" class="form-control form-control-sm" v-model="supplier.supplier_address" required>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-auto">
                          <label for="" class="form-label">Mode of Procurement</label>
                        </div>
                        <div class="col-3">
                          <select v-model="po.mode_id" class="form-control form-control-sm" required>
                            <option v-for="m in modes" :key="m.mode_id" :value="m.mode_id">
                              <span>{{ m.mode_desc }}</span>
                            </option>
                          </select>
                        </div>
                      </div>
                      <div class="orw">
                        <div class="col-auto">
                          <label for="" class="form-label">Delivery Term</label>
                        </div>
                        <div class="col-3">
                          <select name="" id="">
                            <option value=""></option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <form @submit.prevent="store_po()">
                      <div class="card-body">
                        
                        <!-- <div class="row">
                          <div class="col-2">
                            <label for="" class="form-label"></label>
                          </div>
                        </div> -->
                        <table class="table table-sm table-hover table-bordered">
                          <thead>
                            <tr>
                              <th width="50%">ITEM</th>
                              <th class="text-center">Cost</th>
                              <th class="text-center">Quantity</th>
                              <th class="text-center">Estimated Cost</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="(item, index) in po.items" :key="index">
                              <td>
                                <div class="row">
                                  <div class="col-12">
                                    <div class="po_item">
                                      {{ item.item_desc }}
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-3">
                                    <label for="" class="form-label">Brand: 
                                    </label>
                                  </div>
                                  <div class="col">
                                    <input type="text" class="form-control form-control-sm" list="brands" v-model="item.brand_desc">
                                    <datalist id="brands">
                                        <option v-for="brand in brands" :key="brand.brand_id">{{brand.brand_desc}}</option>
                                    </datalist>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-3">
                                    <label for="" class="form-label">Packaging: 
                                    </label>
                                  </div>
                                  <div class="col">
                                    <input type="text" class="form-control form-control-sm" list="packagings" v-model="item.packaging_desc">
                                    <datalist id="packagings">
                                        <option v-for="packaging in packagings" :key="packaging.packaging_id">{{packaging.packaging_desc}}</option>
                                    </datalist>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-3">
                                    <label for="" class="form-label">Manufacturer: 
                                    </label>
                                  </div>
                                  <div class="col">
                                    <input type="text" class="form-control form-control-sm" list="manufacturers" v-model="item.manufacturer_desc">
                                    <datalist id="manufacturers">
                                        <option v-for="manufacturer in manufacturers" :key="manufacturer.manufacturer_id">{{manufacturer.manufacturer_desc}}</option>
                                    </datalist>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-3">
                                    <label for="" class="form-label">Country of Origin: 
                                    </label>
                                  </div>
                                  <div class="col">
                                    <input type="text" class="form-control form-control-sm" list="countries" v-model="item.country_desc">
                                    <datalist id="countries">
                                        <option v-for="country in countries" :key="country.country_id">{{country.country_desc}}</option>
                                    </datalist>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-3">
                                    <label for="" class="form-label">Offer:</label>
                                  </div>
                                  <div class="col">
                                    <input type="text" class="form-control form-control-sm" v-model="item.offer">
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-3">
                                    <label for="" class="form-label">Additional details:</label>
                                  </div>
                                  <div class="col">
                                    <textarea rows="1" class="form-control form-control-sm" v-model="item.other_details"></textarea>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <input type="float" class="form-control form-control-sm text-right" v-model="item.cost">
                              </td>
                              <td>
                                <input type="float" class="form-control form-control-sm text-right" v-model="item.quantity">
                              </td>
                              <td class="text-right">
                                <span>₱ {{ item.cost * item.quantity | round_off }}</span>
                              </td>
                              <td>
                                <button type="button" @click="remove_item(index)" class="btn btn-sm btn-danger">
                                    <i class="fas fa-times"></i>
                                </button>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                          
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                        <div class="row">
                          <div class="col-12 text-rigth">
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
          po: {
            pr_no: '',
            category_id: '',
            items: [],
          },
          supplier: {
            supplier_id: null,
            supplier_name: null,
            supplier_address: null,
          },
          
        }
    },
    methods: {
        ...mapActions([
            'getSuppliers',
            'getManufacturers',
            'getBrands',
            'getCountries',
            'getPackagings',
            'getModes',
        ]),
        check_pr_if_exists(){
          axios.get('purchase_request/'+this.po.pr_no).then(({data}) => {
              if(data.pr_no === null){
                
              }
              this.$router.params.id = data.pr_no;
              this.po = data;
          }).catch(() => {

          });
        },
        get_pr(){
          axios.get('purchase_request/'+this.$route.params.id).then(({data}) => {
            this.po = data;
          }).catch(() => {

          });
        },
        check_supplier_if_exists(){
          axios.post('check_supplier_if_exists', {
            supplier_name: this.supplier.supplier_name,
          }).then(({data}) => {
            this.supplier = data;
          }).catch(() => {
            
          });
        },
        store_po(){
          axios.post('purchase_order', {
            items: this.po.items,
            category_id: this.po.category_id,
            pr_no: this.po.pr_no,
            supplier_id: this.supplier.supplier_id,
            supplier_name: this.supplier.supplier_name,
            supplier_address: this.supplier.supplier_address,
          }).then((data) => {
            this.$router.push({ name: 'purchase_order_show', params: { id: data } });
          });
        },
        remove_item(index){
            this.po.items.splice(index, 1);
        },
    },  
    created(){
      this.getSuppliers();
      this.getManufacturers();
      this.getBrands();
      this.getCountries();
      this.getPackagings();
      this.getModes();
      this.get_pr();
    },
    computed:{
      ...mapGetters([
        'suppliers',
        'brands',
        'packagings',
        'manufacturers',
        'countries',
        'modes',
      ]),
      check_brands(){
        if(this.brands.length == 0){
          this.getBrands();
        }
        return true;
      },
      check_packagings(){
        if(this.packagings.length == 0){
          this.getPackagings();
        }
        return true;
      },
      check_manufacturers(){
        if(this.manufacturers.length == 0){
          this.getManufacturers();
        }
        return true;
      },
      check_countries(){
        if(this.countries.length == 0){
          this.getCountries();
        }
        return true;
      },
      check_suppliers(){
        if(this.suppliers.length == 0){
          this.getSuppliers();
        }
        return true;
      },
    },

}
</script>

<style>

</style>