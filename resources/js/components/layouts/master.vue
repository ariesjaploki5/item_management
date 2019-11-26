<template>
   <!-- Site wrapper -->
   <div>
    <div v-if="loggedIn" class="wrapper">
      <!-- Navbar -->
        <nav class="main-header navbar navbar-expand">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
              <router-link :to="{ name: 'home'}" class="nav-link">Home</router-link>
            </li>

          </ul>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item d-none d-sm-inline-block">
              <router-link :to="{ name: 'logout'}" class="nav-link">Logout</router-link>
            </li>
          </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
          <!-- Brand Logo -->
          <a href="#" class="brand-link">
            <img :src="'../../img/bghmc.png'" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">MMO</span>
          </a>

          <!-- Sidebar -->
          <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                <img src="" class="img-circle elevation-2" alt="">
              </div>
              <div class="info">
                <a href="#" class="d-block">USER NAME</a>
              </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                  <router-link :to="{ name: 'home' }" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Dashboard
                    </p>
                  </router-link>

                </li>

                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                      Items
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <router-link :to="{ name: 'items' }" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>List</p>
                      </router-link>
                    </li>
                    
                  </ul>
                </li>
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                      Purchase Requests
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <router-link :to="{ name: 'purchase_request_create' }" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Create</p>
                      </router-link>
                    </li>
                    <li class="nav-item">
                      <router-link :to="{ name: 'purchase_requests' }" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>List</p>
                      </router-link>
                    </li>
                    
                  </ul>
                </li>
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                      Purchase Orders
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <router-link :to="{ name: 'purchase_orders' }" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>List</p>
                      </router-link>
                    </li>
                  </ul>
                </li>
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                      IARS
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <!-- <li class="nav-item">
                      <router-link :to="{ name: 'inspection_and_acceptance_report_create' }" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Create</p>
                      </router-link>
                    </li> -->
                    <li class="nav-item">
                      <router-link :to="{ name: 'inspection_and_acceptance_reports' }" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>List</p>
                      </router-link>
                    </li>
                    
                  </ul>
                </li>
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                      RIS
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <router-link :to="{ name: 'requisition_slip_create' }" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Create</p>
                      </router-link>
                    </li>
                    <li class="nav-item">
                      <router-link :to="{ name: 'requisition_slips' }" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>List</p>
                      </router-link>
                    </li>
                    <li class="nav-item">
                      <router-link :to="{ name: 'requisition_slip_reports' }" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Reports</p>
                      </router-link>
                    </li>
                  </ul>
                </li>
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                      DVS
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <router-link :to="{ name: 'disbursement_vouchers' }" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>List</p>
                      </router-link>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
            <!-- /.sidebar-menu -->
          </div>
          <!-- /.sidebar -->
        </aside>

        <div class="content-wrapper">
        <router-view></router-view>
        </div>
        <footer class="main-footer d-print-none">
          <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.0.0
          </div>
          <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
          reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
          <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <div v-else>
      <router-view></router-view>
    </div>
   </div>

<!-- ./wrapper -->
</template>
<script>
  export default{
    data(){
      return{

      }
    },
    computed: {
      loggedIn() {
        return this.$store.getters.loggedIn
      }
    }
  }
</script>
<style lang="scss">
  .navbar{
    background-color: #232f34;
  }
  a {
    color: #f6a832 !important;
  }
</style>