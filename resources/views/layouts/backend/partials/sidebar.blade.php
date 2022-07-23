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
        @can('canViewList', App\Models\User::class)
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              User Management
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="{{ route('admin.user-management.user.list') }}" class="nav-link">
                <i class="far fa-user nav-icon"></i>
                <p>User</p>
              </a>
            </li>
          </ul>
        </li>
        @endcan

        @if(request()->user()->can('canViewList', App\Models\Permission::class) || request()->user()->can('canViewList', App\Models\Module::class) || request()->user()->can('canViewList', App\Models\Role::class) || request()->user()->can('canViewList', App\Models\RoleModulePermission\Mapping::class))
        <li class="nav-item">

          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Settings
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            @can('canViewList', App\Models\Permission::class)
            <li class="nav-item">
              <a href="{{ route('admin.setting.permission.list') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Permission</p>
              </a>
            </li>
            @endcan

            @can('canViewList', App\Models\Module::class)
            <li class="nav-item">
              <a href="{{ route('admin.setting.module.list') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Module</p>
              </a>
            </li>
            @endcan

            @can('canViewList', App\Models\Role::class)
            <li class="nav-item">
              <a href="{{ route('admin.setting.role.list') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Role</p>
              </a>
            </li>
            @endcan

            @can('canViewList', App\Models\RoleModulePermissionMapping::class)
            <li class="nav-item">
              <a href="{{ route('admin.setting.mapping.list') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Role Module Permission Mapping</p>
              </a>
            </li>
            @endcan
          </ul>
        </li>
        @endif

        @can('canViewList', App\Models\AboutUs::class)
        <li class="nav-item">
          <a href="{{ route('admin.about_us.list') }}" class="nav-link">
            <i class="nav-icon fas fa-address-card"></i>
            <p>
              About us
            </p>
          </a>
        </li>
        @endcan

        @can('canViewList', App\Models\Recreation::class)
        <li class="nav-item">
          <a href="{{ route('admin.recreation.list') }}" class="nav-link">
            <i class="nav-icon fas fa-umbrella-beach"></i>
            <p>
              Recreation
            </p>
          </a>
        </li>
        @endcan

        @can('canViewList', App\Models\Service::class)
        <li class="nav-item">
          <a href="{{ route('admin.service.list') }}" class="nav-link">
            <i class="nav-icon fas fa-satellite"></i>
            <p>
              Services
            </p>
          </a>
        </li>
        @endcan

        @can('canViewList', App\Models\Bar\Bar::class)
        <li class="nav-item">
          <a href="{{ route('admin.bar.list') }}" class="nav-link">
            <i class="nav-icon fas fa-bars"></i>
            <p>
              Bar
            </p>
          </a>
        </li>
        @endcan

        @can('canViewList', App\Models\Event\Event::class)
        <li class="nav-item">
          <a href="{{ route('admin.event.list') }}" class="nav-link">
            <i class="nav-icon fas fa-calendar"></i>
            <p>
              Event
            </p>
          </a>
        </li>
        @endcan

        @can('canViewList', App\Models\Gallery\Gallery::class)
        <li class="nav-item">
          <a href="{{ route('admin.gallery.list') }}" class="nav-link">
            <i class="nav-icon fas fa-folder"></i>
            <p>
              Gallery
            </p>
          </a>
        </li>
        @endcan

        @if(request()->user()->can('canViewList', App\Models\Room\RoomType::class) || request()->user()->can('canViewList', App\Models\Room\RoomFeature::class))
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-registered"></i>
            <p>
              Room
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            @can('canViewList', App\Models\Room\RoomType::class)
            <li class="nav-item">
              <a href="{{ route('admin.roomtype.list') }}" class="nav-link">
                <i class="fas fa-keyboard nav-icon"></i>
                <p>Room Type</p>
              </a>
            </li>
            @endcan

            @can('canViewList', App\Models\Room\RoomFeature::class)
            <li class="nav-item">
              <a href="{{ route('admin.roomtype.feature.list') }}" class="nav-link">
                <i class="fas fa-cube nav-icon"></i>
                <p>Room Feature</p>
              </a>
            </li>
            @endcan
          </ul>
        </li>
        @endif
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>