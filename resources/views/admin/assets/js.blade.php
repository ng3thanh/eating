<!-- jQuery 3 -->
<script src="{{ asset('lib/jquery/dist/jquery.min.js') }}"></script>

<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('lib/jquery-ui/jquery-ui.min.js') }}"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('lib/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('lib/admin-lte/js/adminlte.min.js') }}"></script>

<!-- Validate local -->
<script src="{{ asset('admin/js/utilities/jquery.validate.min.js') }}"></script>
<script src="{{ asset('admin/js/utilities/jquery.validate.messages.js') }}"></script>
<script src="{{ asset('admin/js/utilities/form.validate.js') }}"></script>
<script src="{{ asset('admin/js/utilities/common.js') }}"></script>