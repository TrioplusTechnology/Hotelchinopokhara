<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('js/backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('js/backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

<!-- Bootstrap 4 -->
<script src="{{ asset('js/backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('js/backend/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('js/backend/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('js/backend/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('js/backend/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('js/backend/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('js/backend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('js/backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('js/backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('js/backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('js/backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/backend/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('js/backend/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('js/backend/dist/js/pages/dashboard.js') }}"></script>
<!-- Notification toastr -->
<script src="{{ asset('js/backend/plugins/toastr/toastr.min.js') }}"></script>
<!-- <script src="{{ asset('js/backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script> -->
<script src="{{ asset('js/backend/plugins/sweetalert/sweetalert.min.js') }}"></script>
<!-- dropzonejs -->
<script src="{{ asset('js/backend/plugins/dropzone/min/dropzone.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Select2 -->
<script src="{{ asset('js/backend/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
  $.widget.bridge('uibutton', $.ui.button);
  $(function() {
    $('[data-toggle="tooltip"]').tooltip();

    // Summernote
    $('.summernote').summernote();
    //Initialize Select2 Elements
    $(".select2").select2();

    //Initialize Select2 Elements
    $(".select2bs4").select2({
      theme: "bootstrap4",
    });
  })
</script>