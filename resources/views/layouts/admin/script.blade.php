<!-- jQuery 3 -->
<script src="{{url('js/admin/jquery.min.js')}}" type="text/javascript"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{url('js/admin/jquery-ui.min.js')}}" type="text/javascript"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{url('js/admin/bootstrap.min.js')}}" type="text/javascript"></script>
<!-- Morris.js charts -->
<script src="{{url('js/admin/raphael.min.js')}}" type="text/javascript"></script>
<script src="{{url('js/admin/morris.min.js')}}" type="text/javascript"></script>
<!-- Sparkline -->
<script src="{{url('js/admin/jquery.sparkline.min.js')}}" type="text/javascript"></script>
<!-- jvectormap -->
<script src="{{url('plugin/jvectormap/jquery-jvectormap-1.2.2.min.js')}}" type="text/javascript"></script>
<script src="{{url('plugin/jvectormap/jquery-jvectormap-world-mill-en.js')}}" type="text/javascript"></script>
{{--data table--}}
<script src="{{url('plugin/datatable/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="{{url('js/admin/jquery.knob.min.js')}}" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="{{url('js/admin/moment.min.js')}}" type="text/javascript"></script>
<script src="{{url('js/admin/daterangepicker.js')}}" type="text/javascript"></script>
<!-- datepicker -->
<script src="{{url('js/admin/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{url('js/admin/bootstrap3-wysihtml5.all.min.js')}}" type="text/javascript"></script>
<!-- Slimscroll -->
<script src="{{url('js/admin/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<!-- FastClick -->
<script src="{{url('js/admin/fastclick.js')}}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{url('js/admin/adminlte.min.js')}}" type="text/javascript"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{url('js/admin/dashboard.js')}}" type="text/javascript"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('js/admin/demo.js')}}" type="text/javascript"></script>
<script src="{{url('js/admin/toastr.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    @if(session('error'))
    toastr.error(session('error'));
    @endif
    @if(session('success'))
    toastr.success(session('success'));
    @endif
</script>