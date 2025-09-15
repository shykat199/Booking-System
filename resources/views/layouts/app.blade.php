<!DOCTYPE html >
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Task Management"/>
    <meta name="keywords" content="Task Management"/>
    <meta name="author" content="Task Management"/>
    <title>{{config('app.name')}}</title>
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon"/>

    <link rel="stylesheet" href="{{asset('assets/css/vendors/flag-icon.css')}}"/>
    <!-- iconly-icon-->
    <link rel="stylesheet" href="{{asset('assets/css/iconly-icon.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/bulk-style.css')}}"/>
    <!-- iconly-icon-->
    <link rel="stylesheet" href="{{asset('assets/css/themify.css')}}"/>
    <!--fontawesome-->
    <link rel="stylesheet" href="{{asset('assets/css/fontawesome-min.css')}}"/>
    <!-- Whether Icon css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/weather-icons/weather-icons.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/scrollbar.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/slick.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/slick-theme.css')}}"/>
    <!-- App css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}"/>
    <link id="color" rel="stylesheet" href="{{asset('assets/css/color-1.css')}}" media="screen"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.23.0/sweetalert2.css" integrity="sha512-/j+6zx45kh/MDjnlYQL0wjxn+aPaSkaoTczyOGfw64OB2CHR7Uh5v1AML7VUybUnUTscY5ck/gbGygWYcpCA7w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @stack('style')
</head>
<body>
<!-- page-wrapper Start-->

<!-- loader-->
<div class="loader-wrapper">
    <div class="loader"><span></span><span></span><span></span><span></span><span></span></div>
</div>
<div class="page-wrapper compact-wrapper" id="pageWrapper">
    @include('layouts.header')
    <!-- Page Body Start-->
    <div class="page-body-wrapper">

        <!-- Page sidebar start-->
        @include('layouts.side-bar')
        <!-- Page sidebar end-->
        @section('content')
        @show

        @include('layouts.footer')

    </div>
</div>
<!-- jquery-->
<script src="{{asset('assets/js/vendors/jquery/jquery.min.js')}}"></script>
<!-- bootstrap js-->
<script src="{{asset('assets/js/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}" defer=""></script>
<script src="{{asset('assets/js/vendors/bootstrap/dist/js/popper.min.js')}}" defer=""></script>
<!--fontawesome-->
<script src="{{asset('assets/js/vendors/font-awesome/fontawesome-min.js')}}"></script>
<!-- feather-->
<script src="{{asset('assets/js/vendors/feather-icon/feather.min.js')}}"></script>
<script src="{{asset('assets/js/vendors/feather-icon/custom-script.js')}}"></script>
<!-- height_equal-->
<script src="{{asset('assets/js/height-equal.js')}}"></script>
<!-- config-->
<script src="{{asset('assets/js/config.js')}}"></script>
<!-- scrollbar-->
<script src="{{asset('assets/js/scrollbar/simplebar.js')}}"></script>
<script src="{{asset('assets/js/scrollbar/custom.js')}}"></script>
<!-- slick-->
<script src="{{asset('assets/js/slick/slick.min.js')}}"></script>
<script src="{{asset('assets/js/slick/slick.js')}}"></script>
<!-- data_table-->
<script src="{{asset('assets/js/js-datatables/datatables/jquery.dataTables.min.js')}}"></script>
<!-- page_datatable-->
<script src="{{asset('assets/js/js-datatables/datatables/datatable.custom.js')}}"></script>
<!-- page_datatable1-->
<script src="{{asset('assets/js/js-datatables/datatables/datatable.custom1.js')}}"></script>
<!-- page_datatable-->
<script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
<!-- tilt-->
<script src="{{asset('assets/js/animation/tilt/tilt.jquery.js')}}"></script>
<!-- page_tilt-->
<script src="{{asset('assets/js/animation/tilt/tilt-custom.js')}}"></script>
<!-- custom script -->
<script src="{{asset('assets/js/script.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.23.0/sweetalert2.min.js" integrity="sha512-pnPZhx5S+z5FSVwy62gcyG2Mun8h6R+PG01MidzU+NGF06/ytcm2r6+AaWMBXAnDHsdHWtsxS0dH8FBKA84FlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function(){
        $(".user-task").on("click", function(){
            let submenu = $(this).next(".sidebar-submenu");
            if (submenu.css("display") === "none") {
                submenu.css("display", "block");
            } else {
                submenu.css("display", "none");
            }
        });
    });
</script>

@stack('script')
</body>

</html>
