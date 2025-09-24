<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="{{config('app.name')}}">
    <meta name="author" content="{{config('app.name')}}">
    <meta name="keywords" content="{{config('app.name')}}">

    <title>{{config('app.name')}} | Verify Account</title>

    <script src="{{asset('admin/assets/js/color-modes.js')}}"></script>

    <link rel="stylesheet" href="{{asset('admin/assets/vendors/core/core.css')}}">

    <link rel="stylesheet" href="{{asset('admin/assets/fonts/feather-font/css/iconfont.css')}}">

    <link rel="stylesheet" href="{{asset('admin/assets/css/demo1/style.css')}}">

    <link rel="shortcut icon" href="{{asset('admin/assets/images/favicon.png')}}"/>

    <link rel="stylesheet" href="{{asset('css/fontawesome-free-7.0.0-web/css/all.min.css')}}">

</head>
<body>
@include('sweetalert::alert')
<div class="main-wrapper">
    <div class="page-wrapper full-page">
        <div class="page-content d-flex align-items-center justify-content-center">

            <div class="row w-100 mx-0 auth-page">
                <div class="col-md-10 col-lg-8 col-xl-6 mx-auto">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-12 ps-md-0">
                                <div class="auth-form-wrapper px-4 py-5">
                                    <p class="text-center nobleui-logo d-block mb-2">Verify Account </p>

                                    <form class="forms-sample" method="POST" action="{{ route('verification.send') }}">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email address</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                                   name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Enter your email">

                                            @error('email')
                                            <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary">Verify Account</button>
                                    </form>

                                    <div class="mt-3">
                                        <a href="{{ route('adb-login') }}">Back to Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="{{asset('admin/assets/vendors/core/core.js')}}"></script>
<script src="{{asset('admin/assets/vendors/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('jquery/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('jq-validation/jquery.validate.js')}}"></script>
<script src="{{asset('jq-validation/additional-methods.js')}}"></script>

<script>

    $(document).ready(function () {
        $('.forms-sample').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: {
                    required: "Please enter your email address",
                    email: "Please enter a valid email address"
                }
            },
            errorElement: 'div',
            errorClass: 'text-danger mt-1',
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>

</body>

</html>
