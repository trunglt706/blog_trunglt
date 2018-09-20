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
                    }

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
</script>
<script src="{{url('js/admin/bootstrap.min.js')}}" type="text/javascript"></script> 
<script src="{{url('js/admin/AdminLTE/app.js')}}" type="text/javascript"></script>        
<script src="{{url('js/admin/toastr.js')}}" type="text/javascript"></script>
<script src="{{url('js/admin/custom.js')}}" type="text/javascript"></script>
<script src="{{url('js/admin/select2.min.js')}}" type="text/javascript"></script>
{{-- csript for datatable --}}
<script type="text/javascript" src="{{url('datatable/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{url('datatable/button/js/dataTables.buttons.min.js')}}"></script>
<script type="text/javascript" src="{{url('datatable/jszip/jszip.min.js')}}"></script>
<script type="text/javascript" src="{{url('datatable/button/js/buttons.html5.min.js')}}"></script>
<script type="text/javascript" src="{{url('datatable/button/js/buttons.print.min.js')}}"></script>
@yield('script')