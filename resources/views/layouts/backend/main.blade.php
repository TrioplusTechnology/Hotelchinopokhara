<!DOCTYPE html>
<html lang="en">

<head>
  @include('layouts.backend.partials.head')
  @yield('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    @include('layouts.backend.partials.navbar')
    <!-- /.navbar -->

    @include('layouts.backend.partials.sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->

      @include('layouts.backend.partials.content_header')
      <!-- /.content-header -->

      <!-- Main content -->
      @yield('content')
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    @include('layouts.backend.partials.footer')
  </div>
  <!-- ./wrapper -->



  @include('layouts.backend.partials.scripts')
  @include('layouts.backend.custom.custom')
  @yield('scripts')
</body>

</html>