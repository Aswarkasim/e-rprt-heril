  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-2">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="/img/logo.png" alt="AdminLTE Logo" width="30px" class="" style="opacity: .8"> 
      <span class="brand-text font-weight-light">SINSIS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            @if (auth()->user()->role == 'admin')
                @include('admin.layouts.sidebar.admin')
            @else
                @include('admin.layouts.sidebar.guru')
            @endif
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


