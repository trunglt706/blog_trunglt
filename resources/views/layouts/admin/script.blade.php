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
<script src="{{url('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}" type="text/javascript"></script>
<script src="{{url('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}" type="text/javascript"></script>
<!--data table-->
<script src="{{url('plugins/datatable/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
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
<!--ckeditor-->
<script src="{{url('plugins/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
<!-- Select2 -->
<script src="{{url('plugins/select2/dist/js/select2.full.min.js')}}"></script>
<!-- Hien thi hinh anh khi chon lua tu form -->
<script type="text/javascript">
    $("#AvatarPerson").on('change', function () {
        //Get count of selected files
        var countFiles = $(this)[0].files.length;

        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        var image_holder = $("#image-holder");
        image_holder.empty();

        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof (FileReader) != "undefined") {

                //loop for each file selected for uploaded.
                for (var i = 0; i < countFiles; i++) {

                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("<img />", {
                            "src": e.target.result,
                            "class": "thumb-image"
                        }).appendTo(image_holder);
                    };

                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[i]);
                }
                $("#old-image-div").hide();
            } else {
                $("#old-image-div").show();
                toastr.warning("Please select file image");
            }
        } else {
            $("#old-image-div").show();
            toastr.warning("Please select file image");
        }
    });
    $("#Background").on('change', function () {
        //Get count of selected files
        var countFiles = $(this)[0].files.length;

        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        var image_holder = $("#image-holder-background");
        image_holder.empty();

        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof (FileReader) != "undefined") {

                //loop for each file selected for uploaded.
                for (var i = 0; i < countFiles; i++) {

                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("<img />", {
                            "src": e.target.result,
                            "class": "thumb-image"
                        }).appendTo(image_holder);
                    };

                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[i]);
                }
                $("#old-image-div-background").hide();
            } else {
                $("#old-image-div-background").show();
                toastr.warning("Please select file image");
            }
        } else {
            $("#old-image-div-background").show();
            toastr.warning("Please select file image");
        }
    });
    
    CKEDITOR.replace('ckeditor', {
        height: 280,
        toolbar: 'Full',
        filebrowserBrowseUrl: "{{ url('plugins/ckfinder/ckfinder.html') }}",
        filebrowserImageBrowseUrl: "{{ url('plugins/ckfinder/ckfinder.html?type=Images') }}",
        filebrowserFlashBrowseUrl: "{{ url('plugins/ckfinder/ckfinder.html?type=Flash') }}",
        filebrowserUploadUrl: "{{ url('plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
        filebrowserImageUploadUrl: "{{ url('plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
        filebrowserFlashUploadUrl: "{{ url('plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}"
    });
    
    $('.select2').select2();
</script>