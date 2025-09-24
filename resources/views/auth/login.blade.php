<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
          content="Admiro admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
          content="admin template, Admiro admin template, best javascript admin, dashboard template, bootstrap admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <title>Admiro - Premium Admin Template</title>
    <!-- Favicon icon-->
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
    <!-- Flag icon css -->
    <link rel="stylesheet" href="{{asset('assets/css/vendors/flag-icon.css')}}">
    <!-- iconly-icon-->
    <link rel="stylesheet" href="{{asset('assets/css/iconly-icon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bulk-style.css')}}">
    <!-- iconly-icon-->
    <link rel="stylesheet" href="{{asset('assets/css/themify.css')}}">
    <!--fontawesome-->
    <link rel="stylesheet" href="{{asset('assets/css/fontawesome-min.css')}}">
    <!-- Whether Icon css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/weather-icons/weather-icons.min.css')}}">
    <!-- App css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{asset('assets/css/color-1.css')}}" media="screen">
</head>
<body>
@include('sweetalert::alert')
<!-- tap on top starts-->
<div class="tap-top"><i class="iconly-Arrow-Up icli"></i></div>
<!-- tap on tap ends-->
<!-- loader-->
<div class="loader-wrapper">
    <div class="loader"><span></span><span></span><span></span><span></span><span></span></div>
</div>
<!-- login page start-->
<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-12 p-0">
            <div class="login-card login-dark">
                <div>
                    <div>
                        <a class="logo" href="{{route('login')}}">
                            <img class="img-fluid for-light m-auto" src="{{asset('assets/images/logo/logo1.png')}}"
                                 alt="looginpage">
                            <img class="img-fluid for-dark" src="{{asset('assets/images/logo/logo-dark.png')}}"
                                 alt="logo">
                        </a>
                    </div>
                    <div class="login-main">
                        <form class="theme-form" action="{{route('login.store')}}" method="post">
                            @csrf
                            <h2 class="text-center">Sign in to account</h2>
                            <p class="text-center">Enter your email &amp; password to login</p>
                            <div class="form-group">
                                <label class="col-form-label">Email Address</label>
                                <input class="form-control" type="email" name="email" required="" placeholder="Test@gmail.com">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Password</label>
                                <div class="form-input position-relative">
                                    <input class="form-control" type="password" name="password" required="" placeholder="*********">
                                    <div class="show-hide">
                                        <span class="show"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0 checkbox-checked">
                                <div class="text-end mt-3">
                                    <button class="btn btn-primary btn-block w-100" type="submit">Sign in</button>
                                </div>
                            </div>
                            {{--                            <div class="login-social-title">--}}
                            {{--                                <h6>Or Sign in with                 </h6>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="form-group">--}}
                            {{--                                <ul class="login-social">--}}
                            {{--                                    <li><a href="https://www.linkedin.com/" target="_blank"><i class="icon-linkedin"></i></a></li>--}}
                            {{--                                    <li><a href="https://twitter.com/" target="_blank"><i class="icon-twitter"></i></a></li>--}}
                            {{--                                    <li><a href="https://www.facebook.com/" target="_blank"><i class="icon-facebook"></i></a></li>--}}
                            {{--                                    <li><a href="https://www.instagram.com/" target="_blank"><i class="icon-instagram"></i></a></li>--}}
                            {{--                                </ul>--}}
                            {{--                            </div>--}}
                            {{--                            <p class="mt-4 mb-0 text-center">Don't have account?<a class="ms-2" href="sign-up.html">Create Account</a></p>--}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jquery-->
    <script src="{{asset('assets/js/vendors/jquery/jquery.min.js')}}"></script>
    <!-- bootstrap js-->
    <script src="{{asset('assets/js/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}" defer=""></script>
    <script src="{{asset('assets/js/vendors/bootstrap/dist/js/popper.min.js')}}" defer=""></script>
    <!--fontawesome-->
    <script src="{{asset('assets/js/vendors/font-awesome/fontawesome-min.js')}}"></script>
    <!-- password_show-->
    <script src="{{asset('assets/js/password.js')}}"></script>
    <!-- custom script -->
    <script src="{{asset('assets/js/script.js')}}"></script>
</div>
</body>

</html>
