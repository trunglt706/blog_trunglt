<script>
    function visibleNotify(type, mes, time = 3000) {
    $.notify({
        message: mes
    }, {
        type: type,
        timer: time,
        delay: time,
        placement: {
            from: "top",
            align: "right",
        },
        animate: {
            enter: "animated bounce",
            exit: "animated bounce"
        }
    });
}
</script>
<script src="{{url('js/auth/jquery.min.js'.'?v='.env("APP_VERSION"))}}"></script>
<script src="{{url('js/auth/jquery-ui.min.js'.'?v='.env("APP_VERSION"))}}"></script>
<script src="{{url('js/auth/bootstrap.min.js'.'?v='.env("APP_VERSION"))}}"></script>
<script src="{{url('js/auth/bootsnav.js'.'?v='.env("APP_VERSION"))}}"></script>
<script src="{{url('js/auth/theia-sticky-sidebar.js'.'?v='.env("APP_VERSION"))}}"></script>
<script src="{{url('js/auth/RYPP.js'.'?v='.env("APP_VERSION"))}}"></script>
<script src="{{url('js/auth/owl.carousel.min.js'.'?v='.env("APP_VERSION"))}}"></script>
<script src="{{url('js/auth/custom.js'.'?v='.env("APP_VERSION"))}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>