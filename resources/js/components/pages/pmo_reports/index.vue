<template>
     <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Reports</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><router-link :to="{ name: 'home'}">Home</router-link></li>
                    <li class="breadcrumb-item"><router-link :to="{ name: 'pmo_reports'}">Reports</router-link></li>
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
                        <ul class="list-group">
                            <li class="list-group-item">Stock Card</li>
                            <li class="list-group-item"></li>
                        </ul>
                    </div>
                    <div class="card-footer text-right">
                        
                    </div>
                </div>
              </div>
          </div>
      </div>
    </section>
</div>
</template>

<script>


export default {
    data(){
        return{

        }
    },
    methods:{

    },
    created(){

    },
    computed:{


    }
}
</script>

<style>

</style>