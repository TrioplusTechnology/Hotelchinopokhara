<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <!-- <a href="index3.html" class="brand-link">
    <img src="{{ asset('assets/images/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"></span>
  </a> -->

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('assets/images/logo.png') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ auth()->user()->first_name ." ". auth()->user()->last_name }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        @can('viewList', App\User::class)
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
              User Management
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="{{ route('admin.user-management.user.list') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>User</p>
              </a>
            </li>
          </ul>
        </li>
        @endcan
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Settings
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="{{ route('admin.setting.permission.list') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Permission</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.setting.module.list') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Module</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.setting.role.list') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Role</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.setting.mapping.list') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Role Module Permission Mapping</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.about_us.list') }}" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              About us
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.recreation.list') }}" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Recreation
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.service.list') }}" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Services
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.bar.list') }}" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Bar
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.event.list') }}" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Event
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.gallery.list') }}" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Gallery
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.roomtype.list') }}" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Room
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>