<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{route('home')}}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-header">Product</li>
          <li class="nav-item">
            <a href="{{route('requests.index')}}" class="nav-link">
              <i class="nav-icon fa fa-cubes"></i>
              <p>
                Permintaan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/calendar.html" class="nav-link">
              <i class="nav-icon fa fa-cube"></i>
              <p>
                Stok
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/calendar.html" class="nav-link">
              <i class="nav-icon fa fa-building"></i>
              <p>
                Lokasi
              </p>
            </a>
          </li>
        @can('isSuperAdmin')
        <li class="nav-header">User Management</li>
        <li class="nav-item">
          <a href="pages/calendar.html" class="nav-link">
            <i class="nav-icon fa fa-briefcase"></i>
            <p>
              Departemen
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="pages/calendar.html" class="nav-link">
            <i class="nav-icon fa fa-id-card"></i>
            <p>
              Role
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="pages/calendar.html" class="nav-link">
            <i class="nav-icon fa fa-user-circle"></i>
            <p>
              User
            </p>
          </a>
        </li>
        @endcan
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->