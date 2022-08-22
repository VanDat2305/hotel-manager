  <!-- jQuery -->
  @include('sweetalert::alert')
  <script src="{{ asset('bower_components/template-admin/plugins/jquery/jquery.min.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('bower_components/template-admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
      $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('bower_components/template-admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- overlayScrollbars -->
  <script
      src="{{ asset('bower_components/template-admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}">
  </script>
  <!-- AdminLTE App -->
  <script src="{{ asset('bower_components/template-admin/dist/js/adminlte.js') }}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{asset('js/app.js')}}"></script>

