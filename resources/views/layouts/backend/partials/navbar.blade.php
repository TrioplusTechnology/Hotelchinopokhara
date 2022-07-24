<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="index3.html" class="nav-link"><b>Hotel Chino Pokhara</b></a>
    </li>

  </ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
      <a class="nav-link" href="#" role="button" data-toggle="tooltip" data-placement="bottom" title="Log out" onclick="$('#logout-form').submit();">
        Log Out
        <i class="fas fa-sign-out-alt"></i>
      </a>
    </li>
  </ul>
</nav>